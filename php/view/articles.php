<?php

require_once ('../controller/Articles.php');

if(!isset($_GET['ti']) || !isset($_GET['sortBy']) || !isset($_GET['sortOrder']) ||
    !isset($_GET['start']) || !isset($_GET['max_results'])) {
        header('Content-Type: application/json');
        http_response_code(400);
        die();
    }

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

$articleFeed = new Articles();
$articles = $articleFeed->search($filter);
$result = ["articles" => $articles];

header('Content-Type: application/json');
http_response_code(400);
echo json_encode($result);

?>
