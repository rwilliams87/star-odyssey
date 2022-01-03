<?php
include('../includes/config.php');
session_start();
if(!isset($_SESSION['id'])) {
    header ('Location: logout.php');
    exit;
} else {
    $getinfo = $connection -> prepare('SELECT * FROM users WHERE id = ?');
    $getinfo -> execute([$_SESSION['id']]);
    $info = $getinfo -> fetch();
?>

<html>
    <head>
        <title>Star Odyssey -> Main</title>
        <link rel='stylesheet' href='../css/internal.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h1>User ID: <?=$info['id']?> </h1>
    <h1>Email Address: <?=$info['email']?></h1>
    <h1>Empire Name: <?=$info['username']?> </h1>
</body>
</html>










<?php } ?>