import { Line, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins

export default {
  extends: Line,
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
          ticks: {
            maxTicksLimit: 5,
            fontSize: 10,
          }
        }],
        xAxes: [ {
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