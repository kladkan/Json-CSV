<?php
ini_set('display_errors', 1);
ini_set('errors_reporting', E_ALL);
$data = $argv;
if (count($data) == 1) {
    echo "\n".'Аргумент скрипта (поисковый запрос) не указан! Запустите скрипт с поисковым запросом.'."\n";
    exit;
}
$book = array_slice($data , 1);
$book = implode(" ", $book);
$encode = urlencode($book);
$url = 'https://www.googleapis.com/books/v1/volumes?q={'.$encode.'}';
$response = file_get_contents("$url");
$content = json_decode($response, true);
switch (json_last_error()) {
    case JSON_ERROR_NONE:
    echo ' — Ошибок нет'."\n";
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

foreach ($content as $key => $value) {
    if (is_array($value)) {
        //echo $key;
        foreach ($value as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key => $value) {                    
                    switch ($key) {
                        case "id":
                            //echo $value.', ';
                            $table[0] = $value.',';
                            break;
                        case "volumeInfo":
                            foreach ($value as $key => $value) {
                                switch ($key) {
                                    case "title":
                                        //echo $value.', ';
                                        $table[1] = $value.',';
                                        break;
                                    case "authors":
                                        $authors = implode(",", $value);
                                        //echo $authors."\n";
                                        $table[2] = $authors."\n";
                                        //print_r($table);
                                        $rec = file_put_contents("books.csv", $table, FILE_APPEND | LOCK_EX);
                                        break;
                                }
                            }
                            break;
                    } 
                }
            }
        }
    }
}

//Выводим отладочную информацию в браузер
if ($rec !== false) {
    echo "Данные о книгах записаны в файл books.csv";
} else {
    echo "Ошибка записи файла books.csv";
}
?>