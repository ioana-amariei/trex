<?php
    require_once ('GenericResource.php');
    require_once ('../model/Resource.php');
    require_once ('../util/Utils.php');

    const TOKEN = "72936020ebb9949ae0e1d253cb7f87df";
    const URL = "https://api.vimeo.com/";

    class Videos implements GenericResource {
        private $authToken = "Authorization: Bearer ".TOKEN;

        public function getInitialVideos(){
            $videoUrl = URL."tags/programing/videos";
            $authorizationToken = $this->authToken;

            $headers = ['Content-Type: application/json', $authorizationToken];
            $result = Utils::fetchData($videoUrl, $headers);
            return $result;

        }

        public function search($term) {
            $videoSearchUrl = URL . 'tags/' . $term . '/videos';
            $authorizationToken = $this->authToken;

            $headers=['Content-Type: application/json', $authorizationToken];
            $result = Utils::fetchData($videoSearchUrl,$headers);
            return $result;
        }
    }
?>
