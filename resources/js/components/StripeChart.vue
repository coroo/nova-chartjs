<template>
    <card class="p-10">
        <h4 class="chart-js-dashboard-title">{{ checkTitle }}</h4>
        <line-chart :chart-data="datacollection" :options="options"></line-chart>
    </card>
</template>

<script>
  import LineChart from '../stripe-chart.js'

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
        if(this.card.model == 'custom' || this.card.model == undefined){
          this.title = this.card.title,
          this.datacollection = {
            labels: this.card.options.xaxis.categories,
            datasets: this.card.series,
          }
        } else {
          Nova.request().get("/coroowicaksono/check-data/endpoint/", {
            params: {
                model: this.card.model,
                series: this.card.series,
                options: this.card.options,
                expires: 0,
            },
          })
          .then(({ data }) => {
            this.datacollection = {
              labels: data.dataset.xAxis,
              datasets: data.dataset.yAxis,
            };
          })
          .catch(({ response }) => {
            this.$set(this, "errors", response.data.errors)
          })
        }
      },
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
    margin: 0;
    padding: 1rem 1.5rem 2px;
  }
</style>