<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex/php/controller/Books.php');

$terms = $_GET['terms'];
$minimumRating = isset($_GET['minimumRating']) ? $_GET['minimumRating'] : 0;
$language = isset($_GET['language']) ? $_GET['language'] : 'any';
$from = isset($_GET['from']) ? $_GET['from'] : 'any';
$to = isset($_GET['to']) ? $_GET['to'] : 'any';

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
    'to' => $to
];

$bookData = new Books();
$books = $bookData->search($filter);
$result = ["books" => $books];

header('Content-Type: application/json');
http_response_code(200);
echo json_encode($result);
 ?>
