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
        $start = $filter['start'];
        $max_results = $filter['max_results'];

        $uri = 'http://export.arxiv.org/api/query?';
        $uri = $uri . 'search_query=ti:"' . urlencode($terms) . '"';
        $uri = $uri . '&sortBy=' . urlencode($sortBy);
        $uri = $uri . '&sortOrder=' . urlencode($sortOrder);
        $uri = $uri . '&start=' . urlencode($start);
        $uri = $uri . '&max_results=' . urlencode($max_results);

        return $uri;
    }

    private function constructArticles($data, $filter){
        // This section of code was extracted in Utils::xmlToDictionary(xmlData)
        $array = Utils::xmlToDictionary($data);
        $articles = [];

        if(is_array($array) || is_object($array)) {
          foreach ($array['entry'] as $item) {
            $article = $this->constructArticle($item);
            array_push($articles, $article);
          }
        }

        return $articles;
    }


    private function constructArticle($item){
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
            return Utils::truncateDescription($description, 450);
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

    private function getAuthors($item){
        // echo '<pre>' , var_dump($item) , '</pre>';
        if(isset($item['author'])){
            if(isset($item['author']['name']))
                return $item['author']['name'];
            if(isset($item['author'][0]['name']))
                return $item['author'][0]['name'];
        } else {
            return ['No authors available.'];
        }
    }

}

?>
