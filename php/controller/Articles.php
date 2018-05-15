<?php

require_once ('GenericResource.php');
require_once ('../model/Resource.php');
require_once ('../util/Utils.php');

class Articles implements GenericResource {

    public function search($filter){
        $uri = $this->constructUri($filter);
        $data = Utils::fetchData($uri);
        $books = $this->constructArticles($data, $filter);

        return $books;
    }

    private function constructUri($filter){
        $terms = $filter['terms'];
        $sortBy = $filter['sortBy'];
        $sortOrder = $filter['sortOrder'];

        $uri = 'http://export.arxiv.org/api/query?';
        $uri = $uri . 'search_query=ti:"' . urlencode($terms) . '"';
        $uri = $uri . urlencode($sortBy);
        $uri = $uri . urlencode($sortOrder);

        return $uri;
    }

    private function constructArticles($data, $filter){
        // Takes a XML encoded string and converts it into JSON then into a PHP variable.

        $xml = simplexml_load_string($data);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);

        $articles = [];

        foreach ($array['entry'] as $item) {
            $article = $this->constructBook($item);
            array_push($articles, $article);
        }

        return $articles;
    }


    private function constructBook($item){
        $article = new Resource();
        $article->setTitle($this->getTitle($item));
        $article->setDescription($this->getDescription($item));
        $article->setAuthors($this->getAuthors($item));
        $article->setDate($this->getDate($item));
        $article->setUrl($this->getUrl($item));

        return $article;
    }

    private function getTitle($item){
        if(isset($item['title'])){
            return $item['title'];
        } else {
            return 'The title is not available.';
        }
    }

    private function getDescription($item){
        if(isset($item['summary'])){
            $description = $item['summary'];
            return Utils::truncateDescription($description, 500);
        } else {
            return 'The description is not available.';
        }
    }

    private function getUrl($item){
        if(isset($item['link'])){
            return $item['link'];
        } else {
            return '';
        }
    }

    private function getDate($item){
        if(isset($item['published'])){
            return $item['published'];
        } else {
            return 'The publication date is not available.';
        }
    }

    private function getImage($item){
        if(isset($item['volumeInfo']['imageLinks']['smallThumbnail'])){
            return $item['volumeInfo']['imageLinks']['smallThumbnail'];
        } else {
            // return default no cover image
            return 'images/article/dn_bg.png';
        }
    }

    private function getAuthors($item){
        if(isset($item['author']['name'])){
            return $item['author']['name'];
        } else {
            return ['No authors available.'];
        }
    }

}

?>