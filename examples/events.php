<?php
    /**
        If you want this results to be compatible with other applications, you can output the results in json format.
    **/
    require '../vendor/autoload.php';

    $day   = htmlspecialchars($_GET['day'] );
    $month = htmlspecialchars($_GET['month'] );
    $filters = $_GET['filters'];

    $dim = new ThisDayIn\Music( $day, $month );
    $events = $dim->getEvents( $filters );
    header("Content-type: text/plain");
    echo json_encode($events);
?>
