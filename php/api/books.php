<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex2/php/model/Books.php');

$terms = $_GET['terms'];
$minimumRating = isset($_GET['minimumRating']) ? $_GET['minimumRating'] : 0;

$filter = ['terms' => $terms, 'minimumRating' => $minimumRating];

$bookData = new Books();
$books = $bookData->search($filter);

header('Content-Type: application/json');
echo json_encode($books);
 ?>
