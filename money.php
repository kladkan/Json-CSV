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
        echo "\n".'Net dannyh o pokupkah. Vvedite dannye v formate {cena} {opisanie}'."\n";
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
          echo "\n".date('d.m.Y').' rashod za den: '.number_format($total, 2, '.', '')."\n";
        }
    } else {
      echo 'not faila ili pashodov ne bylo';
    }
  } else {
    echo 'Argumenty zadany ne verno! Ukagite flag --today ili zapustite skript s argumentami {cena} b {opisanie pokupki}';
  }
exit;
}
//конец проверки за день

if (count($data) > 2) {
  if ((int)$data[1] == 0) {
    echo 'Dannye o pokypke vvedeny ne verno! Ukagite flag --today ili zapustite skript s argumentami {cena} b {opisanie pokupki}';
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
    echo "\n".'dobavlena stroka: '.$lastdata."\n";
  }
} else {
  echo 'Oshibka! Argumenty ne zadany. Ukagite flag --today ili zapustite skript s argumentami {cena} b {opisanie pokupki}';
}
echo "\nend";
?>
