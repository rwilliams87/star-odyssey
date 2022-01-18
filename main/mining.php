<?php include('includes/_file-start.php'); ?>

<?php
// Let's get some information for display.
$getmining = $connection -> prepare("SELECT * FROM mining WHERE id = ?");
$getmining -> execute([$id]);
$mining = $getmining -> fetch();
$rpt = ceil($mining['ridon'] / 2);
$bpt = ceil($mining['briterium'] / 2);
$kpt = ceil($mining['kriden'] / 2);
$screenflash = "";

if (isset($_POST['change'])) {
    
    

    empty($_POST['rAdd']) ? $rAdd = 0 : $rAdd = $_POST['rAdd'];
    empty($_POST['rRemove']) ? $rRemove = 0 : $rRemove = $_POST['rRemove'];
    empty($_POST['bAdd']) ? $bAdd = 0 : $bAdd = $_POST['bAdd'];
    empty($_POST['bRemove']) ? $bRemove = 0 : $bRemove = $_POST['bRemove'];
    empty($_POST['kAdd']) ? $kAdd = 0 : $kAdd = $_POST['kAdd'];
    empty($_POST['kRemove']) ? $kRemove = 0 : $kRemove = $_POST['kRemove'];

    $array = array($rAdd, $bAdd, $kAdd, $rRemove, $bRemove, $kRemove);
    foreach($array as $field) {
        if ($field < 0) {
            $screenflash = "Values must be positive.";
            break;
        }
    }
    $allzeros = true;
    foreach($array as $field) {
        if ($field != 0) {
            $allzeros = false;
        }
    }
    if ($allzeros == true) {
        $screenflash = "No values entered.";
    }
    if ($rAdd + $bAdd + $kAdd > $resources['engineers']) {
        $screenflash = "You do not have enough available engineers";
    }
    if ($mining['ridon'] < $rRemove || $mining['briterium'] < $bRemove || $mining['kriden'] < $kRemove) {
        $screenflash = "You are attempting to remove more engineers than you have assigned.";
    }
    if ($screenflash == "") {
        $totalRidon = $rAdd + $mining['rp4'];
        $totalBriterium = $bAdd + $mining['bp4'];
        $totalKriden = $kAdd + $mining['kp4'];
        $engineersUsed = ($resources['engineers'] - ($rAdd + $bAdd + $kAdd));
        $engineersReturned = $rRemove + $bRemove + $kRemove;
        $rReturned = $mining['ridon'] - $rRemove;
        $bReturned = $mining['briterium'] - $bRemove;
        $kReturned = $mining['kriden'] - $kRemove;

        $updateMines = $connection -> prepare("UPDATE mining SET ridon = ?, briterium = ?, kriden = ?, rp4 = ?, bp4 = ?, kp4 = ?, e4 = ? WHERE id = ?");
        $updateMines -> execute ([$rReturned, $bReturned, $kReturned, $totalRidon, $totalBriterium, $totalKriden, $engineersReturned, $id]);

        $updateEngineers = $connection -> prepare("UPDATE resources SET engineers = ? WHERE id = ?");
        $updateEngineers -> execute ([$engineersUsed, $id]);

        $screenflash = "Your changes have been made. Engineers will take 4 ticks to change jobs.";

        // Update information for table below.
        $getresources = $connection -> prepare('SELECT * FROM resources WHERE id = ?');
        $getresources -> execute([$id]);
        $resources = $getresources -> fetch();
        $getmining = $connection -> prepare("SELECT * FROM mining WHERE id = ?");
        $getmining -> execute([$id]);
        $mining = $getmining -> fetch();
        $rpt = ceil($mining['ridon'] / 2);
        $bpt = ceil($mining['briterium'] / 2);
        $kpt = ceil($mining['kriden'] / 2);
    }
}

?>

<script src='javascript/internal.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

<html>
<head>
  <title>Star Odyssey -> Mining</title>
  <link rel='stylesheet' href='css/_parent.css'>
  <link rel='stylesheet' href='css/mining.css'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class='outerframe1'>
    <div class='outerframe2'>
      <?php include('includes/smenu.php'); ?>
      <div class='outerframe3'>
        <!-- Start Top Banner -->
        <?php include('includes/banner.php'); ?>
        <!-- End Top Banner | Start Hamburger Menu -->
        <?php include('includes/hmenu.php'); ?>
        <!-- End Hamburger Menu | Start Main Area -->
    
        <div class='bannerspacer'></div>
        <div class='main' id='main'>

            <?php if ($screenflash != "") { ?>
            <div class='screenflash'><?=$screenflash?></div>
            <div class='spacer'></div>
            <?php } ?>
          
          <div class='tip'>Welcome to the mining page! Engineers are able to mine resources for you. You'll need these resoures 
              in order to build ships, space stations, and more! Assigning engineers to these mines isn't instant -- it takes 4 ticks to assign an engineer to a mine. If you remove 
              an engineer from a mine, it takes them 4 ticks before they return to you for re-assignment.
          </div>
          <div class='spacer'></div>
          <form method='post' action='' name='mine' class='mines'>
            
            <div class="m-header">Mining</div>
            <div class="m-text">You currently have <?=$resources['engineers']?> available engineers.</div>
            <div class="m-ridon">Ridon Mines</div>
            <div class="m-r-engineers-text">Assigned Engineers:</div>
            <div class="m-r-engineers-number"><?=$mining['ridon']?></div>
            <div class="m-r-per-tick">Ridon Per Tick:</div>
            <div class="m-r-per-tick-number"><?=$rpt?></div>
            <div class="m-r-remove">Remove:</div>
            <div class="m-r-remove-number"><input type='number' min='0' max='<?=$mining['ridon']?>' name='rRemove' class='sinput'></div>
            <div class="m-r-add">Add:</div>
            <div class="m-r-add-number"><input type='number' min='0' max='<?=$resources['engineers']?>' name='rAdd' class='sinput'></div>
            <div class="m-briterium">Briterium Mines</div>
            <div class="m-b-engineers-text">Assigned Engineers:</div>
            <div class="m-b-engineers-number"><?=$mining['briterium']?></div>
            <div class="m-b-per-tick">Briterium Per Tick:</div>
            <div class="m-b-per-tick-number"><?=$bpt?></div>
            <div class="m-b-remove">Remove:</div>
            <div class="m-b-remove-number"><input type='number' maxlength='6' name='bRemove' class='sinput'></div>
            <div class="m-b-add">Add:</div>
            <div class="m-b-add-number"><input type='number' maxlength='6' name='bAdd' class='sinput'></div>
            <div class="m-kriden">Kriden Mines</div>
            <div class="m-k-engineers-text">Assigned Engineers:</div>
            <div class="m-k-engineers-number"><?=$mining['kriden']?></div>
            <div class="m-k-per-tick">Kriden Per Tick:</div>
            <div class="m-k-per-tick-number"><?=$kpt?></div>
            <div class="m-k-remove">Remove:</div>
            <div class="m-k-remove-number"><input type="number" maxlength="6" name='kRemove' class='sinput'></div>
            <div class="m-k-add">Add:</div>
            <div class="m-k-add-number"><input type="number" maxlength="6" name='kAdd' class='sinput'></div>
            <div class="m-submit"><input type='submit' value='Make Staffing Changes' name='change' class='sbutton'></div>
          
          </form>
        
        </div>

    <!-- End Main Area | Begin Bottom Banner -->
    <!-- End Bottom Banner | Close All OuterFrames & Body -->
      </div>
    </div>
  </div>
</body>
</html>

<?php include('includes/_file-end.php'); ?>