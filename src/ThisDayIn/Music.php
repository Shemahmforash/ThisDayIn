<?php
namespace ThisDayIn;

class Music extends \ThisDayIn {
    private $_day;
    private $_month;
    private $_source = 'http://www.musicorb.com/day';
    private $_parser = "\HTML_Parser_HTML5";

    public function __construct( $day = null, $month = null ) {
        $this->_day   = $day ? $day : date("j");
        $this->_month = $month ? $month : date("F");

        $this->_source = $source ? $source : $this->_source;

        $this->_source = $this->_create_source();
    }

    protected function _create_source() {
       return sprintf('%s/%s/%s', $this->_source, $this->_month, $this->_day); 
    }

    public function getEvents( $filters = null) {
        $file   = file_get_contents($this->_source);
        $parser = new $this->_parser( $file );

        return $this->_parse( $parser, $filters );
    }

    #receives filters with the types accepted
    protected function _parse( $parser, $filters ) {
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

            #filter data of a specific type or set of types
            if( $filters ) {
                if(is_array( $filters ) && in_array( $type, $filters )) {
                    array_push( $data, $hash );
                }
                else if( $type === $filters ) {
                    array_push( $data, $hash );
                }
            }
            else {
                array_push( $data, $hash );
            }
        }

        return $data;
    }
}
