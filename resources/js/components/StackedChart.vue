<template>
    <card class="p-10">
        <h4 class="chart-js-dashboard-title">{{ checkTitle }}</h4>
        <line-chart :chart-data="datacollection" :options="options"></line-chart>
    </card>
</template>

<script>
  import LineChart from '../stacked-chart.js'

  export default {
    components: {
      LineChart
    },
    data () {
      return {
        datacollection: null,
        options: null,
      }
    },
    computed: {
      checkTitle() {
        return this.card.title !== undefined ? this.card.title : 'Chart JS Integration';
      }
    },
    props: [
        'card'
    ],
    mounted () {
      this.fillData()
    },
    methods: {
      fillData () {
        this.title = this.card.title,
        this.datacollection = {
          labels: this.card.options.xaxis.categories,
          datasets: this.card.series,
        },
        this.options = {
          scales: this.card.options.scales,
          titlep: {
            display: true,
            fontSize: '16',
            fontColor: '#7c858e',
            fontFamily: "'Nunito'",
            fontStyle: 'bold',
            text: 'Oversikt'
          }
        }
      }
    },
  }
</script>

<style>
  .small {
    max-width: 600px;
    margin:  150px auto;
  }
  .chart-js-dashboard-title{
    color: #7c858e;
    font-size: 1rem;
    font-weight: 800;
    margin: 10px 30px 2px;
  }
</style>