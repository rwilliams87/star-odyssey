<?php include('includes/_file-start.php'); ?>

<?php
$screenflash = '';

$getResearchStatus = $connection -> prepare('SELECT * FROM research WHERE id = ?');
$getResearchStatus -> execute([$id]);
$researchStatus = $getResearchStatus -> fetch();
$getResearchColumns = $connection -> prepare('DESCRIBE research');
$getResearchColumns -> execute();
$researchColumns = $getResearchColumns -> fetchAll(PDO::FETCH_COLUMN);

$values = $connection -> query('SELECT * FROM a_values ORDER BY id ASC') -> fetchAll();

$attack = $connection -> query('SELECT * FROM a_values LIMIT 1, 9') -> fetchAll();
$defense = $connection -> query('SELECT * FROM a_values LIMIT 11, 9');


if (isset($_POST['attackUnlock'])) {
  $counter = $_POST['counter'];
 
  $shipToUpdate = $researchColumns[$counter];
  $screenflash = $researchColumns[6];
  $unlockSQL = ('UPDATE research SET $shipToUpdate = ? WHERE id = ?');
  $updateUnlock = $connection -> prepare ($unlockSQL);
  $updateUnlock -> execute([1, $id]);
  $getResearchStatus -> execute([$id]);
  $researchStatus = $getResearchStatus -> fetch();

} else {
  $screenflash = print_r($_POST);
}
?>

<script src='javascript/internal.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>



<html>
  <head>
    <title>Star Odyssey -> Research</title>
    <link rel='stylesheet' href='css/_parent.css'>
    <link rel='stylesheet' href='css/research.css'>
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
        <!-- End Hamboyga Menu | Start Main Area -->
        <div class='bannerspacer'></div>
        <div class='main' id='main'>
          
          <!-- Check For Screenflash -->
          <?php if ($screenflash != "") { ?>
            <div class='screenflash'><?=$screenflash?></div>
            <div class='spacer'></div>
          <?php } else { ?>
          
          <!-- Begin Tip -->
          <div class='tip'>
            Welcome to the research page! Here, you can research weapons of war. Each research project requires scientists to work on it, and time. The more scientists 
            you assign to a project, the faster it will be completed. Keep in mind, some projects are more complex than others.
          </div>
          <?php } ?>

          <!-- Begin Spacer -->
          <div class='spacer'></div>
          <div class='spacer'></div>
            
          <?php foreach ($_POST as $key => $value) {
            echo $key . ' ' . $value; 
            echo $researchStatus[6];
          } ?>
          <!-- Begin Selection Box -->
          
          <div class="selector">
            <div class="selectorHeader">Research</div>
            <div class="selectorAttack" onclick="change('attackCarrier')">Attack</div>
            <div class="selectorDefense" onclick="change('defenseCarrier')">Defense</div>
            <div class="selectorHeavy" onclick="change('heavyCarrier')">Heavy</div>
            <div class="selectorSpecial" onclick="change('specialCarrier')">Special</div>
          </div>

          <!-- Begin Spacer -->
          <div class='spacer'></div>
          <div class='spacer'></div>

          <!-- Begin Attack Ships Section -->

          <div id='attackCarrier' style='display: none; width: 100%;'>
          <div class='sectionHeader'><div>Research Attack Ships</div></div>
            <?php $counter = 2;
              foreach ($attack as $attack) {
                if ($researchStatus[$counter] == 0) {
                  $first = $attack['var'].'1';
                  $second = $attack['var'].'2'; ?>
                  <!-- Display Locked Grid -->
                  <form name='locked' method='post' action=''>
                    
                  <input type='hidden' name='attackUnlock' value='<?=$attack['ridon']?>'>
                  <input type='hidden' name='counter' value='<?=$counter?>'>
                  
                  <div class='locked'>
                    <div class='locked-header'><?=$attack['name']?></div>
                    <div class='locked-body'>Unlock research plans for <?=$attack['ridon']?> ridon. <?=$first?></div>
                    <div class='locked-button'>
                      <input type='submit' id="<?=$attack['var'].'2'?>" class='unlockButton' name='<?=$attack['name']?>' value='Confirm?' style='display: none;'>
                      <input type='button' id="<?=$attack['var'].'1'?>" class='unlockButton' name='feeFiFauxFum' value='Unlock' onclick="researchConfirmUnlock('<?=$attack['var'].'1'?>', '<?=$attack['var'].'2'?>')">
                    </div>
                  </div>
                  </form>
                
                <?php }
                if ($researchStatus[$counter] > 0 && $researchStatus[$counter] < $attack['research']) { ?>
                  <!-- Display WIP Grid -->
                  <div class="researchWIP">
                    <div class='researchWIP-header'><?=$attack['name']?></div>
                    <div class="researchWIP-section1">Assigned Scientists:</div>
                    <div class="researchWIP-section2">Add:</div>
                    <div class="researchWIP-assigned"><?=$researchStatus[$counter - 1]?></div>
                    <div class="researchWIP-add"><input type='number' class='smallInputNumber'></div>
                    <div class="researchWIP-header3">Research Points:</div>
                    <div class="researchWIP-header4">Remove:</div>
                    <div class="researchWIP-points"><?=$researchStatus[$counter]?> / <?=$attack['research']?></div>
                    <div class="researchWIP-remove"><input type='number' class='smallInputNumber'></div>
                  </div>
                  

                <?php } 
                if ($researchStatus[$counter] >= $attack['research']) { ?>
                  <div class='researchComplete'><div><?=$attack['name']?> Complete!</div></div>
                <?php  }
                $counter = $counter + 2;
                } ?>
          </div>
          
          
          
          
          <!-- Begin Defense Ships Section --> 
          <form action='' method='post' name='submitAttackShips'>
          <div id='defenseCarrier' style='display: none;'>
          <div class='sectionHeader'><div>Research Defense Ships</div></div>
            <?php $counter = 22;
              foreach ($defense as $defense) {
                if ($researchStatus[$counter] == 0) { ?>
                  <!-- Display Locked Grid -->
                  <div class='locked'>
                    <div class='locked-header'><?=$defense['name']?></div>
                    <div class='locked-body'>Unlock research plans for <?=$defense['ridon']?> ridon.</div>
                    <div class='locked-button'><input type='submit' class='unlockButton' id='unlock' value='Unlock'></div>
                  </div>
                <?php }
                if ($researchStatus[$counter] > 0 && $researchStatus[$counter] < $defense['research']) { ?>
                  <!-- Display WIP Grid -->
                  <div class="researchWIP">
                    <div class='researchWIP-header'><?=$defense['name']?></div>
                    <div class="researchWIP-section1">Assigned Scientists:</div>
                    <div class="researchWIP-section2">Add:</div>
                    <div class="researchWIP-assigned"><?=$researchStatus[$counter - 1]?></div>
                    <div class="researchWIP-add"><input type='number' class='smallInputNumber'></div>
                    <div class="researchWIP-header3">Research Points:</div>
                    <div class="researchWIP-header4">Remove:</div>
                    <div class="researchWIP-points"><?=$researchStatus[$counter]?> / <?=$defense['research']?></div>
                    <div class="researchWIP-remove"><input type='number' class='smallInputNumber'></div>
                  </div>
                  

                <?php } 
                if ($researchStatus[$counter] >= $defense['research']) { ?>
                  <div class='researchComplete'><div><?=$defense['name']?> Complete!</div></div>
                <?php  }
                $counter = $counter + 2;
                } ?>
          </div>
          </form>



          <div id="heavyCarrier" style='display: none;'>
          <div class='sectionHeader'><div>Research Heavy Weapons</div></div>
            <div class='locked'>
              <div class='locked-header'><?=$values[23]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[23]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[24]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[24]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[25]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[25]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[26]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[26]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[27]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[27]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[28]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[28]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[29]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[29]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[30]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[30]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='spacer'></div>
            <div class='spacer'></div>
          </div>

          <div id="specialCarrier" style='display: none;'>
          <div class='sectionHeader'><div>Research Special Equipment</div></div>
          <div class='locked'>
              <div class='locked-header'><?=$values[20]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[20]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[21]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[21]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[22]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[22]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='spacer'></div>
            <div class='spacer'></div>
          </div>
        </div>
        <!-- End Main Area | Begin Bottom Banner -->
        <!-- End Bottom Banner -->
        </div>
      </div>
    </div>
  </body>
</html>

<?php if(isset($_POST['attackUnlock'])) { ?>
  <script>change('attackCarrier');</script>
<?php } ?>

<?php include('includes/_file-end.php'); ?>



