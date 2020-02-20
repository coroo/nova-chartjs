import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  props: {
    chartData: 'chartData',
    options: 'options',
    height: {
      default: '120',
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