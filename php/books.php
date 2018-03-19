<?php
require('resource.php');

$book = new Resource();
$book->setType("book");
$book->setTitle("The Java Programming Guide");

$books = [$book, $book];
$response = ["resources" => $books];

// echo json_encode($response);
//$resp = http_get("https://www.googleapis.com/books/v1/volumes?q=java", array("timeout"=>1), $info);
//echo $resp;


$ch = curl_init("https://www.googleapis.com/books/v1/volumes?q=java");


$res = curl_exec($ch);
curl_close($ch);


echo $res;
 ?>
