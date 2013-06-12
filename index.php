<?php
//    require_once 'ganon.php';
    //require_once 'twitter.class.php';
    require 'vendor/autoload.php';
    require 'DayInMusic.php';

    $dim = new DayInMusic();
    $events = $dim->getEvents();
    header("Content-type: text/plain");
    echo json_encode($events);
    exit();


    /*Twitter configs*/
    $consumerKey = 'eaGnBo5pB5fztuH43PWEg';
    $consumerSecret = 'ASEfFrBKubGpCupgueFwGxP73i2bK7WydYrmnYcc';
    $accessToken    = '1509987306-ONotq4g9TRlOiAVEv5tCUvqHw1LDl7N2FXN5sP5';
    $accessTokenSecret = 'rwwkTXDcz7ujX9QYuEVeUDzn2g8WwT3xJRV0t1k6U';

    $day   = date("j");
    $month = date("F");

    $source = sprintf('http://www.musicorb.com/day/%s/%s', strtolower( $month ), $day );
    $file   = file_get_contents($source);

	$parser = new HTML_Parser_HTML5( $file );
    $html   = $parser->root;

    $count = 0;
    foreach($html('div[itemscope]') as $element) {
        $year = $element('span[itemprop=date]', 0);
        $text = $element('span[itemprop=description]', 0);

        $year = $year->getInnerText();
        $text = $text->getInnerText();

        if( $year && $text ) {

            $toSend = $year . " - " . $text . ' #thisdayinmusic'; 

            echo $toSend;

            $twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);     
            try {
                $tweet = $twitter->send( $toSend );

            } catch (TwitterException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        break;
        /*
        if( $text ) {
            $url = sprintf("http://developer.echonest.com/api/v4/artist/extract?api_key=FILDTEOIK2HBORODV&sort=familiarity-desc&format=json&text=%s&results=1",
                    urlencode($text) );

            $data = json_decode(file_get_contents( $url ));
//            var_dump( $data );
            $artist = $data->{'response'}->{'artists'}[0]->{'name'};
            echo "artist: ", $artist, "<br>";

            //TODO: obtain a song name from the artist: http://developer.echonest.com/api/v4/song/search?api_key=FILDTEOIK2HBORODV&format=json&results=1&artist=radiohead

            //TODO: youtube: use youtube api to find a video for this song
        }
        $count++;
        if( $count > 0 )
            break;
        */

/*

        echo $url, "<br>";


*/
    }
//    var_dump( $html );
?>
