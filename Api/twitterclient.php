<?php

    require "twitteroauth/autoload.php";

    use Abraham\TwitterOAuth\TwitterOAuth;

    $consumerkey = "h4R5zNDIsQbDvzpP2fWXn1Twy";

    $consumersecret = "i8nh0TMbabCuj2csjqeIbVOTWfikLw8x2crySqw8NTGR8QMaCk";

    $accesstoken = "874204458464432128-VWoPHfOuvCz6TbnYX97opOEwVeRRuck";

    $accesstokensecret = "4ckUgbCbWbeziVIBWgLS3C2njgAEVy9MOkOywxRuRjJRK";

    $connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
    $content = $connection->get("account/verify_credentials");

    $statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

    //$url = "https://api.twitter.com/1.1/statuses/home_timeline.json";

    //print_r($statuses);

    /*foreach($statuses as $tweet){
        
        print_r($tweet->text);
        echo "<br>";
    }*/

    /*foreach($statuses as $tweet){
        
        print_r($tweet->user->favourites_count);
        
        echo "<br>";
        
        if(($tweet->user->favourites_count)>=6){
            
            print_r($tweet->text);
            echo "<br>";
        }
    }*/

    foreach($statuses as $tweet){
        
        if(($tweet->user->favourites_count)>500){
        
            $status = $connection->get("statuses/oembed",["id"=>$tweet->id]);

            //print_r($status);
            
            echo $status->html;
        }
        
    }

?>