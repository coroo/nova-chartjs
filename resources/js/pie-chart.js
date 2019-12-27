import { Pie, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins

export default {
  extends: Pie,
  mixins: [reactiveProp],
  props: {
    height: {
      default: 110,
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
      legend: {
        display: true,
        position: 'right',
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