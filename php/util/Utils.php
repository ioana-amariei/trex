<?php

class Utils {
    public static function fetchData($uri){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        try {
            $data = curl_exec($ch);
        } catch (Exception $e) {
            return [];
        }

        curl_close($ch);

        return $data;
    }

    public static function fetchDataWithToken($uri, $tokenAuthorization){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $tokenAuthorization ));
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        try {
            $data = curl_exec($ch);
        } catch (Exception $e) {
            return [];
        }

        curl_close($ch);

        return $data;
    }

    public static function truncateDescription($description, $length){
        if (strlen($description) > $length) {
            // truncate string
            $stringCut = substr($description, 0, $length);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $description = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
            $description .= '...';
        }
        return $description;
    }

}

?>
