<?php

class ArticleJSON implements JsonSerializable {
    private $title;
    private $description;
    private $authors;
    private $date;
    private $url;

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getUrl(){
        return $this->url;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setAuthors($authors) {
        $this->author = $authors;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getDate(){
        return $this->date;
    }

    public function jsonSerialize() {
        $json = [];
        foreach($this as $key => $value) {
            $json[$key] = $value;
        }

        return json_encode($json);
    }
}