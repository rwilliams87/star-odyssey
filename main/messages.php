<?php include('includes/_file-start.php'); ?>

<?php
$screenflash = '';

// DELETE SCRIPT
if (isset($_POST['deleteMessages'])) {
  $deleteCount = 0;
  $prepareDelete = $connection -> prepare("UPDATE messages SET deleted = ? WHERE message_id = ?");
  if (!empty($_POST['dmessage'])) {
    foreach ($_POST['dMessage'] as $deleteID => $unused) {
      $prepareDelete -> execute ([1, $deleteID]);
      $deleteCount++;
    }
  $screenflash = "$deleteCount messages deleted.";
  } else {
    $screenflash = "You haven't selected any messages.";
  }
}

// SEND SCRIPT
if (isset($_POST['sendmessage'])) {
  $deadLetters = false;
  $message = $_POST['message'];
  $sendto = $_POST['sendto'];
  if (trim($message) == "") { 
    $screenflash = "Your message cannot be empty.";
  }
  // Dead Letters. Will also check for the rare occasion we may send to a dead empire. (To-Do)
  $getAddress = $connection -> prepare ('SELECT id FROM users WHERE id = ?'); //AND alive = yep
  $getAddress -> execute([$sendto]);
  $address = $getAddress -> fetch();
  if (!$address) {
    $sendto = 0;
    $deadLetters = true;
  }
  if ($screenflash == "") {
    $stamp = $connection -> prepare('INSERT INTO messages (from_id, to_id, message) VALUES (?, ?, ?)');
    $mail = $stamp -> execute([$id, $sendto, $message]);
    $deadLetters ? $screenflash = "Something went wrong." : $screenflash = "Your message has been sent.";
  }
}

// Get empire names and X:Y coordinates for the drop-down menu.
$allEmpires = $connection -> query('SELECT * FROM users') -> fetchAll();
$getxy = $connection -> prepare('SELECT * FROM sectors WHERE sector_id = ?');

// Get My Messages
$getNewMail = $connection -> prepare('SELECT * FROM messages WHERE to_id = ? AND deleted = ?');
$getNewMail -> execute([$id, 0]);
$newMail = $getNewMail -> fetchAll();
$mailCount = $getNewMail -> rowCount();
$dNum = 2;
$bNum = 2;
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
          
          <!-- Begin Compose New Message Grid -->

          
          <form method='post' action='' name='sendmessage' id='sendmessage2'>
            <div class="compose">
              <div class="composeHeader">Compose Message</div>
              <div class="composeTo">To:</div>
              <div class="composeDropDown">
                <select form='sendmessage2' class='smallDropDownBox' name='sendto'>
                  <?php 
                    forEach($allEmpires as $select) {
                      $getxy -> execute([$select['id']]);
                      $xy = $getxy -> fetch();
                      $id == $select['id'] ? $youSelect = "(You)" : $youSelect = ""; ?>
                      <option value="<?=$select['id']?>">(<?=$xy['x']?>:<?=$xy['y']?>) <?=$select['username']?> <?=$youSelect?></option>
                      <?php } ?>
                      <!-- echo "<option value=\'$select[id]\'> ($xy[x]:$xy[y]) $select[username] $youSelect</option>"; -->
                    
                  
                </select>
              </div>
              <div class="composeField">
                <textarea class='largeInputBox' maxlength="255" id='composeField' name='message' 
                  onkeyup="messagesBoxCount('composeField','composeCharLeft');" 
                  onkeydown="messagesBoxCount('composeField','composeCharLeft');" 
                  onmouseout="messagesBoxCount('composeField','composeCharLeft');"></textarea>
              </div>
              <div class="composeCharLeft" id='composeCharLeft'>255 characters remaining.</div>
              <div class="composeSubmit"><input type='submit' class='smallinputbutton' name='sendmessage' value='Send!'></div>
            </div>
          </form>

          <div class='spacer'></div>
          <div class='spacer'></div>

          <form method='post' action='' name='delete'>
          <div class='mailbox'>
            <div class='mb1'>Messages</div>
            <?php
              // Prepare our statements before the loop.
              $findSender = $connection -> prepare('SELECT username, sector_id FROM users WHERE id = ?');
              $findSenderCoords = $connection -> prepare('SELECT x, y FROM sectors WHERE sector_id = ?');
              foreach($newMail as $mail) {
                //Let's find the sender info.
                $findSender -> execute([$mail['from_id']]);
                $senderInfo = $findSender -> fetch();
                $findSenderCoords -> execute([$senderInfo['sector_id']]);
                $senderXY = $findSenderCoords -> fetch();
  
                // Let's figure out the color of this div. (dNum init: 2)
                $dNum % 2 == 0 ? $color = "#333355" : $color = "#111133";
                // Let's figure out the div's grid area.
                $dNum1 = $dNum + 1;
                $div1 = "mb$bNum";
                $bNum++;
                $div2 = "mb$bNum";
                $bNum++;
                $date = new DateTime($mail['stamped']);
                ?>
                <div class="<?=$div1?>" style="background-color: #222233; grid-area: <?=$dNum?> / 1 / <?=$dNum1?> / 2;">
                  <input type='checkbox' class='deleteCheck' name='dMessage[<?=$mail['message_id']?>]'>
                </div>
                <div class="<?=$div2?>" style="background-color: <?=$color?>; grid-area: <?=$dNum?> / 2 / <?=$dNum1?> / 6; padding: 2px;">
                  From: (<?=$senderXY['x']?>:<?=$senderXY['y']?>) <?=$senderInfo['username']?> on <?=$date -> format('d M Y  h:i A')?>
                  <br><br>
                  <?=$mail['message']?>
                </div>
              <?php $dNum++; } ?>
              <div class='final-checkbox' style="background-color: #222233; grid-area: <?=$dNum?> / 1 / <?=$dNum1?> / 2;">
                <input type='checkbox' class='deleteCheck' onclick='messagesCheckAll(this)'>
              </div>
              <div class='deletebutton' style="background-color: #222233; grid-area: <?=$dNum?> / 2 / <?=$dNum1?> / 6; justify-content: flex-end;">
                <input type='button' id='delete' name='fauxDelete' value='Delete Selected' class='inputButton' onclick='messagesConfirmDelete()'>
                <input type='submit' id='confirm' name='deleteMessages' value='Confirm' class='inputButton' style="display: none;">
              </div>
            </div>
            </form>
          </div>
        <!-- End Main Area | Begin Bottom Banner -->
        <!-- End Bottom Banner -->
        </div>
      </div>
    </div>
  </body>
</html>
<?php include('includes/_file-end.php'); ?>