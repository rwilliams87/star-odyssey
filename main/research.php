<?php include('includes/_file-start.php'); ?>

<?php
$screenflash = '';

$getResearchStatus = $connection -> prepare('SELECT * FROM research WHERE id = ?');
$getResearchStatus -> execute([$id]);
$researchStatus = $getResearchStatus -> fetch();

$values = $connection -> query('SELECT * FROM a_values ORDER BY id ASC') -> fetchAll();

$attack = $connection -> query('SELECT * FROM a_values LIMIT 1, 9') -> fetchAll();
$defense = $connection -> query('SELECT * FROM a_values LIMIT 11, 9');




$screenflash = "yo";
?>

<script src='javascript/internal.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>


<script>
  function change(selection) {
    document.getElementById('attackCarrier').style.display = 'none';
    document.getElementById('defenseCarrier').style.display = 'none';
    document.getElementById('heavyCarrier').style.display = 'none';
    document.getElementById('specialCarrier').style.display = 'none';
    document.getElementById(selection).style.display = 'block';
  }
</script>


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


          <!-- Begin Selection Box -->
          <form name='catagorySelect' action='' method='get'>
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
          <?php 
            $counter = 2;
            echo $researchStatus['ast1_points'];
            ?>


          <div id='attackCarrier' style='display: none;'>
          <div class='sectionHeader'><div>Research Defense Ships</div></div>
            <?php $counter = 2;
              foreach ($attack as $attack) {
                if ($researchStatus[$counter] == 0) { ?>
                  <!-- Display Locked Grid -->
                  <div class='locked'>
                    <div class='locked-header'><?=$attack['name']?></div>
                    <div class='locked-body'>Unlock research plans for <?=$attack['ridon']?> ridon.</div>
                    <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
                  </div>
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
                $counter = $counter + 2;
                } ?>
          </div>

          <div id='defenseCarrier' style='display: none;'>
          <div class='sectionHeader'><div>Research Defense Ships</div></div>
            <div class='locked'>
              <div class='locked-header'><?=$values[11]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[11]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[12]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[12]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[13]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[13]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[14]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[14]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[15]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[15]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[16]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[16]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[17]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[17]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[18]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[18]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='locked'>
              <div class='locked-header'><?=$values[19]['name']?></div>
              <div class='locked-body'>Unlock research plans for <?=$values[19]['ridon']?> ridon.</div>
              <div class='locked-button'><input type='submit' class='unlockButton' value='Unlock'></div>
            </div>
            <div class='spacer'></div>
            <div class='spacer'></div>
          </div>

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

<?php include('includes/_file-end.php'); ?>