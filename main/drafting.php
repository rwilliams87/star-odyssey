<?php include('includes/_file-start.php'); ?>

<?php
$screenflash = '';

// When they push the button...
if (isset($_POST['draft'])) {

  // Assign to var. If blank, be 0. If non-numerical, be 0. Trimmed for PHP7 compat.
  empty($_POST['d_soldiers']) ? $dSoldiers = 0 : $dSoldiers = $_POST['d_soldiers'];
  empty($_POST['d_scientists']) ? $dScientists = 0 : $dScientists = $_POST['d_scientists'];
  empty($_POST['d_engineers']) ? $dEngineers = 0 : $dEngineers = $_POST['d_engineers'];
  !is_numeric(trim($dSoldiers)) ? $dSoldiers = 0 : $dSoldiers = trim($dSoldiers);
  !is_numeric(trim($dScientists)) ? $dScientists = 0 : $dScientists = trim($dScientists);
  !is_numeric(trim($dEngineers)) ? $dEngineers = 0 : $dEngineers = trim($dEngineers);

  // Check for negative numbers.
  if ($dSoldiers < 0 || $dScientists < 0 || $dEngineers < 0) {
    $screenflash = "You cannot enter negative values.";
  }
  // Check to see if all 0's were entered.
  if ($dSoldiers == 0 && $dScientists == 0 && $dEngineers == 0) {
    $screenflash = "No changes made.";
  }
  // Check to see if you have enough civilians to draft.
  if (($dSoldiers + $dScientists + $dEngineers) > $resources['civilians']) {
    $screenflash = "You do not have enough civilians available.";
  }
  if ($screenflash == "") {
    // Let's see if any other soldiers / scientists / engineers have been drafted this tick.
    $checkAlreadyDrafted = $connection -> prepare('SELECT * FROM drafting WHERE placed_by = ? AND time_left = ?');
    $checkAlreadyDrafted -> execute([$id, 12]);
    $alreadyDrafted = $checkAlreadyDrafted -> fetchAll();
    if ($alreadyDrafted) {
      // Already a draft order this tick, we'll update that instead of making a new order.
      $updateOrder = $connection -> prepare ("UPDATE drafting SET number = ? WHERE order_number = ?");
      foreach($alreadyDrafted as $row) {
        if($row['type'] == 1) {
          $newSoldiers = $row['number'] + $dSoldiers;
          $uSoldiers = $updateOrder -> execute([$newSoldiers, $row['order_number']]);
        }
        if($row['type'] == 2) {
          $newScientists = $row['number'] + $dScientists;
          $uScientists = $updateOrder -> execute([$newScientists, $row['order_number']]);
        }
        if($row['type'] == 3) {
          $newEngineers = $row['number'] + $dEngineers;
          $uEngineers = $updateOrder -> execute([$newEngineers, $row['order_number']]);
        }
      }
      $screenflash = "Your draft order has been updated.";
    } else {
      // If there have been no drafts this tick, create a new draft order.
      $newOrder = $connection -> prepare ('INSERT INTO drafting (placed_by, type, number, time_left) VALUES (?, ?, ?, ?)');
      $soldierOrder = $newOrder -> execute ([$id, 1, $dSoldiers, 12]);
      $scientistOrder = $newOrder -> execute ([$id, 2, $dScientists, 12]);
      $engineerOrder = $newOrder -> execute ([$id, 3, $dEngineers, 12]);
      $screenflash = "Your draft order has been placed.";
    }
    // Finally, we need to remove the drafted civilians from the population.
    $updateCivilians = $resources['civilians'] - ($dSoldiers + $dScientists + $dEngineers);
    $civUpdate = $connection -> prepare ('UPDATE resources SET civilians = ? WHERE id = ?') -> execute ([$updateCivilians, $id]);

    // And since a change has been made, we'll need to get the # of civilians again for the table header.
    $resources['civilians'] = $updateCivilians;
  }
}

// We're going to get the 'status' table here, so we pull info after any changes made by the submit form.
$getdraftingStatus = $connection -> prepare ('SELECT * FROM drafting WHERE placed_by = ? AND active = ?');
$getdraftingStatus -> execute ([$id, 1]);
$draftingStatus = $getdraftingStatus -> fetchAll();
$soldierTime = ['t12' => 0, 't11' => 0, 't10' => 0, 't9' => 0, 't8' => 0, 't7' => 0, 't6' => 0, 't5' => 0, 't4' => 0, 't3' => 0, 't2' => 0, 't1' => 0];
$scientistTime = ['t12' => 0, 't11' => 0, 't10' => 0, 't9' => 0, 't8' => 0, 't7' => 0, 't6' => 0, 't5' => 0, 't4' => 0, 't3' => 0, 't2' => 0, 't1' => 0];
$engineerTime = ['t12' => 0, 't11' => 0, 't10' => 0, 't9' => 0, 't8' => 0, 't7' => 0, 't6' => 0, 't5' => 0, 't4' => 0, 't3' => 0, 't2' => 0, 't1' => 0];

foreach ($draftingStatus as $row) {
  if ($row['time_left'] == 12) {
    if ($row['type'] == 1) { $soldierTime['t12'] = $row['number'] ; }
    if ($row['type'] == 2) { $scientistTime['t12'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t12'] = $row['number']; }
  }
  if ($row['time_left'] == 11) {
    if ($row['type'] == 1) { $soldierTime['t11'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t11'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t11'] = $row['number']; }
  }
  if ($row['time_left'] == 10) {
    if ($row['type'] == 1) { $soldierTime['t10'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t10'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t10'] = $row['number']; }
  }
  if ($row['time_left'] == 9) {
    if ($row['type'] == 1) { $soldierTime['t9'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t9'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t9'] = $row['number']; }
  }
  if ($row['time_left'] == 8) {
    if ($row['type'] == 1) { $soldierTime['t8'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t8'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t8'] = $row['number']; }
  }
  if ($row['time_left'] == 7) {
    if ($row['type'] == 1) { $soldierTime['t7'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t7'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t7'] = $row['number']; }
  }
  if ($row['time_left'] == 6) {
    if ($row['type'] == 1) { $soldierTime['t6'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t6'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t6'] = $row['number']; }
  }
  if ($row['time_left'] == 5) {
    if ($row['type'] == 1) { $soldierTime['t5'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t5'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t5'] = $row['number']; }
  }
  if ($row['time_left'] == 4) {
    if ($row['type'] == 1) { $soldierTime['t4'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t4'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t4'] = $row['number']; }
  }
  if ($row['time_left'] == 3) {
    if ($row['type'] == 1) { $soldierTime['t3'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t3'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t3'] = $row['number']; }
  }
  if ($row['time_left'] == 2) {
    if ($row['type'] == 1) { $soldierTime['t2'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t2'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t2'] = $row['number']; }
  }
  if ($row['time_left'] == 1) {
    if ($row['type'] == 1) { $soldierTime['t1'] = $row['number']; }
    if ($row['type'] == 2) { $scientistTime['t1'] = $row['number']; }
    if ($row['type'] == 3) { $engineerTime['t1'] = $row['number']; }
  }
}
?>

<script src='javascript/internal.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<html>
  <head>
    <title>Star Odyssey -> Drafting</title>
    <link rel='stylesheet' href='css/_parent.css'>
    <link rel='stylesheet' href='css/drafting.css'>
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
          <?php if ($screenflash != "") { ?>
            <div class='screenflash'><?=$screenflash?></div>
            <div class='spacer'></div>
          <?php } ?>
          <div class='tip'>
            Welcome to the drafting page! Here, you can draft civilians into one of 3 military members. Remember, once you draft a 
            civilian, they no longer produce money in the form of tax collections, so be sure to balance your population!
          </div>
          <div class='spacer'></div>
          <form method='post' action='' name='draft'>
          <div class="drafting">
            <div class="d-header">Drafting</div>
            <div class="d-text">You currently have <?=$resources['civilians']?> civilians available to draft.</div>
            <div class="d-name">Unit Type</div>
            <div class="d-draft"># To Draft</div>
            <div class="d-soldiers">Soldiers</div>
            <div class="d-soldiers-input"><input type='number' min='0' max='<?=$resources['civilians']?>' class='smallinputbox' name='d_soldiers'></div>
            <div class="d-scientists">Scientists</div>
            <div class="d-scientists-input"><input type='number' min='0' max='<?=$resources['civilians']?>' class='smallinputbox' name='d_scientists'></div>
            <div class="d-engineers">Engineers</div>
            <div class="d-engineers-input"><input type='number' min='0' max='<?=$resources['civilians']?>' class='smallinputbox' name='d_engineers'></div>
            <div class="d-button"><input type='submit' class='smallinputbutton' name='draft' value='Draft!'></div>
          </div>
          </form>
          <div class='spacer'></div>
          <div class='spacer'></div>
          <!-- Drafting Status Table -->
          <div class="draftingstatus">
            <div class="ds-header">Drafting Status</div>
            <div class="ds-tick">Tick</div>
            <div class="ds-soldier">Soldiers</div>
            <div class="ds-scientist">Scientists</div>
            <div class="ds-engineer">Engineers</div>
            <div class="t12">12</div>
            <div class="ds-soldier-12"><?=$soldierTime['t12']?></div>
            <div class="ds-scientist-12"><?=$scientistTime['t12']?></div>
            <div class="ds-engineer-12"><?=$engineerTime['t12']?></div>
            <div class="t11">11</div>
            <div class="ds-soldier-11"><?=$soldierTime['t11']?></div>
            <div class="ds-scientist-11"><?=$scientistTime['t11']?></div>
            <div class="ds-engineer-11"><?=$engineerTime['t11']?></div>
            <div class="t10">10</div>
            <div class="ds-soldier-10"><?=$soldierTime['t10']?></div>
            <div class="ds-scientist-10"><?=$scientistTime['t10']?></div>
            <div class="ds-engineer-10"><?=$engineerTime['t10']?></div>
            <div class="t9">9</div>
            <div class="ds-soldier-9"><?=$soldierTime['t9']?></div>
            <div class="ds-scientist-9"><?=$scientistTime['t9']?></div>
            <div class="ds-engineer-9"><?=$engineerTime['t9']?></div>
            <div class="t8">8</div>
            <div class="ds-soldier-8"><?=$soldierTime['t8']?></div>
            <div class="ds-scientist-8"><?=$scientistTime['t8']?></div>
            <div class="ds-engineer-8"><?=$engineerTime['t8']?></div>
            <div class="t7">7</div>
            <div class="ds-soldier-7"><?=$soldierTime['t7']?></div>
            <div class="ds-scientist-7"><?=$scientistTime['t7']?></div>
            <div class="ds-engineer-7"><?=$engineerTime['t7']?></div>
            <div class="t6">6</div>
            <div class="ds-soldier-6"><?=$soldierTime['t6']?></div>
            <div class="ds-scientist-6"><?=$scientistTime['t6']?></div>
            <div class="ds-engineer-6"><?=$engineerTime['t6']?></div>
            <div class="t5">5</div>
            <div class="ds-soldier-5"><?=$soldierTime['t5']?></div>
            <div class="ds-scientist-5"><?=$scientistTime['t5']?></div>
            <div class="ds-engineer-5"><?=$engineerTime['t5']?></div>
            <div class="t4">4</div>
            <div class="ds-soldier-4"><?=$soldierTime['t4']?></div>
            <div class="ds-scientist-4"><?=$scientistTime['t4']?></div>
            <div class="ds-engineer-4"><?=$engineerTime['t4']?></div>
            <div class="t3">3</div>
            <div class="ds-soldier-3"><?=$soldierTime['t3']?></div>
            <div class="ds-scientist-3"><?=$scientistTime['t3']?></div>
            <div class="ds-engineer-3"><?=$engineerTime['t3']?></div>
            <div class="t2">2</div>
            <div class="ds-soldier-2"><?=$soldierTime['t2']?></div>
            <div class="ds-scientist-2"><?=$scientistTime['t2']?></div>
            <div class="ds-engineer-2"><?=$engineerTime['t2']?></div>
            <div class="t1">1</div>
            <div class="ds-soldier-1"><?=$soldierTime['t1']?></div>
            <div class="ds-scientist-1"><?=$scientistTime['t1']?></div>
            <div class="ds-engineer-1"><?=$engineerTime['t1']?></div>
            <div class="a">A</div>
            <div class="ds-soldier-a"><?=$resources['soldiers']?></div>
            <div class="ds-scientist-a"><?=$resources['scientists']?></div>
            <div class="ds-engineer-a"><?=$resources['engineers']?></div>
          </div>

          <div class='spacer'></div>
          <div class='spacer'></div>
        </div>
        <!-- End Main Area | Begin Bottom Banner -->
        <!-- End Bottom Banner -->
        </div>
      </div>
    </div>
  </body>
</html>
<?php include('includes/_file-end.php'); ?>