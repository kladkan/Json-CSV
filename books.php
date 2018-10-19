<?php
$data = $argv;
$book = array_slice($data , 1);
$book = implode(" ", $book);
$encode = urlencode($book);
$url = 'https://www.gogleapis.com/books/v1/volumes?q={'.$encode.'}';
$response = @file_get_contents("$url");
if ($response === false) {
    $response = file_get_contents("./books.json");
    $content = json_decode($response, true)["content"];
} else {
    $cache = [
        "date" => date("d.m.Y"),
        "content" => $content
    ];
    file_put_contents("./books.json", json_encode($cache));
}
$content = json_decode($response, true);
print_r($content);


?>