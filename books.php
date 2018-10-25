<?php
ini_set('display_errors', 1);
ini_set('errors_reporting', E_ALL);
$data = $argv;
if (count($data) == 1) {
    echo "\nАргумент скрипта (поисковый запрос) не указан! Запустите скрипт с поисковым запросом.\n";
    exit;
}
$book = array_slice($data , 1);
$book = implode(" ", $book);
$encode = urlencode($book);
$url = 'https://www.googleapis.com/books/v1/volumes?q={'.$encode.'}';
$response = file_get_contents("$url");
$content = json_decode($response, true);
//print_r($content); exit;
switch (json_last_error()) {
    case JSON_ERROR_NONE:
    echo " — Ошибок нет\n";
    break;
    case JSON_ERROR_DEPTH:
    echo ' — Достигнута максимальная глубина стека';
    break;
    case JSON_ERROR_STATE_MISMATCH:
    echo ' — Некорректные разряды или несоответствие режимов';
    break;
    case JSON_ERROR_CTRL_CHAR:
    echo ' — Некорректный управляющий символ';
    break;
    case JSON_ERROR_SYNTAX:
    echo ' — Синтаксическая ошибка, некорректный JSON';
    break;
    case JSON_ERROR_UTF8:
    echo ' — Некорректные символы UTF-8, возможно неверно закодирован';
    break;
    default:
    echo ' — Неизвестная ошибка';
    break;
    }
/*
if (json_last_error() === JSON_ERROR_NONE) {
    foreach ($content['items'] as $book) {
        $authors = (!empty($book['volumeInfo']['authors'][0])) ? $book['volumeInfo']['authors'][0] : '';
        $id = (!empty($book['id'])) ? $book['id'] : '';
        $title = (!empty($book['volumeInfo']['title'])) ? $book['volumeInfo']['title'] : '';
        $rec = file_put_contents("books.csv", [$id.',', $title.',', $authors."\n"], FILE_APPEND | LOCK_EX);
    }
*/

function getValue($arg) {
    // возвращает сам элемент (если он не пуст) или пустую строку
    return (!empty($arg)) ? $arg : '';
}

if (json_last_error() === JSON_ERROR_NONE) {
    
    foreach ($content['items'] as $book) {
        $authors = getValue($book['volumeInfo']['authors'][0]);
        $id = getValue($book['id']);
        $title = getValue($book['volumeInfo']['title']);
        $rec = file_put_contents("books.csv", [$id.',', $title.',', $authors."\n"], FILE_APPEND | LOCK_EX);
    }
    
    //Выводим отладочную информацию в браузер
    if ($rec !== false) {
        echo 'Данные о книгах записаны в файл books.csv';
    } else {
        echo 'Ошибка записи файла books.csv';
    }
}
?>