<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/Trex-Topic-based-Resource-eXplorer-/php/controller/Books.php');

$terms = $_GET['terms'];
$minimumRating = isset($_GET['minimumRating']) ? $_GET['minimumRating'] : 0;
$language = isset($_GET['language']) ? $_GET['language'] : 'any';

$filter = [
    'terms' => $terms,
    'minimumRating' => $minimumRating,
    'language' => $language
];

$bookData = new Books();
$books = $bookData->search($filter);

header('Content-Type: application/json');
echo json_encode($books);
 ?>
