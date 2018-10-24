<?php
//var_dump($argv);
$data = $argv;
if (count($data) == 2) {
if ($data[1] == '--today') {
    if (file_exists('money.csv')) {
      $data = file("./money.csv", FILE_IGNORE_NEW_LINES);
      //echo "est file\n";
      //print_r($data);
      if ($data == null) {
        echo "\nНет данных о покупках. Запустите скрипт с аргументами {цена} и {описание покупки}.\n";
      } else {
          //print_r($data);
          foreach ($data as $row) {
            $list[] = explode(',', $row);
          }
          $total = 0.00;
          foreach ($list as $row) {
             if ($row[0] === date('d.m.Y')) {
                if ($keyin = 1) {
                  $total += $row[1];
                }
             }
          }
          echo "\n".date('d.m.Y').' расход за день: '.number_format($total, 2, '.', '')."\n";
        }
    } else {
      echo "\nНет файла с информацией о покупках. Запустите скрипт с аргументами {цена} и {описание покупки}.\n";
    }
  } else {
    echo "\nАргументы указаны неверно! Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}.\n";
  }
exit;
}

if (count($data) > 2) {
  if ((int)$data[1] == 0) {
    echo "\nДанные о покупке введены неверно! Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}.\n";
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

    file_put_contents("money.csv", $data, FILE_APPEND | LOCK_EX);
    //$getdata = file("./money.csv", FILE_IGNORE_NEW_LINES);
    //print_r($getdata);
    echo "\nДобавлена строка: $lastdata\n";
  }
} else {
  echo "\nОшибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}.\n";
}

?>
