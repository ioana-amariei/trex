<?php
    require_once ('../controller/Videos.php');

    $v = new Videos();

    if(isset($_REQUEST['termen']) && $_REQUEST['per_page']){
        $videos = $v -> searchMore($_REQUEST['termen'], $_REQUEST['per_page']);
    }
    else {
        header('Content-Type: application/json');
        http_response_code(400);
        die();
    }

    $result = ["videos" => $videos];

        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($result);

?>
