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
    <?php foreach ($data as $i => $var) : ?>
    <?php// echo print_r($data); exit; ?>
    
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