<?php
    require_once ('GenericResource.php');
    require_once ('../model/Resource.php');
    require_once ('../util/Utils.php');

    const TOKEN = "485edb4ec0295ef154c42b504c9a2862";
    const URL = "https://api.vimeo.com/";

    class Videos implements GenericResource {
        private $authToken = "Authorization: Bearer ".TOKEN;
        private $defaultNumberOfItems = 12;

        public function getInitialVideos(){
            $videoUrl = URL."tags/programing/videos";
            $authorizationToken = $this->authToken;

            $headers = ['Content-Type: application/json', $authorizationToken];
            $result = Utils::fetchData($videoUrl, $headers);
            return $result;

        }

        public function searchMore($term, $itemsPerPage) {
            $videoSearchUrl = URL . 'tags/' . $term . '/videos?per_page='.$itemsPerPage;
            $authorizationToken = $this->authToken;

            $headers=['Content-Type: application/json', $authorizationToken];
            $data = Utils::fetchData($videoSearchUrl,$headers);

            $videos = json_decode($data, true);

<<<<<<< HEAD
            return $videos;
=======
            return $videos['data'];
>>>>>>> 6f250d552127746d47c41c0dc05cfa847bb15d8e
        }

        public function search($term) {
            $this->searchMore($term, $this->defaultNumberOfItems);
        }
    }
?>
