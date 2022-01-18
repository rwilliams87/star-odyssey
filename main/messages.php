<?php include('includes/_file-start.php'); ?>

<?php
$screenflash = '';

// When they push the button...

?>

<script src='javascript/internal.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<html>
  <head>
    <title>Star Odyssey -> Messages</title>
    <link rel='stylesheet' href='css/_parent.css'>
    <link rel='stylesheet' href='css/messages.css'>
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
          <?php } ?>
          
          <!-- Begin Top Table -->
          <div class="topTable">
            <div class="topHeader">Messages</div>
            <div class="topText">You currently have X unread messages.</div>
          </div>

          <div class='spacer'></div>
          <div class='spacer'></div>

          <div class="compose">
            <div class="composeHeader">Compose Message</div>
            <div class="composeTo">To: </div>
            <div class="composeDropDown">
              <select class='smallDropDownBox' name="sendto">
                <option value="volvo">(1:1) Empire One</option>
                <option value="saab">(2:2) Empire Two</option>
                <option value="fiat">(3:3) Empire Three</option>
                <option value="audi">(44:44) Derpsvillingtonshire</option>
              </select>
            </div>
            <div class="composeField"><input type='text' class='largeInputBox'></div>
            <div class="composeCharLeft">255 Characters Remaining</div>
            <div class="composeSubmit"><input type='submit' class='smallinputbutton'></div>
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