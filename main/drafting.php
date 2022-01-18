<?php include('includes/_file-start.php'); ?>

<?php
//Let's grab the information we need for the drafting status table.

$getsoldiers = $connection -> prepare('SELECT * FROM drafting_soldiers WHERE id = ?');
$getsoldiers -> execute([$id]);
$soldiers = $getsoldiers -> fetch();

$getscientists = $connection -> prepare ('SELECT * FROM drafting_scientists WHERE id = ?');
$getscientists -> execute([$id]);
$scientists = $getscientists -> fetch();

$getengineers = $connection -> prepare('SELECT * FROM drafting_engineers WHERE id = ?');
$getengineers -> execute([$id]);
$engineers = $getengineers -> fetch();


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
          <div class='screenflash'>This is a test screenflash to see what it will look like.</div>
          <div class='spacer'></div>
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
            <div class="d-soldiers-input"><input type='number' maxlength='6' class='smallinputbox' name='d_soliders'></div>
            <div class="d-scientists">Scientists</div>
            <div class="d-scientists-input"><input type='number' maxlength='6' class='smallinputbox' name='d_scientists'></div>
            <div class="d-engineers">Engineers</div>
            <div class="d-engineers-input"><input type='number' maxlength='6' class='smallinputbox' name='d_engineers'></div>
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
            <div class="ds-soldier-12"><?=$soldiers['t12']?></div>
            <div class="ds-scientist-12"><?=$scientists['t12']?></div>
            <div class="ds-engineer-12"><?=$engineers['t12']?></div>
            <div class="t11">11</div>
            <div class="ds-soldier-11"><?=$soldiers['t11']?></div>
            <div class="ds-scientist-11"><?=$scientists['t11']?></div>
            <div class="ds-engineer-11"><?=$engineers['t11']?></div>
            <div class="t10">10</div>
            <div class="ds-soldier-10"><?=$soldiers['t10']?></div>
            <div class="ds-scientist-10"><?=$scientists['t10']?></div>
            <div class="ds-engineer-10"><?=$engineers['t10']?></div>
            <div class="t9">9</div>
            <div class="ds-soldier-9"><?=$soldiers['t9']?></div>
            <div class="ds-scientist-9"><?=$scientists['t9']?></div>
            <div class="ds-engineer-9"><?=$engineers['t9']?></div>
            <div class="t8">8</div>
            <div class="ds-soldier-8"><?=$soldiers['t8']?></div>
            <div class="ds-scientist-8"><?=$scientists['t8']?></div>
            <div class="ds-engineer-8"><?=$engineers['t8']?></div>
            <div class="t7">7</div>
            <div class="ds-soldier-7"><?=$soldiers['t7']?></div>
            <div class="ds-scientist-7"><?=$scientists['t7']?></div>
            <div class="ds-engineer-7"><?=$engineers['t7']?></div>
            <div class="t6">6</div>
            <div class="ds-soldier-6"><?=$soldiers['t6']?></div>
            <div class="ds-scientist-6"><?=$scientists['t6']?></div>
            <div class="ds-engineer-6"><?=$engineers['t6']?></div>
            <div class="t5">5</div>
            <div class="ds-soldier-5"><?=$soldiers['t5']?></div>
            <div class="ds-scientist-5"><?=$scientists['t5']?></div>
            <div class="ds-engineer-5"><?=$engineers['t5']?></div>
            <div class="t4">4</div>
            <div class="ds-soldier-4"><?=$soldiers['t4']?></div>
            <div class="ds-scientist-4"><?=$scientists['t4']?></div>
            <div class="ds-engineer-4"><?=$engineers['t4']?></div>
            <div class="t3">3</div>
            <div class="ds-soldier-3"><?=$soldiers['t3']?></div>
            <div class="ds-scientist-3"><?=$scientists['t3']?></div>
            <div class="ds-engineer-3"><?=$engineers['3']?></div>
            <div class="t2">2</div>
            <div class="ds-soldier-2"><?=$soldiers['t2']?></div>
            <div class="ds-scientist-2"><?=$scientists['t2']?></div>
            <div class="ds-engineer-2"><?=$engineers['t2']?></div>
            <div class="t1">1</div>
            <div class="ds-soldier-1"><?=$soldiers['t1']?></div>
            <div class="ds-scientist-1"><?=$scientists['t1']?></div>
            <div class="ds-engineer-1"><?=$engineers['t1']?></div>
            <div class="a">A</div>
            <div class="ds-soldier-a"><?=$resources['soldiers']?></div>
            <div class="ds-scientist-a"><?=$resources['scientists']?></div>
            <div class="ds-engineer-a"><?=$resources['engineers']?></div>
          </div>

          <div class='spacer'></div>
          <div class='spaver'></div>
        </div>
        <!-- End Main Area | Begin Bottom Banner -->
        <!-- End Bottom Banner -->
        </div>
      </div>
    </div>
  </body>
</html>
<?php include('includes/_file-end.php'); ?>