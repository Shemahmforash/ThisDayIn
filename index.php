<?php
    require 'vendor/autoload.php';

    $dim = new DayIn\DayInMusic( "\HTML_Parser_HTML5" );
    $events = $dim->getEvents();
    header("Content-type: text/plain");
    echo json_encode($events);
?>
