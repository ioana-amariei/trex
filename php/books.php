<?php

// echo json_encode($response);
//$resp = http_get("https://www.googleapis.com/books/v1/volumes?q=java", array("timeout"=>1), $info);
//echo $resp;


// $ch = curl_init("https://www.googleapis.com/books/v1/volumes?q=java");


// $res = curl_exec($ch);
// curl_close($ch);

// echo $res;

require ('repository/BookRepository.php');

$terms = $_GET['terms'];

$bookRepository = new BookRepository();
$books = $bookRepository->search($terms);

echo json_encode($books, JSON_PRETTY_PRINT);
 ?>
