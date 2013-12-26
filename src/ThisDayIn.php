<?php
Abstract class ThisDayIn {

    //url or file where to read the data from
    private $_source;

    //class that will parse the source
    private $_parser;

    /*
    The method to be called from outside the class to get the events
    */
    abstract public function getEvents();

    /*
    It may be necessary to create the source string by using today's date, for instance
    */
    abstract protected function createSource();

}
