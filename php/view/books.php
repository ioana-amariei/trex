<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex/php/controller/Books.php');

if(isset($_GET['terms']) === FALSE) {
    http_response_code(400);
    echo 'Error: the terms param is not set';
    return;
}

$terms = $_GET['terms'];
$minimumRating = isset($_GET['minimumRating']) ? $_GET['minimumRating'] : 0;
$language = isset($_GET['language']) ? $_GET['language'] : 'any';
$from = isset($_GET['from']) ? $_GET['from'] : 'any';
$to = isset($_GET['to']) ? $_GET['to'] : 'any';
$startIndex = isset($_GET['startIndex']) ? $_GET['startIndex'] : 0;
$maxResults = isset($_GET['maxResults']) ? $_GET['maxResults'] : 40;

if(is_numeric($from) and  is_numeric($to)){
    if($from > $to){
        header('Content-Type: application/json');
        http_response_code(400);
        $message = 'From: ' . $from . ' must be smaller or equal than to: ' . $to;
        echo json_encode(["message" => $message]);
        return;
    }
}

$filter = [
    'terms' => $terms,
    'minimumRating' => $minimumRating,
    'language' => $language,
    'from' => $from,
    'to' => $to,
    'startIndex' => $startIndex,
    'maxResults' => $maxResults
];

$books = new Books();
$bookResponse = $books->search($filter);
$result = ["books" => $books];

header('Content-Type: application/json');
http_response_code(200);
echo json_encode($bookResponse);
 ?>
