import { Line } from 'vue-chartjs'
import ChartDataLabels from 'chartjs-plugin-datalabels';
Chart.plugins.unregister(ChartDataLabels);

export default {
  extends: Line,
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
      default: 120,
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
      if(this.options.plugins !== undefined){
        if(this.options.plugins.datalabels !== undefined){
          if(this.options.plugins.datalabels !== false){
            this.addPlugin(ChartDataLabels);
          }
        }
      }
      this.$data._chart.destroy()
      this.renderStackedChart()
    }
  }
}