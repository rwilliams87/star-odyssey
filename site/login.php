<?php
session_start();
include('includes/connection.php');
$screenflash = '';
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $getuserinfo = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $getuserinfo->execute([$email]);
    $userinfo = $getuserinfo->fetch(PDO::FETCH_ASSOC);
    if (!$userinfo) {
        $screenflash = "Incorrect email address or password.";
    } else {
        if (password_verify($password, $userinfo['password'])) {
            $_SESSION['id'] = $userinfo['id'];
            header('Location: ../main/main.php');
            exit;
        } else {
            $screenflash = "Incorrect email address or password.";
        }
    }
}
?>

<html>
<head>
    <title>Star Odyssey</title>
    <link rel='stylesheet' href='css/_parent.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h3>Please Enter Your Account Credentials</h3>

            <!-- Screenflash Area -->
            <?php if ($screenflash) { ?>
            <div class='screenflash'><?= $screenflash ?></div>
            <div class='spacing'></div>
            <?php } ?>
            <!-- End Screenflash Area -->

            <!-- Begin Form -->
            <form method='post' action='' name='signin'>
                <input type='text' placeholder='Email Address...' class='textbox' name='email'>
                <div class='spacing'></div>
                <input type='password' placeholder='Password...' class='textbox' name='password'>
                <div class='spacing'></div>
                <input type='submit' name='signin' value='Log In' class='button'>
            </form>
            <!-- End Form -->

            <div class='spacing'></div>
            <div class='spacing'></div>
            <div class='centering'><a href='signup.php'>Sign Up</a></div>
            <div class='spacing'></div>
            <div class='centering'><a href='forgotpassword.php'>Forgot Your Password?</a></div>
        </div>
    </div>
</body>
</html>