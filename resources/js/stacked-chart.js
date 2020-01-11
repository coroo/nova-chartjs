import { Bar, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins

export default {
  extends: Bar,
  mixins: [reactiveProp],
  props: {
    height: {
      default: 120,
      type: Number
    }
  },
  data: () => ({
    options: {
      layout: {
        padding: {
            left: 20,
            right: 20,
            top: 0,
            bottom: 10
        }
      },
      scales: {
        yAxes: [{
          stacked: true,
          ticks: {
            maxTicksLimit: 5,
            fontSize: 10,
            callback: function(num, index, values) {
              if (num >= 1000000000) {
                 return (num / 1000000000).toFixed(1).replace(/\.0$/, '') + 'G';
              }
              if (num >= 1000000) {
                 return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
              }
              if (num >= 1000) {
                 return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
              }
              return num;
            }
          }
        }],
        xAxes: [ {
          stacked: true,
          ticks: {
            lineHeight: 0.8,
            fontSize: 10,
          }
        }]
      },
      legend: {
        display: true,
        position: 'left',
        labels: {
            fontColor: '#7c858e',
            fontFamily: "'Nunito'"
        }
      },
      responsive: true,
      maintainAspectRatio: false,
    }
  }),
  mounted () {
    this.renderChart(this.chartdata, this.options
    )
  },
  computed: {
    myStyles () {
      return {
        height: `100%`,
        position: 'relative'
      }
    }
  }
}