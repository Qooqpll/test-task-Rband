<?php
require_once 'db.php';
require_once 'CreatorXml.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

$db = new DB();
$xml = new CreatorXml($db);
$xml->createXml();
$xml->getXml();
?>
</body>
</html>