
<?php include('../includes/header.php'); ?>
<script src='../includes/internal.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

<script>
    window.onload = function() {
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Civilians', 'Soldiers', 'Scientists', 'Engineers'],
            datasets: [{
                data: [<?=$resources['civilians']?>, <?=$resources['soldiers']?>, <?=$resources['scientists']?>, <?=$resources['engineers']?>],
                backgroundColor: ['#4a1a70', '#2306a9', '#140e2f', '#d8b6d3']
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    }) 
}
</script>

<html>

<head>
    <title>Star Odyssey -> Main</title>
    <link rel='stylesheet' href='../css/internal.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <!-- Start Frame -->
    <!-- Start Top Banner -->
    <?php include('../includes/topbanner.php'); ?>
    <!-- End Top Banner -->
    <!-- Start Hamboyga Menu -->
    <?php include('../includes/hamburger.php'); ?>
    <!-- End Hamboyga Menu -->

    <!-- Start Main Area -->
    <div class='main' width='100%'>

        <div class="parent">
            <div class="div1">The Empire Of <?=$info['username']?></div>
            <div class="div2">Population Statistics</div>
            <div class="div3"><div class='chartContainer'><canvas id="myChart" height='130' width='130'></canvas></div></div>
            <div class="div4">Total Population:</div>
            <div class="div5"><?=$population?></div>
            <div class="div6"><div class='legend l1'></div>Civilians:</div>
            <div class="div7"><?=$resources['civilians']?></div>
            <div class="div8"><div class='legend l2'></div>Soldiers:</div>
            <div class="div9"><?=$resources['soldiers']?></div>
            <div class="div10"><div class='legend l3'></div>Scientists:</div>
            <div class="div11"><?=$resources['scientists']?></div>
            <div class="div12"><div class='legend l4'></div>Engineers:</div>
            <div class="div13"><?=$resources['engineers']?></div>
            <div class='div14'>Military Utilization</div>
            <div class='div15'>Soldiers Not Assigned To A Ship:</div>
            <div class='div16'>500</div>
            <div class='div17'>Scientists Not Assigned To A Project:</div>
            <div class='div18'>500</div>
            <div class='div19'>Engineers Not Assigned To A Mine:</div>
            <div class='div20'>500</div>
            <div class='div21'>Message From Your Alliance Leader</div>
            <div class='div22'><div class='amotd'>h0ly sHIT we're getting nuked wtf man get ur asses online and attack these hoes</div></div>
            
        </div>








        <!--
    <div class='main-upperinfogrid'>
    <div class='main-upperinfogrid-header'>
        The Kingdom Of<br>
        <?=$info['username']?>
    </div> 
    <div class='main-upperinfogrid-mid1'>
        General Information
    </div>
    <div class='main-upperinfogrid1'>
        Total Population:
    </div>
    <div class='main-upperinfogrid2'>
        2500
    </div>
    <div class='main-upperinfogrid3'>
        Civilians:
    </div>
    <div class='main-upperinfogrid4'>
        1000
    </div>
    <div class='main-upperinfogrid5'>
        Soldiers:
    </div>
    <div class='main-upperinfogrid6'>
        500
    </div>
    <div class='main-upperinfogrid7'>
        Miners:
    </div>
    <div class='main-upperinfogrid8'>
        500
    </div>
    <div class='main-upperinfogrid9'>
        Scientists:
    </div>
    <div class='main-upperinfogrid10'>
        500
    </div>
    <div class='main-upperinfogrid11'>
        Total Money
    </div>
    <div class='main-upperinfogrid12'>
        999,999
    </div>
    <div class='main-upperinfogrid13'>
        Income Per Tick:
    </div>
    <div class='main-upperinfogrid14'>
        500
    </div>
    <div class='main-upperinfogrid15'>
        Kriden Per Tick:
    </div>
    <div class='main-upperinfogrid16'>
        0
    </div>
    <div class='main-upperinfogrid17'>
        Ridon Per Tick:
    </div>
    <div class='main-upperinfogrid18'>
        0
    </div>
    <div class='main-upperinfogrid19'>
        Briterium Per Tick:
    </div>
    <div class='main-upperinfogrid20'>
        0
    </div>
    </div>
    
    <table>
        <tr>
            <td colspan='4' class='theader'>The Empire Of<br><?=$info['username']?></td>
        </tr>
        <tr>
            <td colspan='4' class='tmid'>General Information</td>
        </tr>
        <tr>
            <td colspan='2' width='50%' class='trow'>
            Total Population: <br>
            Civilians: <br>
            Soldiers: <br>
            Miners: <br>
            Scientists: 
            </td>
            <td colspan='2' width='50%' class='trow'>
            Total Money: <br>
            Income Per Tick: <br>
            Kriden Per Tick: <br>
            Ridon Per Tick: <br>
            Briterium Per Tick: 
            </td>
        </tr>
        <tr>
            <td colspan='4' class='tmid'>Utilization</td>
        </tr>
        <tr>
            <td colspan='3' class='trow'>
            Soldiers Not Assigned To A Ship: <br>
            Scientists Not Assigned To A Project: <br>
            Miners To Assigned To A Vein: 
            </td>
            <td colspan='1' class='trow'>###<br>###<br>###</td>
        </tr>
    </table>
    -->

    </div>
    <!-- End Main Area -->

    <!-- Begin Bottom Banner -->

    <!-- End Bottom Banner -->




</body>

</html>

<?php include('../includes/footer.php'); ?>