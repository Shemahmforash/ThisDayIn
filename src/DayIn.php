<?php
Abstract class DayIn {

    //url or file where to read the data from
    protected $_source;

    //class that will parse the source
    protected $_parser;

    /*
    The method to be called from outside the class to get the events
    */
    abstract public function getEvents();

    /*
    It may be necessary to create the source string by using today's date, for instance
    */
    abstract protected function _create_source();

}
