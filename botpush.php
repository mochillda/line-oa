<?php



require "vendor/autoload.php";

$access_token = 'qXqMgoayE5SSg4EbZZ/oBH47tDP8yUyx6E0jwaXffeS1FsARKNFvChIcdngxsn0g1hlvF/xWc5eza4ayr5jJQcoBDXmMwqqqzjCBS+xWT6Vvvdkjjtdtzm5gJAIQ9uS4J+JJ7NcKlXADiUe3DujDQgdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'd4c772b3a8631c858948e11e6c1c1f78';

$pushID = '';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







