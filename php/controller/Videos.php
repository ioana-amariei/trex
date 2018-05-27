<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/Trex-Topic-based-Resource-eXplorer-/php/controller/GenericResource.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/Trex-Topic-based-Resource-eXplorer-/php/model/Resource.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/Trex-Topic-based-Resource-eXplorer-/php/util/Utils.php');
    
    const TOKEN = "72936020ebb9949ae0e1d253cb7f87df";
    const URL = "https://api.vimeo.com/";

    class Videos implements GenericResource {
        private $authToken = "Authorization: Bearer ".TOKEN;

        public function search($filter){
            $uri = $this->constructUri($filter);
        }

        private function constructUri($filter){
            $terms = $filter['terms'];

            $uri = "https://api.vimeo.com/";
            $uri = $uri . "tags/" . searchul . "/videos";
           
            return $uri;
        }

        public function getInitialVideos(){
            $videoUrl = URL."tags/programing/videos";
            $authorizationToken = $this->authToken;

            $result = Utils::fetchDataWithToken($videoUrl,$authorizationToken);
            return $result;

        }

        public function getAllCategories(){
            $categoriesUrl = URL."categories";
            $authorizationToken = $this->authToken;

            $result = Utils::fetchDataWithToken($categoriesUrl, $authorizationToken);
            return $result;
        }

        public function getVideoSearched(){
            $videoTerm = 
            $videoSearchUrl = URL."tags/". ."/videos";
        }
    }
?>