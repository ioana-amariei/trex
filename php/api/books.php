<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex2/php/repository/BookRepository.php');

$terms = $_GET['terms'];
$minimumRating = isset($_GET['minimumRating']) ? $_GET['minimumRating'] : 0;

$filter = ['terms' => $terms, 'minimumRating' => $minimumRating];

$bookRepository = new BookRepository();
$books = $bookRepository->search($filter);

header('Content-Type: application/json');
echo json_encode($books);
 ?>
