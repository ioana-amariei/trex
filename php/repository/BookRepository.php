<?php
// Resources: http://php.net/manual/ro/language.exceptions.php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex2/php/repository/ResourceRepository.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex2/php/model/Resource.php');

class BookRepository implements ResourceRepository {

    public function search($terms){
        $uri = $this->constructUri($terms);
        $data = $this->fetchData($uri);
        $books = $this->constructBooks($data);

        return $books;
    }
    private function constructUri($terms){
        return 'https://www.googleapis.com/books/v1/volumes?q=' . urlencode($terms);
    }

    private function fetchData($uri){
        // Reference: http://thisinterestsme.com/send-get-request-with-php/
        //Initialize cURL.
        $ch = curl_init();

        //Set the URL that you want to GET by using the CURLOPT_URL option.
        curl_setopt($ch, CURLOPT_URL, $uri);

        //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        try {
            //Execute the request.
            $data = curl_exec($ch);
        } catch (Exception $e) {
            return [];
        }

        //Close the cURL handle.
        curl_close($ch);

        return $data;
    }

    private function constructBooks($data){
        // Takes a JSON encoded string and converts it into a PHP variable.
        $resources = json_decode($data, $assoc = TRUE);
        $books = [];

        foreach ($resources['items'] as $item) {
            $book = $this->constructBook($item);
            array_push($books, $book);
        }

        return $books;
    }


    private function constructBook($item){
        $book = new Resource();
        $book->setType('book');
        $book->setTitle($this->getTitle($item));
        $book->setDescription($this->getDescription($item));
        $book->setAuthors($this->getAuthors($item));
        $book->setImage($this->getImage($item));
        $book->setLanguage($this->getLanguage($item));
        $book->setDate($this->getDate($item));
        $book->setUrl($this->getUrl($item));
        $book->setTags($this->getTags($item));
        $book->setRating($this->getRating($item));

        return $book;
    }

    private function getTitle($item){
        if(isset($item['volumeInfo']['title'])){
            return $item['volumeInfo']['title'];
        } else {
            return 'The title is not available.';
        }
    }

    private function getDescription($item){
        if(isset($item['volumeInfo']['description'])){
            return $item['volumeInfo']['description'];
        } else {
            return 'The description is not available.';
        }
    }

    private function getLanguage($item){
        if(isset($item['volumeInfo']['language'])){
            return $item['volumeInfo']['language'];
        } else {
            return '';
        }
    }

    private function getUrl($item){
        if(isset($item['volumeInfo']['infoLink'])){
            return $item['volumeInfo']['infoLink'];
        } else {
            return '';
        }
    }

    private function getDate($item){
        if(isset($item['volumeInfo']['publishedDate'])){
            return $item['volumeInfo']['publishedDate'];
        } else {
            return 'The publication date is not available.';
        }
    }

    private function getRating($item){
        if(isset($item['volumeInfo']['averageRating'])){
            return $item['volumeInfo']['averageRating'];
        } else {
            return 0;
        }
    }

    private function getImage($item){
        if(isset($item['volumeInfo']['imageLinks']['smallThumbnail'])){
            return $item['volumeInfo']['imageLinks']['smallThumbnail'];
        } else {
            return 'The image is not available.';
        }
    }

    private function getAuthors($item){
        if(isset($item['volumeInfo']['authors'])){
            return $item['volumeInfo']['authors'];
        } else {
            return ['No authors available.'];
        }
    }

    private function getTags($item){
        if(isset($item['volumeInfo']['categories'])){
            return $item['volumeInfo']['categories'];
        } else {
            return [];
        }
    }


}

?>
