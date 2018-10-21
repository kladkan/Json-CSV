<?php
$json = file_get_contents(__DIR__ . '/phone.json');
$data = json_decode($json, true);
?>

<html>
<head>
    <meta charset="utf-8" />
    <title>Телефонная книжка</title>
</head>
<body>
    <table>
    <?php foreach ($data as $i => $var) : ?>
    <?php echo var_dump($var); exit; ?>
    
        <tr>
            <td><?php echo $i+1 ?></td>
            <td><?php echo $var['firstName'] ?></td>
            <td><?php echo $var['lastName'] ?></td>
            <td><?php echo $var['address'] ?></td>
            <td><?php echo $var['phoneNumber'] ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>