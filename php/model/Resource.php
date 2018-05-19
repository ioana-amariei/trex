<?php

class Resource implements JsonSerializable {
    private $type;
    private $title;
    private $description;
    private $authors;
    private $image;
    private $tags;
    private $rating;
    private $date;
    private $language;
    private $url;

    public function setType($type) {
        $this->type = $type;
    }

    public function getRating(){
        return $this->rating;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getUrl(){
        return $this->url;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getType() {
        return $this->type;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setAuthors($authors) {
        $this->authors = $authors;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setTags($tags) {
        $this->tags = $tags;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getDate(){
        return $this->date;
    }

    public function setLanguage($language) {
        $this->language = $language;
    }

    // https://stackoverflow.com/questions/9896254/php-class-instance-to-json
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
?>
