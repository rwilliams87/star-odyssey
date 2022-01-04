<?php
// Include the configuration.
include('config.php');
// Start the session.
session_start();
// If $_SESSION['id'] is not set...log out.
// If it is, $id is the player's ID.
if(!isset($_SESSION['id'])) {
    header ('Location: logout.php');
    exit;
} else {
    $id = $_SESSION['id'];
}
?>