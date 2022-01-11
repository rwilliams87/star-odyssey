<?php
// Include the configuration.
include('connection.php');
// Start the session.
session_start();
// If $_SESSION['id'] is not set...log out.
// If it is, $id is the player's ID.
if(!isset($_SESSION['id'])) {
    header ('Location: ../../site/logout.php');
    exit;
} else {
    $id = $_SESSION['id'];
}
// Let's get some information for the top banner.
// The top banner will be on every page, so we'll need the info no matter what.
$getinfo = $connection -> prepare('SELECT * FROM users WHERE id = ?');
$getinfo -> execute([$id]);
$info = $getinfo -> fetch();
// Get Resources.
$getresources = $connection -> prepare('SELECT * FROM resources WHERE id = ?');
$getresources -> execute([$id]);
$resources = $getresources -> fetch();
// Calculate Population
$population = $resources['civilians'] + $resources['soldiers'] + $resources['engineers'] + $resources['scientists'];
// Get Empire Coordinates
$getcoords = $connection -> prepare('SELECT * FROM sectors WHERE belongs_to = ? AND home_sector = ?');
$getcoords -> execute([$id, 1]);
$coords = $getcoords -> fetch();
// TODO: GET MESSAGES AND NEWS ALERTS HERE, FOR THE TOP BANNER.
?>