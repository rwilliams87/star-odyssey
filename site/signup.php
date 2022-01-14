<?php
session_start();
include('includes/connection.php');
$screenflash = "";
$flashchange = "";

// Check to see if form is submitted.
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $leadertitle = $_POST['leader_title'];
    $leadername = $_POST['leader_name'];

    // Check for matching passwords.
    if ($password == $password2) {
        $finalpassword = password_hash($password2, PASSWORD_BCRYPT);
    } else {
        $screenflash = "Your passwords do not match.";
        exit();
    }

    // Check for duplicate empire names.
    $checkusername = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $checkusername->execute([$username]);
    if ($checkusername->rowCount() > 0) {
        $screenflash = "This empire name already exists.";
        exit();
    }

    // Check for duplicate email addresses.
    $checkemail = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $checkemail->execute([$email]);
    if ($checkemail->rowCount() > 0) {
        $screenflash = "This email address is already registered.";
        exit();
    }

    // Check to see if password is too short.
    if (strlen($password) < 8) {
        $screenflash = "Passwords must be 8 characters or longer.";
    }

    // If everything is good to go...

    // Assign them a home sector.
    $defaultsector = 0;
    $checksectors = $connection -> prepare("SELECT * FROM sectors WHERE belongs_to = ?");
    $sectors = $checksectors -> execute([$defaultsector]);
    $sectorselect = rand(1, $checksectors -> rowCount());
    
    $doublechecksectors = $connection -> prepare("SELECT * FROM sectors WHERE sector_id = ?");
    $doublechecksectors -> execute([$sectorselect]);
    $doublecheck = $doublechecksectors -> fetch();
    if ($doublecheck['belongs_to'] != '0') {
        $screenflash = "Something went wrong with the sectors.";
        exit();
    }



    if ($screenflash == "") {
        $insert_users = $connection->prepare("INSERT INTO users (email, username, password, leader_title, leader_name, sector_id) VALUES (?, ?, ?, ?, ?, ?)");
        $users = $insert_users->execute([$email, $username, $finalpassword, $leadertitle, $leadername, $sectorselect]);
        // Check the Empire ID we just made...
        $getid = $connection -> prepare("SELECT id FROM users WHERE email = ?");
        $getid -> execute([$email]);
        $id = $getid -> fetch();
        // We're going to use that empire ID for the rest of the data we need to insert.
        $insert_resources = $connection -> prepare ("INSERT INTO resources (id) VALUES (?)");
        $resources = $insert_resources -> execute([$id['id']]);
        $insert_sectors = $connection -> prepare ("UPDATE sectors SET belongs_to = ?, home_sector = ? WHERE sector_id = ?");
        $sectors = $insert_sectors -> execute([$id['id'], 1, $sectorselect]);
        if ($users && $resources && $sectors) {
            $screenflash = "Your registration was successful.";
            $flashchange = "<script>document.getElementsByClassName('screenflash')[0].style.borderColor = 'green';</script>";
        } else {
            $screenflash = "Something went wrong.";
        }
    }
}
?>


<html>

<head>
    <title>Star Odyssey -> Sign Up</title>
    <link rel='stylesheet' href='css/_parent.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <!-- Stars -->
    <div id='stars'></div>
    <div id='stars2'></div>
    <div id='stars3'></div>
    <!-- End Stars -->
        <div class='container'>
        <div class='formwrapper'>
            <h1 class='letterspacing'>Star Odyssey</h1>
            <h3>Sign Up For A New Account</h3>

            <!-- Screenflash Area -->
            <?php if ($screenflash) { ?>
                <div class='screenflash'><?php if ($flashchange != "") { echo ($flashchange); } ?><?= $screenflash ?></div>
                <div class='spacing'></div>
            <?php } ?>
            <!-- End Screenflash Area -->

            <!-- Start Form Area -->
            <form method='post' action='' name='signup'>
                Email Address:<br>
                <input type='email' placeholder='Email Address' class='textbox' name='email'>
                <div class='spacing'></div>
                Empire Name:<br>
                <input type='text' placeholder='Empire Name' class='textbox' name='username'>
                <div class='spacing'></div>
                Password:<br>
                <input type='password' placeholder='Password' class='textbox' name='password'>
                <div class='spacing'></div>
                Repeat Password:<br>
                <input type='password' placeholder='Repeat Password' class='textbox' name='password2'>
                <div class='spacing'></div>
                Leader Name:<br>
                <select name='leader_title' class='textbox'>
                    <option value='Mr'>Mr.</option>
                    <option value='Mrs'>Mrs.</option>
                    <option value='President'>President</option>
                    <option value='Chancellor'>Chancellor</option>
                    <option value='Emperor'>Emperor</option>
                    <option value='Dictator'>Dictator</option>
                    <option value='Czar'>Czar</option>
                    <option value='King'>King</option>
                    <option value='Queen'>Queen</option>
                </select>
                <div class='spacing'></div>
                <input type='text' placeholder='Leader Name...' class='textbox' name='leader_name'>
                <div class='spacing'></div>
                <input type='submit' name='register' value='Sign Up' class='button'>
            </form>
            <!-- End Form Area -->

            <div class='spacing'></div>
            <div class='spacing'></div>
            <div class='centering'><a href='login.php'>Sign In</a></div>
            <div class='spacing'></div>
            <div class='centering'><a href='forgotpassword.php'>Forgot Your Password?</a></div>
        </div>
    </div>
</body>
</html>