<template>
    <card class="p-10">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
      <div class="stay-right" v-show="buttonRefresh">
        <button @click="fillData()" class="btn-refresh">
          <i class="fas fa-sync"></i>
        </button>
      </div>
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
        buttonRefresh: this.card.options.btnRefresh,
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
  .stay-right {
    text-align: right;
    width: 100%;
    font-size: 12px;
    padding: 5px;
    margin-bottom: -40px;
  }
  .btn-refresh {
    background-color: #e0e0e0;
    color: #777;
    padding: 5px;
    border-radius: 5px;
  }
  .btn-refresh:hover {
    color: #111;
  }
  .fa-sync:hover {
    -webkit-animation: spin 2s infinite linear;
    -moz-animation: spin 2s infinite linear;
    -o-animation: spin 2s infinite linear;
    animation: spin 2s infinite linear;
  }

  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>