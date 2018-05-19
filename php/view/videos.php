<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/Trex-Topic-based-Resource-eXplorer-/php/controller/Videos.php');
    
    $v = new Video();

    $v -> getAllCategories();
?>