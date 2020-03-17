<template>
    <card class="p-10">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
      <div class="stay-right">
        <button @click="fillData()" class="btn-refresh" v-show="buttonRefresh">
          <i class="fas fa-sync"></i>
        </button>
        <a :href="externalLink" :target="externalLinkIn" class="btn-external" v-show="btnExtLink">
          <i class="fas fa-external-link-alt"></i>
        </a>
      </div>
      <h4 class="chart-js-dashboard-title">{{ checkTitle }}</h4>
      <line-chart :chart-data="datacollection" :options="options"></line-chart>
    </card>
</template>

<script>
  import LineChart from '../bar-chart.js'

  export default {
    components: {
      LineChart
    },
    data () {
      this.card.options = this.card.options != undefined ? this.card.options : false;
      return {
        datacollection: null,
        options: null,
        buttonRefresh: this.card.options.btnRefresh,
        btnExtLink: this.card.options.extLink != undefined ? true : false,
        externalLink: this.card.options.extLink,
        externalLinkIn: this.card.options.extLinkIn != undefined ? this.card.options.extLinkIn : '_self',
        sweetAlert: this.card.options.sweetAlert2 != undefined ? this.card.options.sweetAlert2 : undefined,
        chartLayout: this.card.options.layout != undefined ? this.card.options.layout :
          {
            padding: {
              left: 20,
              right: 20,
              top: 0,
              bottom: 10
            }
          },
        chartLegend: this.card.options.legend != undefined ? this.card.options.legend :
          {
            display: true,
            position: 'left',
            labels: {
              fontColor: '#7c858e',
              fontFamily: "'Nunito'"
            }
          },
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
      this.fillData();
    },
    methods: {
      fillData () {
        this.options = {
          layout: this.chartLayout,
          legend: this.chartLegend,
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
          responsive: true,
          maintainAspectRatio: false,
        };

        if(this.card.model == 'custom' || this.card.model == undefined){
        // Custom Data
          this.title = this.card.title,
          this.datacollection = {
            labels: this.card.options.xaxis.categories,
            datasets: this.card.series,
          }

          // START == SETUP POPUP
          const sweetAlert = this.sweetAlert;
          if(sweetAlert != undefined) {
            this.options.onClick = function (event) {
              let element = this.getElementAtEvent(event);
              if (element.length > 0) {
              var series= element[0]._model.datasetLabel;
              var label = element[0]._model.label;
              var value = this.data.datasets[element[0]._datasetIndex].data[element[0]._index];

              const Swal = require('sweetalert2')
              Swal.fire({
                title: sweetAlert.title != undefined ? sweetAlert.title : '<strong>'+value+'</strong>',
                icon: sweetAlert.icon != undefined ? sweetAlert.icon : 'success',
                html: sweetAlert.html != undefined ? sweetAlert.html : series == undefined ? 'You can see detail by click below button:' : '<b>' + series + '</b> in '+label+'<br/> ',
                showCloseButton: sweetAlert.showCloseButton != undefined ? sweetAlert.showCloseButton : true,
                showCancelButton: sweetAlert.showCancelButton != undefined ? sweetAlert.showCancelButton : true,
                focusConfirm: sweetAlert.focusConfirm != undefined ? sweetAlert.focusConfirm : false,
                confirmButtonText: sweetAlert.confirmButtonText != undefined ? sweetAlert.confirmButtonText : '<i class="fas fa-external-link-alt"></i> See Detail',
                confirmButtonAriaLabel: sweetAlert.confirmButtonAriaLabel != undefined ? sweetAlert.confirmButtonAriaLabel : 'See Detail',
                cancelButtonAriaLabel: sweetAlert.cancelButtonAriaLabel != undefined ? sweetAlert.cancelButtonAriaLabel : 'Cancel',
                footer: sweetAlert.footer != undefined ? sweetAlert.footer : '<a href="https://coroo.github.io/nova-chartjs/" target="_blank" style="text-decoration:none; color:#777; font-size:14px">Nova Chart JS © ' + new Date().getFullYear() + '</a>',
                ...sweetAlert
              }).then((result) => {
                if (result.value) {
                  window.location = sweetAlert.linkTo != undefined ? sweetAlert.linkTo : "https://coroo.github.io/nova-chartjs/";
                }
              })}
            };
          };
          // END == SETUP POPUP
          
        } else {
        // Use Model
          Nova.request().get("/coroowicaksono/check-data/endpoint/", {
            params: {
                model: this.card.model,
                series: this.card.series,
                options: this.card.options,
                join: this.card.join,
                expires: 0,
            },
          })
          .then(({ data }) => {
            this.datacollection = {
              labels: data.dataset.xAxis,
              datasets: data.dataset.yAxis,
            };

            // START == SETUP POPUP
            const sweetAlert = this.sweetAlert;
            if(sweetAlert != undefined) {
              this.options.onClick = function (event) {
                let element = this.getElementAtEvent(event);
                if (element.length > 0) {
                var series= element[0]._model.datasetLabel;
                var label = element[0]._model.label;
                var value = this.data.datasets[element[0]._datasetIndex].data[element[0]._index];

                const Swal = require('sweetalert2')
                Swal.fire({
                  title: sweetAlert.title != undefined ? sweetAlert.title : '<strong>'+value+'</strong>',
                  icon: sweetAlert.icon != undefined ? sweetAlert.icon : 'success',
                  html: sweetAlert.html != undefined ? sweetAlert.html : series == undefined ? 'You can see detail by click below button:' : '<b>' + series + '</b> in '+label+'<br/> ',
                  showCloseButton: sweetAlert.showCloseButton != undefined ? sweetAlert.showCloseButton : true,
                  showCancelButton: sweetAlert.showCancelButton != undefined ? sweetAlert.showCancelButton : true,
                  focusConfirm: sweetAlert.focusConfirm != undefined ? sweetAlert.focusConfirm : false,
                  confirmButtonText: sweetAlert.confirmButtonText != undefined ? sweetAlert.confirmButtonText : '<i class="fas fa-external-link-alt"></i> See Detail',
                  confirmButtonAriaLabel: sweetAlert.confirmButtonAriaLabel != undefined ? sweetAlert.confirmButtonAriaLabel : 'See Detail',
                  cancelButtonAriaLabel: sweetAlert.cancelButtonAriaLabel != undefined ? sweetAlert.cancelButtonAriaLabel : 'Cancel',
                  footer: sweetAlert.footer != undefined ? sweetAlert.footer : '<a href="https://coroo.github.io/nova-chartjs/" target="_blank" style="text-decoration:none; color:#777; font-size:14px">Nova Chart JS © ' + new Date().getFullYear() + '</a>',
                  ...sweetAlert
                }).then((result) => {
                  if (result.value) {
                    window.location = sweetAlert.linkTo != undefined ? sweetAlert.linkTo : "https://coroo.github.io/nova-chartjs/";
                  }
                })}
              };
            };
            // END == SETUP POPUP

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
    min-height: 35px;
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
  .btn-external {
    background-color: #e0e0e0;
    color: #777;
    padding: 5px;
    border-radius: 5px;
  }
  .btn-external:hover {
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