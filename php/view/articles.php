<?php

require_once ('../controller/Articles.php');

$terms = $_GET['ti'];
$sortBy = $_GET['sortBy'];
$sortOrder = $_GET['sortOrder'];
$from = $_GET['start'];
$to = $_GET['max_results'];

$filter = [
    'terms' => $terms,
    'sortBy' => $sortBy,
    'sortOrder' => $sortOrder,
    'start' => $from,
    'max_results' => $to,
];

// echo $filter['terms'];

$articleFeed = new Articles();
$articles = $articleFeed->search($filter);
$result = ["articles" => $articles];

// echo '<pre>' , var_dump($result) , '</pre>';


header('Content-Type: application/json');
http_response_code(200);
echo json_encode($result);

?>
