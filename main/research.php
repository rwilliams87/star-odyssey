<?php include('includes/_file-start.php'); ?>

<?php
$screenflash = '';

$varToIndex = [
  'ast1' => 0, 'ast2' => 1, 'ast3' => 2, 'ast4' => 3, 'ast5' => 4, 
  'ast6' => 5, 'ast7' => 6, 'ast8' => 7, 'ast9' => 8, 'ast10' => 9, 
  'dst1' => 10, 'dst2' => 11, 'dst3' => 12, 'dst4' => 13, 'dst5' => 14, 
  'dst6' => 15, 'dst7' => 16, 'dst8' => 17, 'dst9' => 18, 'dst10' => 19, 
  'special1' => 20, 'special2' => 21, 'special3' => 22, 'heavy1' => 23, 
  'heavy2' => 24, 'heavy3' => 25, 'heavy4' => 26, 'heavy5' => 27, 
  'heavy6' => 28, 'heavy7' => 29, 'heavy8' => 30
];

$getPoints = $connection -> prepare ('SELECT * FROM research WHERE id = ? AND rtype = ?');
$getPoints -> execute([$id, 'points']);
$points = $getPoints -> fetch();

$getAssigned = $connection -> prepare ('SELECT * FROM research WHERE id = ? AND rtype = ?');
$getAssigned -> execute ([$id, 'assigned']);
$assigned = $getAssigned -> fetch();

$values = $connection -> query('SELECT * FROM a_values ORDER BY id ASC') -> fetchAll();
$attack = $connection -> query('SELECT * FROM a_values LIMIT 0, 10') -> fetchAll();
$defense = $connection -> query('SELECT * FROM a_values LIMIT 10, 10') -> fetchAll();
$special = $connection -> query('SELECT * FROM a_values LIMIT 20, 3') -> fetchAll();
$heavy = $connection -> query('SELECT * FROM a_values LIMIT 23, 8') -> fetchAll();

// Start Form Processing
if(isset($_POST['unlock'])) {
	$unlockID = $_POST['shipID'];
	$valuesID = $varToIndex[$unlockID];
	$ridonCost = $values[$valuesID]['ridon'];
  if ($resources['ridon'] < $ridonCost) {
    $screenflash = "You do not have enough ridon to unlock this.";
  } else {
    // Remove Ridon From User
    $newRidon = $resources['ridon'] - $ridonCost;
    $updRidonSQL = 'UPDATE resources SET ridon = ? WHERE id = ?';
    $updRidon = $connection -> prepare($updRidonSQL) -> execute([$newRidon, $id]);

    // Set research points to 1.
    $newRPoints = 1;
    $updResearchSQL = "UPDATE research SET $unlockID = ? WHERE id = ? AND rtype = ?";
    $updResearch = $connection -> prepare($updResearchSQL) -> execute([$newRPoints, $id, 'points']);

    // Complete! Let's inform the user.
    $screenflash = "You have unlocked ".$values[$valuesID]['name']."!";
  }
}

if(isset($_POST['change'])) {
  $unlockID = $_POST['shipID'];
  $valuesID = $varToIndex[$unlockID];
  !$_POST['sciAdd'] ? $sciAdd = 0 : $sciAdd = $_POST['sciAdd'];
  !$_POST['sciRemove'] ? $sciRemove = 0 : $sciRemove = $_POST['sciRemove'];
  $netAddRemove = $sciAdd - $sciRemove;
  //Safety Checks
  if ($netAddRemove > 0 && $netAddRemove > $resources['scientists']) {
    $screenflash = 'You do not have enough scientists for this operation.';
  }
  if ($netAddRemove < 0 && abs($netAddRemove) > $assigned[$unlockID]) {
    $screenflash = 'You cannot remove more scientists than you have assigned.'; // Think of better verbage.
  }
  if ($netAddRemove == 0) {
    $screenflash = 'No changes made.';
  }
  if ($screenflash == '') {
    // Remove or Return Scientists From User.
    $newResSci = $resources['scientists'] - $netAddRemove;
    $changeResSciSQL = 'UPDATE resources SET scientists = ? WHERE id = ?';
    $changeResSci = $connection -> prepare($changeResSciSQL) -> execute([$newResSci, $id]);
    // Remove or Return Scientists From Project
    $newProjSci = $assigned[$unlockID] + $netAddRemove;
    $updProjSciSQL = "UPDATE research SET $unlockID = ? WHERE id = ? AND rtype = ?";
    $updProjSci = $connection -> prepare($updProjSciSQL) -> execute([$newProjSci, $id, 'assigned']);
    $screenflash = 'Sci Left: '.$newResSci.' Sci add/rem from Proj: '.$newProjSci;
  }
}

$getresources = $connection -> prepare('SELECT * FROM resources WHERE id = ?');
$getresources -> execute([$id]);
$resources = $getresources -> fetch();

$getPoints = $connection -> prepare ('SELECT * FROM research WHERE id = ? AND rtype = ?');
$getPoints -> execute([$id, 'points']);
$points = $getPoints -> fetch();

$getAssigned = $connection -> prepare ('SELECT * FROM research WHERE id = ? AND rtype = ?');
$getAssigned -> execute ([$id, 'assigned']);
$assigned = $getAssigned -> fetch();

echo ('Scientists: ');
echo ($resources['scientists']);


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
            foreach ($attack as $atk) {
              $atkID = $atk['var'];
              $atkCost = $atk['ridon'];
              if ($points[$atkID] == 0) {
                ?>

                <!-- Display Locked Grid -->
                <form name='unlock' method='post' action=''>
                  <input type='hidden' name='unlock' value='unlock'>
                  <input type='hidden' name='shipID' value='<?=$atkID?>'>
                    <div class='locked'>
                      <div class='locked-header'><?=$atk['name']?></div>
                      <div class='locked-body'>Unlock research plans for <?=$atkCost?> ridon.</div>
                      <div class='locked-button'>
                        <input type='submit' class='unlockButton' value='Unlock'>
                      </div>
                    </div>
                  </form>

                <?php
              }
              if ($points[$atkID] > 0 && $points[$atkID] < $atkCost) {    
                ?>

                  <!-- Display WIP Grid -->
                  <form name='submitWIP' action='' method='post'>
                  <input type='hidden' name='change' value='change'>
                  <input type='hidden' name='shipID' value='<?=$atkID?>'>
                  <div class="researchWIP">
                    <div class="wipHeader"><?=$atk['name']?></div>
                    <div class="wipAssigned">Scientists Assigned: </div>
                    <div class="wipAssignedValue"><?=$assigned[$atkID]?></div>
                    <div class="wipPoints">Research Points:</div>
                    <div class="wipPointsValue"><?=$points[$atkID]?></div>
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
                             max='<?=$assigned[$atkID]?>' 
                             class='numField' 
                             name='sciRemove' 
                      >
                    </div>
                    <div class="wipSubmit"><input type='submit' class='sButton' name='submitWIP' value='Submit'></div>
                  </div>
                  </form>

                <?php
              }
              if ($points[$atkID] >= $atkCost) {
                ?>

                  <!-- Display Complete Grid -->  
                  <div class='researchComplete'><div>XXX Complete!</div></div>

               <?php
              }
            }
            ?>



                  
            </div>
          
        
          <div class='spacer'></div>
          <div class='spacer'></div>
          
          
          <!-- Begin Defense Ships Section --> 
          <div id='defenseCarrier' style='display: none; width: 100%;'>
            <div class='sectionHeader'>
              <div>Research Defense Ships</div>
            </div>

            <?php 
            foreach ($defense as $def) {
              $defID = $def['var'];
              $defCost = $def['ridon'];
              if ($points[$defID] == 0) {
                ?>

                <!-- Display Locked Grid -->
                <form name='unlock' method='post' action=''>
                  <input type='hidden' name='unlock' value='unlock'>
                  <input type='hidden' name='shipID' value='<?=$defID?>'>
                    <div class='locked'>
                      <div class='locked-header'><?=$def['name']?></div>
                      <div class='locked-body'>Unlock research plans for <?=$defCost?> ridon.</div>
                      <div class='locked-button'>
                        <input type='submit' class='unlockButton' value='Unlock'>
                      </div>
                    </div>
                  </form>

                <?php
              }
              if ($points[$defID] > 0 && $points[$defID] < $defCost) {    
                ?>

                  <!-- Display WIP Grid -->
                  <form name='submitWIP' action='' method='post'>
                  <input type='hidden' name='change' value='change'>
                  <input type='hidden' name='shipID' value='<?=$defID?>'>
                  <div class="researchWIP">
                    <div class="wipHeader"><?=$def['name']?></div>
                    <div class="wipAssigned">Scientists Assigned: </div>
                    <div class="wipAssignedValue"><?=$assigned[$defID]?></div>
                    <div class="wipPoints">Research Points:</div>
                    <div class="wipPointsValue"><?=$points[$defID]?></div>
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
                             max='<?=$assigned[$defID]?>' 
                             class='numField' 
                             name='sciRemove' 
                      >
                    </div>
                    <div class="wipSubmit"><input type='submit' class='sButton' name='submitWIP' value='Submit'></div>
                  </div>
                  </form>

                <?php
              }
              if ($points[$defID] >= $defCost) {
                ?>

                  <!-- Display Complete Grid -->  
                  <div class='researchComplete'><div>XXX Complete!</div></div>

               <?php
              }
            }
            ?>  
            </div>
          
        
          <div class='spacer'></div>
          <div class='spacer'></div>


          <!-- Begin Heavy Weapons Section --> 
          <div id='heavyCarrier' style='display: none; width: 100%;'>
            <div class='sectionHeader'>
              <div>Research hvyial Items</div>
            </div>

            <?php 
            foreach ($heavy as $hvy) {
              $hvyID = $hvy['var'];
              $hvyCost = $hvy['ridon'];
              if ($points[$hvyID] == 0) {
                ?>

                <!-- Display Locked Grid -->
                <form name='unlock' method='post' action=''>
                  <input type='hidden' name='unlock' value='unlock'>
                  <input type='hidden' name='shipID' value='<?=$hvyID?>'>
                    <div class='locked'>
                      <div class='locked-header'><?=$hvy['name']?></div>
                      <div class='locked-body'>Unlock research plans for <?=$hvyCost?> ridon.</div>
                      <div class='locked-button'>
                        <input type='submit' class='unlockButton' value='Unlock'>
                      </div>
                    </div>
                  </form>

                <?php
              }
              if ($points[$hvyID] > 0 && $points[$hvyID] < $hvyCost) {    
                ?>

                  <!-- Display WIP Grid -->
                  <form name='submitWIP' action='' method='post'>
                  <input type='hidden' name='change' value='change'>
                  <input type='hidden' name='shipID' value='<?=$hvyID?>'>
                  <div class="researchWIP">
                    <div class="wipHeader"><?=$hvy['name']?></div>
                    <div class="wipAssigned">Scientists Assigned: </div>
                    <div class="wipAssignedValue"><?=$assigned[$hvyID]?></div>
                    <div class="wipPoints">Research Points:</div>
                    <div class="wipPointsValue"><?=$points[$hvyID]?></div>
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
                             max='<?=$assigned[$hvyID]?>' 
                             class='numField' 
                             name='sciRemove' 
                      >
                    </div>
                    <div class="wipSubmit"><input type='submit' class='sButton' name='submitWIP' value='Submit'></div>
                  </div>
                  </form>

                <?php
              }
              if ($points[$hvyID] >= $hvyCost) {
                ?>

                  <!-- Display Complete Grid -->  
                  <div class='researchComplete'><div>XXX Complete!</div></div>

               <?php
              }
            }
            ?>
            </div>
        
          <div class='spacer'></div>
          <div class='spacer'></div>
          
            <div id='specialCarrier' style='display: none; width: 100%;'>
            <div class='sectionHeader'>
              <div>Research Special Items</div>
            </div>

            <?php 
            foreach ($special as $spec) {
              $specID = $spec['var'];
              $specCost = $spec['ridon'];
              if ($points[$specID] == 0) {
                ?>

                <!-- Display Locked Grid -->
                <form name='unlock' method='post' action=''>
                  <input type='hidden' name='unlock' value='unlock'>
                  <input type='hidden' name='shipID' value='<?=$specID?>'>
                    <div class='locked'>
                      <div class='locked-header'><?=$spec['name']?></div>
                      <div class='locked-body'>Unlock research plans for <?=$specCost?> ridon.</div>
                      <div class='locked-button'>
                        <input type='submit' class='unlockButton' value='Unlock'>
                      </div>
                    </div>
                  </form>

                <?php
              }
              if ($points[$specID] > 0 && $points[$specID] < $specCost) {    
                ?>

                  <!-- Display WIP Grid -->
                  <form name='submitWIP' action='' method='post'>
                  <input type='hidden' name='change' value='change'>
                  <input type='hidden' name='shipID' value='<?=$specID?>'>
                  <div class="researchWIP">
                    <div class="wipHeader"><?=$spec['name']?></div>
                    <div class="wipAssigned">Scientists Assigned: </div>
                    <div class="wipAssignedValue"><?=$assigned[$specID]?></div>
                    <div class="wipPoints">Research Points:</div>
                    <div class="wipPointsValue"><?=$points[$specID]?></div>
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
                             max='<?=$assigned[$specID]?>' 
                             class='numField' 
                             name='sciRemove' 
                      >
                    </div>
                    <div class="wipSubmit"><input type='submit' class='sButton' name='submitWIP' value='Submit'></div>
                  </div>
                  </form>

                <?php
              }
              if ($points[$specID] >= $specCost) {
                ?>

                  <!-- Display Complete Grid -->  
                  <div class='researchComplete'><div>XXX Complete!</div></div>

               <?php
              }
            }
            ?>
            </div>
        
          <div class='spacer'></div>
          <div class='spacer'></div>        </div>
        <!-- End Main Area | Begin Bottom Banner -->
        <!-- End Bottom Banner -->
        </div>
      </div>
    </div>
  </body>
</html>

<?php include('includes/_file-end.php'); ?>

