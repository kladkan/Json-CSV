<?php
	$country = $argv;
	if (count($country) >= 2) {
		if (count($country) > 2) {
			$longname = array_slice($country, 1);
			$longname = implode(" ", $longname);
			array_splice($country, 1);
			$country [] = $longname;
		}
		$file = @fopen("https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8", "r");
		if ($file === false) {
			$file = fopen("https://raw.githubusercontent.com/netology-code/php-2-homeworks/master/files/countries/opendata.csv", "r");
		}

		if (fgetcsv($file, 1000, ",") == false && fgetcsv($file, 1000, ",") == null) {
			echo 'Файл-источник имеет неправильный формат';
			exit;
		}

		if ($file == true) {
			for ($i = 1; $i > 0; $i++) {
				$array_row = fgetcsv($file, 1000, ",");
				if ($array_row == true) {
					if ($array_row[1] == $country[1]) {
						echo "\nСтрана: {$country[1]}. Режим въезда с общегражданским паспортом: {$array_row[4]}.\n";
						fclose($file);
						exit;
					}
				} else {
					echo "\nСтрана не найдена или допущена ошибка в названии.\n";
					exit;
				}
			}
		} else {
			echo "\nИсточник недоступен! Обратитесь позднее.\n";
		}
	} else {
		echo "\nОшибка! Аругмент скрипта не задан. Введите название страны.\n";
	}
?>