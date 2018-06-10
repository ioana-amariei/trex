<?php
/*  Resources:
1. http://php.net/manual/ro/language.exceptions.php
2. https://stackoverflow.com/questions/4258557/limit-text-length-in-php-and-provide-read-more-link
*/

require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex/php/controller/GenericResource.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex/php/model/Resource.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/trex/php/util/Utils.php');

class Books implements GenericResource {

    public function search($filter){
        $data = $this->fetchBooks($filter);
        $books = $this->constructBooks($data, $filter);

        return $books;
    }

    private function fetchBooks($filter){
        $availableBooksNumber = $this->getAvailableBooksNumber($filter);
        $availableBooksNumber = 200;

        $allBooks = [];
        $startIndex = 0;

        while($startIndex < $availableBooksNumber){
            $filter['startIndex'] = $startIndex;
            $filter['maxResults'] = 40;
            $uri = $this->constructUri($filter);
            $data = $this->fetchDataAsDictionary($uri);

            $books = isset($data['items']) ? $data['items'] : [];

            foreach ($books as $book) {
                array_push($allBooks, $book);
            }

            $startIndex = $startIndex + 40;
        }

        return $allBooks;
    }

    private function getAvailableBooksNumber($filter){
        $filter['startIndex'] = 0;
        $filter['maxResults'] = 5;

        $uri = $this->constructUri($filter);
        $data = $this->fetchDataAsDictionary($uri);

        return isset($data['totalItems']) ? $data['totalItems'] : 0;
    }

    private function fetchDataAsDictionary($uri) {
        $jsonData = Utils::fetchData($uri);
        return Utils::jsonToDictionary($jsonData);
    }
    private function constructUri($filter){
        $terms = $filter['terms'];
        $language = $filter['language'];
        $startIndex = $filter['startIndex'];
        $maxResults = $filter['maxResults'];

        $uri = 'https://www.googleapis.com/books/v1/volumes?';
        $uri = $uri . 'key=' . 'AIzaSyBNmgyg36km1Tj64G97DrkYr8aHcJ7xwOA';
        $uri = $uri . '&startIndex=' . $startIndex;
        $uri = $uri . '&maxResults=' . $maxResults;
        $uri = $uri . '&q=' . urlencode($terms);
        if($language !== 'any'){
            $uri = $uri . '&langRestrict=' . $language;
        }

        return $uri;
    }

    private function constructBooks($books, $filter){
        $filteredBooks = [];

        foreach ($books as $book) {
            $book = $this->constructBook($book);
            if($this->satisfiesFilter($book, $filter)){
                array_push($filteredBooks, $book);
            }
        }

        return $filteredBooks;
    }

    private function satisfiesFilter($book, $filter){
        if(round($book->getRating()) < $filter['minimumRating']){
            return FALSE;
        }

        $from = $filter['from'];
        $to = $filter['to'];
        $year = $book->getDate();

        if($year !== NULL){
            if(strlen($year) > 0){
                $year = intval(substr($year, 0, 4));

                if(is_numeric($from)){
                    if($year < $from){
                        return FALSE;
                    }
                }

                if(is_numeric($to)){
                    if($year > $to){
                        return FALSE;
                    }
                }
            }
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
