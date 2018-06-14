<?php
    require_once ('../controller/Videos.php');

    $v = new Videos();

    if(isset($_REQUEST['termen'])){

        $videos = $v -> search($_REQUEST['termen']);
    }

    $result = ["videos" => $videos];

        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($result);

?>
