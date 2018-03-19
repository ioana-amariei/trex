<?php
require('resource.php');

$book = new Resource();
$book->setType("book");
$book->setTitle("The Java Programming Guide");

$books = [$book, $book];
$response = ["resources" => $books];

echo json_encode($response);

 ?>
