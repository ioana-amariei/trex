<?php
    require_once ('GenericResource.php');
    require_once ('../model/Resource.php');
    require_once ('../util/Utils.php');

    const TOKEN = "099f5c351f4d66f68ba5b8a5e5524306";
    const URL = "https://api.vimeo.com/videos";

    class Videos implements GenericResource {
        private $authToken = "Authorization: Bearer ".TOKEN;
        private $defaultNumberOfItems = 12;

        private function constructSearchURL($term, $itemsPerPage) {
            $videoSearchUrl = URL . '?fields=name,pictures,link,description,duration';
            $videoSearchUrl = $videoSearchUrl . '&query=' .  $term;
            $videoSearchUrl = $videoSearchUrl . '&per_page=' . $itemsPerPage;

            return $videoSearchUrl;
        }

        public function searchMore($term, $itemsPerPage) {
            $videoSearchUrl = $this->constructSearchURL($term, $itemsPerPage);
            $authorizationToken = $this->authToken;

            $headers=['Content-Type: application/json', $authorizationToken];
            $data = Utils::fetchData($videoSearchUrl,$headers);

            $videos = json_decode($data, true);

            return $videos;
        }

        public function search($term) {
            $this->searchMore($term, $this->defaultNumberOfItems);
        }
    }
?>
