<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/Trex-Topic-based-Resource-eXplorer-/php/controller/GenericResource.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/Trex-Topic-based-Resource-eXplorer-/php/model/Resource.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/Trex-Topic-based-Resource-eXplorer-/php/util/Utils.php');
    
    const TOKEN = "72936020ebb9949ae0e1d253cb7f87df";
    const URL = "https://api.vimeo.com/";

    class Video implements GenericResource {
        public function search($terms) {

        }

        public function getAllVideos(){
            $videoUrl = URL."videos";
        }
        public function getAllCategories(){
            $categoriesUrl = URL."categories";
            $authorizationToken = "Authorization: Bearer ".TOKEN;

            $result = Utils::fetchDataWithToken($categoriesUrl, $authorizationToken);
            echo $result;
        }

        public function test() {
            echo 2+2;
        }
    }
?>