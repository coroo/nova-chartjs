import { Pie } from 'vue-chartjs'

export default {
  extends: Pie,
  props: {
    chartData: {
      type: Object,
      required: true
    },
    options:{
      type: Object,
      required: true
    },
    height: {
      default: 110,
      type: Number
    }
  },
  methods: {
    renderStackedChart () {
      this.renderChart(this.chartData, this.options)
    }
  },
  mounted () {
    this.renderChart(this.chartData, this.options)
  },
  watch: {
    chartData () {
      this.$data._chart.destroy()
      this.renderStackedChart()
    }
  }
}