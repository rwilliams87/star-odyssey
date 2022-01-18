<?php
include('connection.php');

$getAllUsers = $connection -> prepare('SELECT * FROM users');
$getAllUsers -> execute();
$allUsers = $getAllUsers -> fetchAll();

// Money and Population
    // Prepares
    $cGetResources = $connection -> prepare('SELECT * FROM resources WHERE id = ?');
    $cUpdateResources = $connection -> prepare ('UPDATE resources SET civilians = ?, money = ? WHERE id = ?');
foreach ($allUsers as $whatever) {
    // $cGetResources = $connection -> prepare('SELECT * FROM resources WHERE id = ?');
    $cGetResources -> execute([$whatever[0]]);
    $cResources = $cGetResources -> fetch();
    if ($cResources['civilians'] < 10) {
        $cNewPopulation = $cResources['civilians'] + 10;
    } else {
        $cNewPopulation = $cResources['civilians'] * 1.1 + 10;
    }
    $cNewMoney = $cResources['civilians'] * 1.05;
    // $cUpdateResources = $connection -> prepare ('UPDATE resources SET civilians = ?, money = ? WHERE id = ?');
    $cUpdateResources -> execute ([$cNewPopulation, $cNewMoney, $whatever[0]]);
}

?>