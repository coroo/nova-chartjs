import { Scatter } from 'vue-chartjs'

export default {
  extends: Scatter,
  props: {
    chartData: 'chartData',
    options: 'options',
    height: {
      default: '67',
      type: Number
    }
  },
  data: () => ({
    options: {}
  }),
  methods: {
    renderStackedChart () {
      this.renderChart(this.chartData, this.options)
    }
  },
  mounted () {
    this.renderChart(this.chartdata, this.options)
  },
  watch: {
    chartData () {
      this.$data._chart.destroy()
      this.renderStackedChart()
    }
  }
}