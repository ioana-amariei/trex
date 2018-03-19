<?php

class Resource implements JsonSerializable {
    private $type;
    private $title;
    private $description;
    private $author;
    private $image;
    private $tags;
    private $rating;
    private $date;
    private $language;

    public function setType($type) {
        $this->type;
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

    public function getDescription() {
        return $this->description;
    }

    public function jsonSerialize() {
        $json = [];
        foreach($this as $key => $value) {
            $json[$key] = $value;
        }

        return json_encode($json);
    }
}


 ?>
