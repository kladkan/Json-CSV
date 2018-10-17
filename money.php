<?php
  /*$filedata = "data.csv";
  $resource = fopen($filedata, "a+");
  $current = "новая информация";
  file_put_contents($filedata, $current);*/




//var_dump($argv);
//$data = array_slice($argv , 1);
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
$data[] = $data2words_string;
print_r($data);
-------------------------------------
//array_unshift( , "date('Y-m-d'");

/*//черновик
$row = 1;
$handle = fopen("data.csv", "r");
if ($handle !== FALSE) {
  $data = fgetcsv($handle, 1000, ",");
  while ($data !== FALSE) {
    $num = count($data);
    echo "<p> $num полей в строке $row:</p>\n";
    $row++;
    for ($c=0; $c < $num; $c++) {
      echo $data[$c] . "<br />\n";
    }
    $data = fgetcsv($handle, 1000, ",");
}
fclose($handle);
}
//черновик
*/




?>
