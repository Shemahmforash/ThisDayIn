<?php
    /**
        If you want this results to be compatible with other applications, you can output the results in json format.
    **/
    require '../vendor/autoload.php';

    //use HTML_Parser_HTML5 class (included in autoload) as parser
    $dim = new DayIn\DayInMusic( "\HTML_Parser_HTML5" );
    $events = $dim->getEvents();
    header("Content-type: text/plain");
    echo json_encode($events);
?>
