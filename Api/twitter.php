<?php

    require "twitteroauth/autoload.php";

    use Abraham\TwitterOAuth\TwitterOAuth;

    $consumerkey = "h4R5zNDIsQbDvzpP2fWXn1Twy";

    $consumersecret = "i8nh0TMbabCuj2csjqeIbVOTWfikLw8x2crySqw8NTGR8QMaCk";

    $accesstoken = "874204458464432128-VWoPHfOuvCz6TbnYX97opOEwVeRRuck";

    $accesstokensecret = "4ckUgbCbWbeziVIBWgLS3C2njgAEVy9MOkOywxRuRjJRK";

    $connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
    $content = $connection->get("account/verify_credentials");

    $statues = $connection->post("statuses/update", ["status" => "This came from my twitter web app."]);

    $statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

    print_r($statuses);

?>