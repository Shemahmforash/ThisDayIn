<?php
    /**
        If you want this results to be compatible with other applications, you can output the results in json format.
    **/
    require '../vendor/autoload.php';

    $day   = htmlspecialchars($_GET['day'] );
    $month = htmlspecialchars($_GET['month'] );
    $filters = $_GET['filters'];

    //use HTML_Parser_HTML5 class (included in autoload) as parser
    $dim = new ThisDayIn\Music( "\HTML_Parser_HTML5", null, $day, $month );
    $events = $dim->getEvents( $filters );
    header("Content-type: text/plain");
    echo json_encode($events);
?>
