<?php
    require_once ('../controller/Videos.php');
    
    $v = new Videos();

    if(isset($_REQUEST['termen'])){

        $results = $v -> searchMore($_REQUEST['termen'], $_REQUEST['per_page']);
    }
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($results);
    
?>
