<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex2/php/repository/BookRepository.php');

$terms = $_GET['terms'];

$bookRepository = new BookRepository();
$books = $bookRepository->search($terms);

header('Content-Type: application/json');
echo json_encode($books);
 ?>
