
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
<div class="parent">
<div class="div1"> Logo for fullscreen</div>
<div class="div2"> Top banner yo</div>
<div class="div3"> Side Banner if large screen</div>
<div class="div4"> This is gonna be 800px yo</div>
<div class="div5"> Junk</div>
<div class="div6"> Still Junk</div>
</div>



</html>

<?php include('includes/_file-end.php'); ?>