<?php
	$country = $argv;
	$file = fopen("https://raw.githubusercontent.com/netology-code/php-2-homeworks/master/files/countries/opendata.csv", "r");
		if ($file == true) {
			for ($i = 1; $i > 0; $i++) {
				$array_row = fgetcsv($file, 1000, ",");
				if ($array_row == true) {
					if ($array_row[1] == $country[1]) {
						echo $country[1].': '.$array_row[4];
						fclose($file);
						exit;
					}
				} else {
					echo 'Страна не найдена или допущена ошибка в названии';
					exit;
				}
			}
		}else {
			echo 'Источник недоступен!';
		}
?>