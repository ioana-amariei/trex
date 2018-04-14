<?php
/*  Resources:
1. http://php.net/manual/ro/language.exceptions.php
2. https://stackoverflow.com/questions/4258557/limit-text-length-in-php-and-provide-read-more-link
*/

require_once ($_SERVER['DOCUMENT_ROOT'] . '/Trex-Topic-based-Resource-eXplorer-/php/model/Resource.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/Trex-Topic-based-Resource-eXplorer-/php/util/Utils.php');

class Books {

    public function search($filter){
        $uri = $this->constructUri($filter);
        $data = Utils::fetchData($uri);
        $books = $this->constructBooks($data, $filter);

        return $books;
    }

    private function constructUri($filter){
        return 'https://www.googleapis.com/books/v1/volumes?maxResults=40&q=' . urlencode($filter['terms']);
    }

    private function constructBooks($data, $filter){
        // Takes a JSON encoded string and converts it into a PHP variable.
        $resources = json_decode($data, $assoc = TRUE);
        $books = [];

        foreach ($resources['items'] as $item) {
            $book = $this->constructBook($item);
            if($this->satisfiesFilter($book, $filter)){
                array_push($books, $book);
            }
        }

        return $books;
    }

    private function satisfiesFilter($book, $filter){
        if(round($book->getRating()) < $filter['minimumRating']){
            return FALSE;
        }

        return TRUE;
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
            $description = $item['volumeInfo']['description'];
            return Utils::truncateDescription($description, 500);
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
            // return default no cover image
            return 'https://books.google.ro/googlebooks/images/no_cover_thumb.gif';
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
