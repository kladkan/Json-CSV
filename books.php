<?php
ini_set('display_errors', 1);
ini_set('errors_reporting', E_ALL);
$data = $argv;
$book = array_slice($data , 1);
$book = implode(" ", $book);
$encode = urlencode($book);
$url = 'https://www.googleapis.com/books/v1/volumes?q={'.$encode.'}';
$response = file_get_contents("$url");
if ($response === false) { // проверить на ошибки загрузки ФУНКЦИЯ JSON_LAST_ERROR
    $response = file_get_contents("./books.json");
}
$content = json_decode($response, true);


foreach ($content as $key => $value) {
    if (is_array($value)) {
        //echo $key;
        foreach ($value as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key => $value) {                    
                    switch ($key) {
                        case "id":
                            echo $value.', ';
                            break;
                        case "volumeInfo":
                            foreach ($value as $key => $value) {
                                switch ($key) {
                                    case "title":
                                        echo $value.', ';
                                        break;
                                    case "authors":
                                        $authors = implode(",", $value);
                                        echo $authors."\n";
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                            }
                            break;
                        default:
                            # code...
                            break;
                    } 
                }
            }
        }
        
    }
}



?>