<?php
    session_start();
    include('includes/config.php');
    $screenflash = "";
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        if ($password == $password2) {
            $finalpassword = password_hash($password2, PASSWORD_BCRYPT);
        } else {
            $screenflash = "Your passwords do not match.";
        }
        $checkusername = $connection -> prepare ("SELECT * FROM users WHERE username = ?");
        $checkusername -> execute([$username]);
        if ($checkusername -> rowCount() > 0) {
            $screenflash = "This empire name / username already exists.";
        }
        $checkemail = $connection->prepare("SELECT * FROM users WHERE email = ?");
        $checkemail -> execute([$email]);
        if ($checkemail -> rowCount() > 0) {
            $screenflash = "This email address is already registered.";
        }
        if (!$screenflash) {
            $query = $connection -> prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $result = $query -> execute([$username, $email, $finalpassword]);

            $getid = $connection -> prepare("SELECT id FROM users WHERE email = ?");
            $getid -> execute([$email]);
            $id = $getid -> fetch();

            $pushresources1 = $connection -> prepare("INSERT INTO resources (id) VALUES (?)");
            $pushresources2 = $pushresources1 -> execute([$id['id']]);

            if ($result && $pushresources2) {
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
    <link rel='stylesheet' href='css/splash.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div id='stars'></div>
    <div id='stars2'></div>
    <div id='stars3'></div>
    <div class='container'>
        <div class='formwrapper'>
            <h1 class='letterspacing'>Star Odyssey</h1>
            <h3>Sign Up For A New Account</h3>
                <?php if ($screenflash) { ?>
                <div class='screenflash'>
                <?php if ($flashchange) { echo $flashchange; } ?>
                <?=$screenflash?></h3></div>
                <div class='spacing'></div>
                <?php } ?>
            <form method='post' action='' name='signup'>
            Email Address:<br>
            <input type='email' placeholder='Email Address' class='textbox' name='email'>
            <div class='spacing'></div>
            Empire Name: (This Will Be Your Username)<br>
            <input type='text' placeholder='Empire Name' class='textbox' name='username'>
            <div class='spacing'></div>
            Password:<br>
            <input type='password' placeholder='Password' class='textbox' name='password'>
            <div class='spacing'></div>
            Repeat Password:<br>
            <input type='password' placeholder='Repeat Password' class='textbox' name='password2'>
            <div class='spacing'></div>
            <input type='submit' name='register' value='Sign Up' class='button'>
            </form>
            <div class='spacing'></div>
            <div class='spacing'></div>
            <div class='centering'>
                <a href='splash.php'>Sign In</a>
            </div>
            <div class='spacing'></div>
            <div class='centering'>
               <a href='forgotpassword.php'>Forgot Your Password?</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>