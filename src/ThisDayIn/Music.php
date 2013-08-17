<?php
namespace ThisDayIn;

class Music extends \ThisDayIn {
    private $_day;
    private $_month;
    protected $_source = 'http://www.musicorb.com/day';

    public function __construct( $parser, $source = null, $day = null, $month = null ) {
        $this->_parser = $parser;

        $this->_day   = $day ? $day : date("j");
        $this->_month = $month ? $month : date("F");

        $this->_source = $source ? $source : $this->_source;

        $this->_source = $this->_create_source();
    }

    protected function _create_source() {
       return sprintf('%s/%s/%s', $this->_source, $this->_month, $this->_day); 
    }

    public function getEvents() {
        $file   = file_get_contents($this->_source);
        $parser = new $this->_parser( $file );

        return $this->_parse( $parser );
    }

    /**
        TODO: generalize this, as for now, it depends on HTML_Parser_HTML5 syntax
    */
    protected function _parse( $parser ) {
        $parser = $parser->root;

        $data = array();

        foreach($parser('div[itemtype]') as $element) {
            $description = $element('span[itemprop=description]', 0);

            if( $element->itemtype === "http://schema.org/Person" ) {
                if( $date = $element('span[itemprop=birthDate]', 0) ) {
                    $type = "Birth"; 
                }
                else if( $date = $element('span[itemprop=deathDate]', 0) ) {
                    $type = "Death"; 
                }

                $name = $element('span[itemprop=name]', 0);
                $date = $date->datetime;
                $description = $description->getInnerText();
                $name = $name->getInnerText();

                $hash = array("date" => $date, "description" => $description, 'name' => $name, 'type' => $type );

            }
            else if( $element->itemtype === "http://schema.org/Event/HistoricalEvent" ) {
                $type = "Event";
                $date = $element('span[itemprop=date]', 0);
                $date = $date->datetime;
                $description = $description->getInnerText();

                $hash = array("date" => $date, "description" => $description, 'type' => $type );
            }

            array_push( $data, $hash );
        }

        return $data;
    }
}
