<?php
    require_once ('GenericResource.php');
    require_once ('../model/Resource.php');
    require_once ('../util/Utils.php');

    const URL = "https://www.googleapis.com/youtube/v3";
    const API_KEY = "AIzaSyBEE0ipyjSsbnxEsLcqSM0iBUwEQcC0N-A";

    class Videos implements GenericResource {
        private $videos;

        public function search($term) {
            $uri = URL . "/search?part=snippet&q=".$term."&type=video&maxResults=10&key=".API_KEY;
            $data = json_decode(Utils::fetchData($uri), true);
            $videos = $this->constructVideos($data);
    
            return $videos;
        }

        private function constructVideos($data) {
            $videos = [];

            if(is_array($data) || is_object($data)) {
                foreach ($data['items'] as $video) {
                    $video = $this->constructVideo($video);
                    array_push($videos, $video);
                }
            }

            return $videos;
        }

        private function constructVideo($item) {
            $video = new Resource();
            $video->setType('video');
            $video->setTitle($this->getTitle($item));
            $video->setDescription($this->getDescription($item));
            $video->setAuthors($this->getAuthors($item));
            $video->setDate($this->getDate($item));
            $video->setUrl($this->getUrl($item));
            $video->setImage($this->getImage($item));

            return $video;
        }

        private function getImage($item){
            if(isset($item['snippet']['title'])){
                return $item['snippet']['title'];
            } else {
                return 'The title is not available.';
            }
        }

        private function getTitle($item){
            if(isset($item['snippet']['title'])){
                return $item['snippet']['title'];
            } else {
                return 'The title is not available.';
            }
        }
    
        private function getDescription($item){
            if(isset($item['snippet']['description'])){
                $description = $item['snippet']['description'];
                return Utils::truncateDescription($description, 450);
            } else {
                return 'The description is not available.';
            }
        }
    
        private function getUrl($item){
            if(isset($item['snippet']['url'])){
                return "https://www.youtube.com/watch?v=".$item['url'];
            } else {
                return '';
            }
        }
    
        private function getDate($item){
            if(isset($item['snippet']['date'])){
                return $item['snippet']['date'];
            } else {
                return 'The publication date is not available.';
            }
        }
    
        private function getAuthors($item){
            if(isset($item['snippet']['author'])){
                return $item['snippet']['author'];
            } else {
                return ['No authors available.'];
            }
        }
    }
?>
