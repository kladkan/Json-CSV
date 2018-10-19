<?php
$data = $argv;
$book = array_slice($data , 1);
$book = implode(" ", $book);
$encode = urlencode($book);
$url = 'https://www.googleapis.com/books/v1/volumes?q={'.$encode.'}';
$response = file_get_contents("$url");
$content = json_decode($response, true);
//print_r($content);
file_put_contents("./books.json", $response);

?>