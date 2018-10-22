<?php
$json = file_get_contents(__DIR__ . '/phone2.json');
$data = json_decode($json, true);
?>

<html>
<head>
    <meta charset="utf-8" />
    <title>Телефонная книжка</title>
</head>
<body>
    <table>
        <tr>
            <td>Номер</td>
            <td>Имя</td>
            <td>Фамилия</td>
            <td>Город</td>
            <td>Улица</td>
            <td>Дом</td>
            <td>Телефоны</td>
        </tr>
        <?php foreach ($data as $i => $var) : ?>
        <tr>
            <td><?php echo $i+1 ?></td>
            <td><?php echo $var['firstName'] ?></td>
            <td><?php echo $var['lastName'] ?></td>
            <td><?php echo $var['address']['city'] ?></td>
            <td><?php echo $var['address']['street'] ?></td>
            <td><?php echo $var['address']['house'] ?></td>
            <td>
                <?php
                    $phoneNumbers = implode(", ", $var['phoneNumbers']);
                    echo $phoneNumbers;
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>