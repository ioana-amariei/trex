<?php

require_once ('../controller/Articles.php');

$terms = $_GET['ti'];
$sortBy = $_GET['sortBy'];
$sortOrder = $_GET['sortOrder'];

$filter = [
    'terms' => $terms,
    'sortBy' => $sortBy,
    'sortOrder' => $sortOrder,
];

$articleFeed = new Articles();
$articles = $articleFeed->search($filter);

header('Content-Type: application/json');
http_response_code(200);
echo json_encode($articles);

?>
