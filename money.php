<?php

//var_dump($argv);
//$data = $argv;
$data = ['money.php', '256.00', 'prazdnik', 'keks'];

print_r($data);
$data2words = array_slice($data , 2); // массив: prazdnik keks
print_r($data2words);
$data2words_string = implode(",", $data2words); // строка prazdnik,keks
print_r($data2words_string);
$data2words_string = str_replace (',', ' ', $data2words_string);
echo "\n $data2words_string";
$data = array_slice($data, 1); //удаляем из первоначального массива название файла
print_r($data);// получаем массив '256.00', 'prazdnik', 'keks'
array_splice($data, 1);//удаляем из массива все начиная со второй ячейки
print_r($data);//получаем 256.00
array_unshift($data, date('Y-m-d'));
print_r($data);
$data[] = "$data2words_string\n";
print_r($data);




/*
$filedata = "data.csv";
$resource = fopen($filedata, "a+");
file_put_contents($filedata, $data, FILE_APPEND | LOCK_EX);
$getdata = file("./data.csv", FILE_IGNORE_NEW_LINES);
print_r($getdata);
*/
/*черновик





черновик */
?>
