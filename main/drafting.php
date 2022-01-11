<?php include('includes/_file-start.php'); ?>
<script src='javascript/internal.js'></script>
<html>
<head>
    <title>Star Odyssey -> Main</title>
    <link rel='stylesheet' href='css/_parent.css'>
    <link rel='stylesheet' href='css/drafting.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <!-- Start Frame -->
    <!-- Start Top Banner -->
    <?php include('includes/banner.php'); ?>
    <!-- End Top Banner -->
    <!-- Start Hamboyga Menu -->
    <?php include('includes/hmenu.php'); ?>
    <!-- End Hamboyga Menu -->

    <!-- Start Main Area -->
    <form method='post' action='' name='draft'>
    <div class='main' width='100%' id='main'>

    <div class='helper'>
        Welcome to the drafting page! Here you can draft your civilians into one of three military members: Soldiers to man and pilot attack 
        and defensive ships, scientists to research and discover new technology, and engineers to claim territory and create resources. Remember that 
        once you've drafted a civilian, that change is permanent - and only civilians are capable of producing money. 
    </div>

    <div class='spacer'></div>
    
    <div class="status">
        <div class="status1">Drafting</div>
        <div class="status2">Unit Type</div>
        <div class='status11'>Unassigned</div>
        <div class='status12'>Total</div>
        <div class="status3"># Of Civilians:</div>
        <div class='status13'>---</div>
        <div class="status4">1000</div>
        <div class="status5">Soldiers</div>
        <div class='status14'>500</div>
        <div class="status6">500</div>
        <div class="status7">Scientists</div>
        <div class='status15'>500</div>
        <div class="status8">500</div>
        <div class="status9">Engineers</div>
        <div class='status16'>500</div>
        <div class="status10">500</div>
    </div>

    <br>
    <div class='spacer'></div>
    
    <div class="drafting">    
            <div class="drafting1">Draft Civilians</div>
            <div class="drafting2">Type</div>
            <div class="drafting3">In Progress</div>
            <div class="drafting4">Draft</div>
            <div class="drafting5">Soldiers</div>
            <div class="drafting6">0</div>
            <div class="drafting7"><input type='number' class='smallinputbox' length='6' name='draft_soliders'></div>
            <div class="drafting8">Scientists</div>
            <div class="drafting9">0</div>
            <div class="drafting10"><input type='number' class='smallinputbox' length='6' name='draft_scientists'></div>
            <div class="drafting11">Engineers</div>
            <div class="drafting12">0</div>
            <div class="drafting13"><input type='number' class='smallinputbox' length='6' name='draft_engineers'></div>
            <div class="drafting14"><input type='submit' class='smallinputbutton' name='draft' value='Draft!'></div>
        </div>
    </div>
    </form>
    <!-- End Main Area -->

    <!-- Begin Bottom Banner -->

    <!-- End Bottom Banner -->




</body>

</html>

<?php include('includes/_file-end.php'); ?>