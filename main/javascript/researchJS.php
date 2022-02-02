<?php
$advss_needed = 2500;
$ts_needed = 15000;
$advts_needed = 38000;
$d_needed = 75000;
$advd_needed = 120000;
$b_needed = 300000;
$advb_needed = 450000;
$dr_needed = 1000000;
$advdr_needed = 2800000;

$advds_needed = 2500;
$dst_needed = 15000;
$advdst_needed = 38000;
$dp_needed = 75000;
$advdp_needed = 120000;
$dc_needed = 300000;
$advdc_needed = 450000;
$pd_needed = 1000000;
$advpd_needed = 2800000;

$spy_needed = 50000;
$advspy_needed = 250000;
$station_needed = 50000;

$lbbomb_needed = 30000;
$barbomb_needed = 150000;
$bigbomb_needed = 500000;
$labomba_needed = 1200000;
$mermiss_needed = 5000000;
$medmiss_needed = 12000000;
$midmiss_needed = 30000000;
$megmiss_needed = 150000000;
$maxmiss_needed = 1000000000;

$getResearchStatus = $connection -> prepare('SELECT * FROM research WHERE id = ?');
$getResearchStatus -> execute([$id]);
$researchStatus = $getResearchStatus -> fetch();


?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

<script>
window.onload = function() {
  const ctx_advss = document.getElementById('chart_advss').getContext('2d');
  const advss = new Chart(ctx_advss, {
    type: 'doughnut',
    data: {
      labels: ['Complete', 'Incomplete'],
      datasets: [{
        data: [<?=$researchStatus['advss_points']?>, <?=$advss_needed - $researchStatus['advss_points']?>],
        backgroundColor: ['green', '#222233']
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
  const ctx_ts = document.getElementById('chart_ts').getContext('2d');
  const t = new Chart(ctx_ts, {
    type: 'doughnut',
    data: {
      labels: ['Complete', 'Incomplete'],
      datasets: [{
        data: [2500, 12500],
        backgroundColor: ['green', '#222233']
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
    const ctx_advts = document.getElementById('chart_advts').getContext('2d');
    const advts = new Chart(ctx_advts, {
      type: 'doughnut',
      data: {
        labels: ['Complete', 'Incomplete'],
        datasets: [{
          data: [2500, 32500],
          backgroundColor: ['green', '#222233']
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