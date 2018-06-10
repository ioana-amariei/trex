<?php
    require_once ('../controller/Videos.php');
    
    $v = new Videos();
    $results = "";

    //$result = $v -> getAllCategories();
    if(isset($_REQUEST['termen']))
    {
        $results = $v -> search($_REQUEST['termen']);
    }
    else
    {
     $results = $v -> getInitialVideos();
    }
    
    //var_dump($_REQUEST);
    
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($results);
?>