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
$attack = $connection -> query('SELECT * FROM a_values LIMIT 0, 10') -> fetchAll();
$defense = $connection -> query('SELECT * FROM a_values LIMIT 10, 10') -> fetchAll();
$special = $connection -> query('SELECT * FROM a_values LIMIT 20, 3') -> fetchAll();
$heavy = $connection -> query('SELECT * FROM a_values LIMIT 23, 8') -> fetchAll();


if (isset($_POST['unlockID'])) {
  $unlockID = $_POST['unlockID'];
  // Let's see how much it costs. We'll grab the info via the Unlock ID.
  $findUnlockCostSQL = $connection -> prepare('SELECT * FROM a_values WHERE id = ?');
  $findUnlockCostSQL -> execute([$unlockID]);
  $unlockCost = $findUnlockCostSQL -> fetch();

  $ridonCost = $unlockCost['ridon'];
  
  if ($ridonCost > $resources['ridon']) {
    $screenflash = 'You do not have enough Ridon';
  }

  $columnToUpdate = $unlockCost['var'].'_points';
  $totalRidon = $resources['ridon'] - $ridonCost;

  if ($screenflash == '') {
    // Take away the Ridon.
    $updateRidonSQL = $connection -> prepare('UPDATE resources SET ridon = ? WHERE id = ?');
    $updateRidonSQL -> execute([$totalRidon, $id]);
    // Add one research point to the proper thing.
    $updateRPSQL = "UPDATE research SET $columnToUpdate = ? WHERE id = ?";
    $updateRP = $connection -> prepare ($updateRPSQL);
    $updateRP -> execute([1, $id]);
    $getResearchStatus -> execute([$id]);
    $researchStatus = $getResearchStatus -> fetch();
    $getresources -> execute([$id]);
    $resources = $getresources -> fetch();
    $screenflash = $columnToUpdate;
    ?><script>document.getElementByID('<?=$_POST['showGrid']?>').style.display = 'block';</script> <?php
  }
}


if (isset($_POST['submitWIP'])){
  // Let's check for empties, verify they're numerical, and trim.
  empty($_POST['sciAdd']) ? $sciAdd = 0 : $sciAdd = $_POST['sciAdd'];
  empty($_POST['sciRemove']) ? $sciRemove = 0 : $sciRemove = $_POST['sciRemove'];
  !is_numeric(trim($sciAdd)) ? $sciAdd = 0 : $sciAdd = trim($sciAdd);
  !is_numeric(trim($sciRemove)) ? $sciRemove = 0 : $sciRemove = trim($sciRemove);

  // Let's use the ID of the values table to grab the # of scientists we have for that item.
  $wipID = $_POST['wipID'];
  $findWIPVar = $connection -> prepare("SELECT * FROM a_values WHERE id = ?");
  $findWIPVar -> execute([$wipID]);
  $WIPVar = $findWIPVar -> fetch();

  $wipItem = $WIPVar['var'];
  $wipItemAssigned = $wipItem.'_assigned';
  $wipItemPoints = $wipItem.'_points';

  // Now we have clean values. Let's check and make sure they're valid.
  if ($sciAdd > $resources['scientists']) {
    $screenflash = 'There are not enough available scientists';
  }
  if ($sciAdd < 0 || $sciRemove < 0) {
    $screenflash = 'Values cannot be less than 0.';
  }
  if ($sciAdd == 0 && $sciRemove == 0) {
    $screenflash = 'No changes selected.';
  }
  if ($sciAdd - $sciRemove == 0) {
    $screenflash = 'No changes made.';
  }
  if ($screenflash == '') {
    // Let's do the math.
    $netAddRemove = $sciAdd - $sciRemove;
    $total = $researchStatus[$wipItemAssigned] + $netAddRemove;
    $totalSci = $resources['scientists'] - $netAddRemove;
    // Update the field.
    $wipUpdateSQL = "UPDATE research SET $wipItemAssigned = ? WHERE id = ?";
    $wipUpdate = $connection -> prepare($wipUpdateSQL) -> execute([$total, $id]);
    $sciUpdateSQL = "UPDATE resources SET scientists = ? WHERE id = ?";
    $sciUpdate = $connection -> prepare($sciUpdateSQL) -> execute([$totalSci, $id]);
    // Get updated values for the tables below.
    $getResearchStatus -> execute([$id]);
    $researchStatus = $getResearchStatus -> fetch();
    $getresources -> execute([$id]);
    $resources = $getresources -> fetch();
    ?><script>document.getElementByID('<?=$_POST['showGrid']?>').style.display = 'block';</script> <?php
  }
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
          <?php
          if ($screenflash != "") {
            ?>
            <div class='screenflash'><?=$screenflash?></div>
            <div class='spacer'></div>
            <?php 
          } else { 
            ?>
            <!-- Begin Tip -->
            <div class='tip'>
              Welcome to the research page! Here, you can research weapons of war. Each research project requires scientists to work on it, and time. The more scientists 
              you assign to a project, the faster it will be completed. Keep in mind, some projects are more complex than others.
            </div>
          <?php 
          } 
          ?>

          <!-- Begin Spacer -->
          <div class='spacer'></div>
          <div class='spacer'></div>
            

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
            <div class='sectionHeader'>
              <div>Research Attack Ships</div>
            </div>
              <?php
              $counter = 4;
              foreach ($attack as $attack) {

                if ($researchStatus[$counter] == 0) {
                  $headerToUpdate = $attack['var']; ?>
                  <!-- Display Locked Grid -->
                  <form name='locked' method='post' action=''>
                  <input type='hidden' name='unlockID' value='<?=$attack['id']?>'>
                  <input type='hidden' name='showGrid' value='attackCarrier'>

                  <div class='locked'>
                    <div class='locked-header'><?=$attack['name']?></div>
                    <div class='locked-body'>Unlock research plans for <?=$attack['ridon']?> ridon.</div>
                    <div class='locked-button'>
                      <input type='submit' id="<?=$attack['var'].'2'?>" class='unlockButton' name='<?=$attack['name']?>' value='Confirm?' style='display: none;'>
                      <input type='button' id="<?=$attack['var'].'1'?>" class='unlockButton' name='feeFiFauxFum' value='Unlock' onclick="researchConfirmUnlock('<?=$attack['var'].'1'?>', '<?=$attack['var'].'2'?>')">
                    </div>
                  </div>
                  </form>
                <?php
                }
                
                if ($researchStatus[$counter] > 0 && $researchStatus[$counter] < $attack['research']) { ?>
                  <!-- Display WIP Grid -->

                  <form name='submitWIP' action='' method='post'>
                  <input type='hidden' name='showGrid' value='attackCarrier'>
                  <input type='hidden' name='wipID' value='<?=$attack['id']?>'>
                  <div class="researchWIP">
                    <div class="wipHeader"><?=$attack['name']?></div>
                    <div class="wipAssigned">Scientists Assigned: </div>
                    <div class="wipAssignedValue"><?=$researchStatus[$counter - 1]?></div>
                    <div class="wipPoints">Research Points:</div>
                    <div class="wipPointsValue"><?=$researchStatus[$counter]?></div>
                    <div class="wipAdd">
                      (+) &nbsp; 
                      <input type='number' 
                             min='0' 
                             max='<?=$resources['scientists']?>'  
                             class='numField' 
                             name='sciAdd'
                      >
                    </div>
                    <div class="wipRemove">
                      (-) &nbsp; 
                      <input type='number' 
                             min='0' 
                             max='<?=$researchStatus[$counter - 1]?>' 
                             class='numField' 
                             name='sciRemove' 
                      >
                    </div>
                    <div class="wipSubmit"><input type='submit' class='sButton' name='submitWIP' value='Submit'></div>
                  </div>
                  </form>
                    
                <?php
                }
                   
                if ($researchStatus[$counter] >= $attack['research']) { ?>
                  <div class='researchComplete'><div><?=$attack['name']?> Complete!</div></div>
                <?php
                }
                  
                $counter = $counter + 2;
              } ?>
            </div>
          
        
          <div class='spacer'></div>
          <div class='spacer'></div>
          
          
          <!-- Begin Defense Ships Section --> 
          <div id='defenseCarrier' style='display: none; width: 100%;'>
            <div class='sectionHeader'>
              <div>Research Defense Ships</div>
            </div>
              <?php
              $counter = 22;
              foreach ($defense as $defense) {

                if ($researchStatus[$counter] == 0) {
                  $headerToUpdate = $defense['var']; ?>
                  <!-- Display Locked Grid -->
                  <form name='locked' method='post' action=''>
                  <input type='hidden' name='showGrid' value='defenseCarrier'>
                  <input type='hidden' name='unlockID' value='<?=$defense['id']?>'>
                  <div class='locked'>
                    <div class='locked-header'><?=$defense['name']?></div>
                    <div class='locked-body'>Unlock research plans for <?=$defense['ridon']?> ridon.</div>
                    <div class='locked-button'>
                      <input type='submit' id="<?=$defense['var'].'2'?>" class='unlockButton' name='<?=$defense['name']?>' value='Confirm?' style='display: none;'>
                      <input type='button' id="<?=$defense['var'].'1'?>" class='unlockButton' name='feeFiFauxFum' value='Unlock' onclick="researchConfirmUnlock('<?=$defense['var'].'1'?>', '<?=$defense['var'].'2'?>')">
                    </div>
                  </div>
                  </form>
                <?php
                }
                
                if ($researchStatus[$counter] > 0 && $researchStatus[$counter] < $attack['research']) { ?>
                  <!-- Display WIP Grid -->

                  <form name='submitWIP' action='' method='post'>
                  <input type='hidden' name='showGrid' value='defenseCarrier'>
                  <input type='hidden' name='wipID' value='<?=$defense['id']?>'>
                  <div class="researchWIP">
                    <div class="wipHeader"><?=$defense['name']?></div>
                    <div class="wipAssigned">Scientists Assigned: </div>
                    <div class="wipAssignedValue"><?=$researchStatus[$counter - 1]?></div>
                    <div class="wipPoints">Research Points:</div>
                    <div class="wipPointsValue"><?=$researchStatus[$counter]?></div>
                    <div class="wipAdd">
                      (+) &nbsp; 
                      <input type='number' 
                             min='0' 
                             max='<?=$resources['scientists']?>'  
                             class='numField' 
                             name='sciAdd'
                      >
                    </div>
                    <div class="wipRemove">
                      (-) &nbsp; 
                      <input type='number' 
                             min='0' 
                             max='<?=$researchStatus[$counter - 1]?>' 
                             class='numField' 
                             name='sciRemove' 
                      >
                    </div>
                    <div class="wipSubmit"><input type='submit' class='sButton' name='submitWIP' value='Submit'></div>
                  </div>
                  </form>
                    
                <?php
                }
                   
                if ($researchStatus[$counter] >= $defense['research']) { ?>
                  <div class='researchComplete'><div><?=$defense['name']?> Complete!</div></div>
                <?php
                }
                  
                $counter = $counter + 2;
              } ?>
              </div>

          <!-- Begin Defense Ships Section --> 
          <div id='heavyCarrier' style='display: none; width: 100%;'>
            <div class='sectionHeader'>
              <div>Research Heavy Weapons</div>
            </div>
              <?php
              $counter = 46;
              foreach ($heavy as $heavy) {

                if ($researchStatus[$counter] == 0) {
                  $headerToUpdate = $heavy['var']; ?>
                  <!-- Display Locked Grid -->
                  <form name='locked' method='post' action=''>
                  <input type='hidden' name='showGrid' value='heavyCarrier'>
                  <input type='hidden' name='unlockID' value='<?=$heavy['id']?>'>
                  <div class='locked'>
                    <div class='locked-header'><?=$heavy['name']?></div>
                    <div class='locked-body'>Unlock research plans for <?=$heavy['ridon']?> ridon.</div>
                    <div class='locked-button'>
                      <input type='submit' id="<?=$heavy['var'].'2'?>" class='unlockButton' name='<?=$heavy['name']?>' value='Confirm?' style='display: none;'>
                      <input type='button' id="<?=$heavy['var'].'1'?>" class='unlockButton' name='feeFiFauxFum' value='Unlock' onclick="researchConfirmUnlock('<?=$heavy['var'].'1'?>','<?=$heavy['var'].'2'?>')">
                    </div>
                  </div>
                  </form>
                <?php
                }
                
                if ($researchStatus[$counter] > 0 && $researchStatus[$counter] < $attack['research']) { ?>
                  <!-- Display WIP Grid -->

                  <form name='submitWIP' action='' method='post'>
                  <input type='hidden' name='showGrid' value='heavyCarrier'>
                  <input type='hidden' name='wipID' value='<?=$heavy['id']?>'>
                  <div class="researchWIP">
                    <div class="wipHeader"><?=$heavy['name']?></div>
                    <div class="wipAssigned">Scientists Assigned: </div>
                    <div class="wipAssignedValue"><?=$researchStatus[$counter - 1]?></div>
                    <div class="wipPoints">Research Points:</div>
                    <div class="wipPointsValue"><?=$researchStatus[$counter]?></div>
                    <div class="wipAdd">
                      (+) &nbsp; 
                      <input type='number' 
                             min='0' 
                             max='<?=$resources['scientists']?>'  
                             class='numField' 
                             name='sciAdd'
                      >
                    </div>
                    <div class="wipRemove">
                      (-) &nbsp; 
                      <input type='number' 
                             min='0' 
                             max='<?=$researchStatus[$counter - 1]?>' 
                             class='numField' 
                             name='sciRemove' 
                      >
                    </div>
                    <div class="wipSubmit"><input type='submit' class='sButton' name='submitWIP' value='Submit'></div>
                  </div>
                  </form>
                    
                <?php
                }
                   
                if ($researchStatus[$counter] >= $heavy['research']) { ?>
                  <div class='researchComplete'><div><?=$heavy['name']?> Complete!</div></div>
                <?php
                }
                  
                $counter = $counter + 2;
              } ?>
            </div>

            <div id='specialCarrier' style='display: none; width: 100%;'>
            <div class='sectionHeader'>
              <div>Research Attack Ships</div>
            </div>
              <?php
              $counter = 40;
              foreach ($special as $special) {

                if ($researchStatus[$counter] == 0) {
                  $headerToUpdate = $special['var']; ?>
                  <!-- Display Locked Grid -->
                  <form name='locked' method='post' action=''>
                  <input type='hidden' name='showGrid' value='specialCarrier'>
                  <input type='hidden' name='unlockID' value='<?=$special['id']?>'>
                  <div class='locked'>
                    <div class='locked-header'><?=$special['name']?></div>
                    <div class='locked-body'>Unlock research plans for <?=$special['ridon']?> ridon.</div>
                    <div class='locked-button'>
                      <input type='submit' id="<?=$special['var'].'2'?>" class='unlockButton' name='<?=$special['name']?>' value='Confirm?' style='display: none;'>
                      <input type='button' id="<?=$special['var'].'1'?>" class='unlockButton' name='feeFiFauxFum' value='Unlock' onclick="researchConfirmUnlock('<?=$special['var'].'1'?>', '<?=$special['var'].'2'?>')">
                    </div>
                  </div>
                  </form>
                <?php
                }
                
                if ($researchStatus[$counter] > 0 && $researchStatus[$counter] < $attack['research']) { ?>
                  <!-- Display WIP Grid -->

                  <form name='submitWIP' action='' method='post'>
                  <input type='hidden' name='showGrid' value='specialCarrier'>
                  <input type='hidden' name='wipID' value='<?=$special['id']?>'>
                  <div class="researchWIP">
                    <div class="wipHeader"><?=$special['name']?></div>
                    <div class="wipAssigned">Scientists Assigned: </div>
                    <div class="wipAssignedValue"><?=$researchStatus[$counter - 1]?></div>
                    <div class="wipPoints">Research Points:</div>
                    <div class="wipPointsValue"><?=$researchStatus[$counter]?></div>
                    <div class="wipAdd">
                      (+) &nbsp; 
                      <input type='number' 
                             min='0' 
                             max='<?=$resources['scientists']?>'  
                             class='numField' 
                             name='sciAdd'
                      >
                    </div>
                    <div class="wipRemove">
                      (-) &nbsp; 
                      <input type='number' 
                             min='0' 
                             max='<?=$researchStatus[$counter - 1]?>' 
                             class='numField' 
                             name='sciRemove' 
                      >
                    </div>
                    <div class="wipSubmit"><input type='submit' class='sButton' name='submitWIP' value='Submit'></div>
                  </div>
                  </form>
                    
                <?php
                }
                   
                if ($researchStatus[$counter] >= $attack['research']) { ?>
                  <div class='researchComplete'><div><?=$attack['name']?> Complete!</div></div>
                <?php
                }
                  
                $counter = $counter + 2;
              } ?>
            </div>
        </div>
        <!-- End Main Area | Begin Bottom Banner -->
        <!-- End Bottom Banner -->
        </div>
      </div>
    </div>
  </body>
</html>

<?php include('includes/_file-end.php'); ?>

