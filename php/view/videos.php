<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex/php/controller/Videos.php');

    $v = new Videos();

    //$result = $v -> getAllCategories();
   // $initialPage = $v -> getInitialVideos();

    header('Content-Type: application/json');
    http_response_code(200);
?>
