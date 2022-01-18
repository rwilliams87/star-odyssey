<?php include('includes/_file-start.php'); ?>
<script src='javascript/internal.js'></script>
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
        <link rel='stylesheet' href='css/_parent.css'>
        <link rel='stylesheet' href='css/main.css'>
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
                    <div class="parent">
                        <div class="div1">The Empire Of <?=$info['username']?>  (<?=$coords['x']?>:<?=$coords['y']?>)</div>
                        <div class="div2">Population Statistics</div>
                        <div class="div3"><div class='chartContainer'><canvas id="myChart" height='120' width='120'></canvas></div></div>
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
                        <div class='div16'><?=$resources['soldiers']?></div>
                        <div class='div17'>Scientists Not Assigned To A Project:</div>
                        <div class='div18'><?=$resources['scientists']?></div>
                        <div class='div19'>Engineers Not Assigned To A Mine:</div>
                        <div class='div20'><?=$resources['engineers']?></div>
                        <div class='div21'>Message From Your Alliance Leader</div>
                        <div class='div22'><div class='amotd'>Alliance message of the day will go here!</div></div>
                    </div>
                </div>
                <div>test</div>
                <!-- End Main Area | Begin Bottom Banner -->
                <!-- End Bottom Banner -->
            </div>
        </div>
    </div>
</body>
</html>
<?php include('includes/_file-end.php'); ?>