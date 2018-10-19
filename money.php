<?php
//var_dump($argv);
$data = $argv;
if (count($data) == 2) {
if ($data[1] == '--today') {
    if (file_exists('data.csv')) {
      $data = file("./data.csv", FILE_IGNORE_NEW_LINES);
      //echo "est file\n";
      //print_r($data);
      if ($data == null) {
        echo "\n".'Нет данных о покупках. Запустите скрипт с аргументами {цена} и {описание покупки}'."\n";
      } else {
          //print_r($data);
          foreach ($data as $key => $row) {
            $list[] = explode(',', $row);
          }
          //print_r($list);
          $total = 0.00;
          foreach ($list as $key => $val) {
            foreach ($val as $keyin => $value) {
              if ($value === date('d.m.Y')) {
                 if ($keyin = 1) {
                   $total = $total + $val[$keyin];
                 }
              }
            }
          }
          echo "\n".date('d.m.Y').' расход за день: '.number_format($total, 2, '.', '')."\n";
        }
    } else {
      echo "\n".'Нет покупок или файл не найден. Запустите скрипт с аргументами {цена} и {описание покупки}'."\n";
    }
  } else {
    echo "\n".'Аргументы указаны неверно! Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}'."\n";
  }
exit;
}

if (count($data) > 2) {
  if ((int)$data[1] == 0) {
    echo "\n".'Данные о покупке введены неверно! Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}'."\n";
  } else {
    //print_r($data);
    $data2words = array_slice($data , 2); // массив: prazdnik keks
    //print_r($data2words);
    $data2words_string = implode(" ", $data2words); // получаем строку prazdnik keks
    //print_r($data2words_string);
    $data = array_slice($data, 1); //удаляем из первоначального массива название файла
    //print_r($data);// получаем массив '256.00', 'prazdnik', 'keks'
    array_splice($data, 1);//удаляем из массива все начиная со второй ячейки
    //print_r($data);//получаем 256.00
    array_unshift($data, date('d.m.Y'));
    //print_r($data);
    $data[] = $data2words_string."\n";
    //print_r($data);
    for ($i = 0; $i < 2; $i++) {
      $data[$i] = $data[$i].',';
    }
    //print_r($data);
    $lastdata = implode(" ", $data);

    $filedata = "data.csv";
    $resource = fopen($filedata, "a+");
    file_put_contents($filedata, $data, FILE_APPEND | LOCK_EX);
    $getdata = file("./data.csv", FILE_IGNORE_NEW_LINES);
    //print_r($getdata);
    echo "\n".'Добавлена строка: '.$lastdata."\n";
  }
} else {
  echo 'Ошибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}';
}

?>
