window.onload = function() {
  const ctx_advss = document.getElementById('chart_advss').getContext('2d');
  const advss = new Chart(ctx_advss, {
    type: 'doughnut',
    data: {
      labels: ['Complete', 'Incomplete'],
      datasets: [{
        data: [2500, 0],
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