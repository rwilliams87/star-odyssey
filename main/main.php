<?php include('../includes/header.php'); ?>
<?php
    // Let's gather some information using the $id of the player.
    $getinfo = $connection -> prepare('SELECT * FROM users WHERE id = ?');
    $getinfo -> execute([$id]);
    $info = $getinfo -> fetch();
    // Calculate Population
    $population = $info['civilians'] + $info['soldiers'] + $info['miners'] + $info['scientists'];
    ?>

<html>
    <head>
        <title>Star Odyssey -> Main</title>
        <link rel='stylesheet' href='../css/internal.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

<!--
<div class="parent">
<div class="div1"> </div>
<div class="div2"> </div>
<div class="div3"> </div>
<div class="div4"> </div>
</div>
-->
    <!-- Start Frame -->
    <div class='parent'>
    <!-- Start Header -->
    <div class='header'>
    <table width='100%'>
        <tr>
            <td class='theader'>Money</td>
            <td class='theader'>Civilians</td>
            <td class='theader'>Soldiers</td>
            <td class='theader'>Miners</td>
            <td class='theader'>Scientists</td>
            <td class='theader'>Ridon</td>
            <td class='theader'>Briterium</td>
            <td class='theader'>Kriden</td>
        </tr>
        <tr>
            <td class='trow'>$<?=$info['money']?></td>
            <td class='trow'><?=$info['civilians']?> / <?=$population?></td>
            <td class='trow'><?=$info['soldiers']?> / <?=$population?></td>
            <td class='trow'><?=$info['miners']?> / <?=$population?></td>
            <td class='trow'><?=$info['scientists']?> / <?=$population?></td>
            <td class='trow'><?=$info['ridon']?></td>
            <td class='trow'><?=$info['briterium']?></td>
            <td class='trow'><?=$info['kriden']?></td>
        </tr>
    </table>
    </div>
    <!-- End Header -->

    <!-- Begin Sidebar -->
    <?php include('../includes/sidebar.php'); ?>
    <!-- End Sidebar -->

    <!-- Begin Main -->
    <div class='main'>
    <h1>User ID: <?=$info['id']?> </h1>
    <h1>Email Address: <?=$info['email']?></h1>
    <h1>Empire Name: <?=$info['username']?> </h1>
    </div>
    <!-- End Main -->

    <!-- Begin Footer -->
    <div class='footer'>
    <div class='footerbanner'> (c) Star Odyssey 2022 </div>

    </div>
    <!-- End Footer -->
    </div>
    <!-- End Frame -->
</body>
</html>










<?php include('../includes/footer.php'); ?>