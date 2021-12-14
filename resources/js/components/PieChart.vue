<template>
    <card class="p-10">
      <div class="stay-right">
        <a @click="fillData()" class="btn-refresh" v-show="buttonRefresh">
          <i class="fas fa-sync"></i>
        </a>
        <a @click="reloadPage()" class="btn-refresh" v-show="buttonReload">
          <i class="fas fa-sync"></i>
        </a>
        <a :href="externalLink" :target="externalLinkIn" class="btn-external" v-show="btnExtLink">
          <i class="fas fa-external-link-alt"></i>
        </a>
        <select @change="fillData()" v-model="advanceFilterSelected" v-show="showAdvanceFilter" class="select-box-sm ml-auto min-w-24 h-6 text-xs appearance-none bg-40 pl-2 pr-6 active:outline-none active:shadow-outline focus:outline-none focus:shadow-outline">
          <option v-for="filter in advanceFilter" v-bind:value="filter.value" :key="filter.key">
            {{ filter.text }}
          </option>
        </select>
      </div>
      <h4 class="chart-js-dashboard-title">{{ checkTitle }}</h4>
      <line-chart :chart-data="datacollection" :options="options"></line-chart>
    </card>
</template>

<style>
  @import '../../css/main.css';
</style>

<script>
  import LineChart from '../pie-chart.js'
  import ChartDataLabels from 'chartjs-plugin-datalabels';
  Chart.plugins.unregister(ChartDataLabels);

  export default {
    components: {
      LineChart
    },
    data () {
      this.card.options = this.card.options != undefined ? this.card.options : false;

      // setup btn filter list
      const btnFilterList = this.card.options.btnFilterList;
      let filledAdvancedList = [];
      let i = 0;

      for ( var index in btnFilterList ) {
        filledAdvancedList[i] = {value: index, text: btnFilterList[index]};
        i++;
      }

      return {
        datacollection: {},
        options: {},
        buttonRefresh: this.card.options.btnRefresh,
        buttonReload: this.card.options.btnReload,
        btnExtLink: this.card.options.extLink != undefined ? true : false,
        externalLink: this.card.options.extLink,
        externalLinkIn: this.card.options.extLinkIn != undefined ? this.card.options.extLinkIn : '_self',
        chartTooltips: this.card.options.tooltips != undefined ? this.card.options.tooltips : undefined,
        sweetAlert: this.card.options.sweetAlert2 != undefined ? this.card.options.sweetAlert2 : undefined,
        chartPlugins: this.card.options.plugins != undefined ? this.card.options.plugins : false,
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
            position: 'right',
            labels: {
                fontColor: '#7c858e',
                fontFamily: "'Nunito'"
            }
          },
        showAdvanceFilter: this.card.model == 'custom' || this.card.model == undefined ? false : this.card.options.btnFilter == true ? true : false ,
        advanceFilterSelected: this.card.options.btnFilterDefault != undefined ? this.card.options.btnFilterDefault : 'QTD',
        advanceFilter: this.card.options.btnFilterList != undefined ? filledAdvancedList : [
          { text: 'Year to Date', value: 'YTD' },
          { text: 'Quarter to Date', value: 'QTD' },
          { text: 'Month to Date', value: 'MTD' },
          { text: '30 Days', value: 30 },
          { text: '60 Days', value: 60 },
          { text: '365 Days', value: 365 },
        ],
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
      reloadPage(){
        window.location.reload()
      },
      fillData () {
        this.options = {
          layout: this.chartLayout,
          legend: this.chartLegend,
          responsive: true,
          maintainAspectRatio: false,
          plugins: this.chartPlugins,
        };

        if(this.chartTooltips !== undefined){
          this.options.tooltips = this.chartTooltips;
          const tooltiplist = ["custom", "itemSort", "filter"];
          var z;
          for (z = 0; z < tooltiplist.length; z++) {
            if(this.options.tooltips[tooltiplist[z]] != undefined){
              if(this.options.tooltips[tooltiplist[z]].search("function") != -1){
                eval("this.options.tooltips." + tooltiplist[z] + " = " + this.options.tooltips[tooltiplist[z]]);
              }
            }
          }
          
          if(this.chartTooltips.callbacks !== undefined){
            const callbacklist = ["beforeTitle", "title", "afterTitle", "beforeBody", "beforeLabel", "label", "labelColor", "labelTextColor", "afterLabel", "afterBody", "beforeFooter", "footer", "afterFooter"];
            var i;
            for (i = 0; i < callbacklist.length; i++) {
              if(this.options.tooltips.callbacks[callbacklist[i]] != undefined){
                if(this.options.tooltips.callbacks[callbacklist[i]].search("function") != -1){
                  eval("this.options.tooltips.callbacks." + callbacklist[i] + " = " + this.options.tooltips.callbacks[callbacklist[i]]);
                }
              }
            }
          }
        }

        if(this.card.model == 'custom' || this.card.model == undefined){
        // Custom Data
          this.title = this.card.title,
          this.datacollection = {
            labels: this.card.options.xaxis.categories,
            datasets: this.card.series,
          }

          // START == SETUP POPUP
          const sweetAlertWithLink = this.sweetAlert;
          if(sweetAlertWithLink != undefined) {
            this.options.onClick = function (event) {
              let element = this.getElementAtEvent(event);
              if (element.length > 0) {
              var series= element[0]._model.datasetLabel;
              var label = element[0]._model.label;
              var value = this.data.datasets[element[0]._datasetIndex].data[element[0]._index];

              const toLink = sweetAlertWithLink.linkTo != undefined ? sweetAlertWithLink.linkTo : "https://coroo.github.io/nova-chartjs/";
              const { linkTo, ...sweetAlert } = sweetAlertWithLink;

              // sum data
              let dataArr = this.data.datasets[0].data;
              let sum = 0;
              sum = dataArr.reduce((a, b) => parseInt(a) + parseInt(b), 0);
              var percentage = (value / sum) * 100 ;

              const Swal = require('sweetalert2')
              Swal.fire({
                title: sweetAlert.title != undefined ? sweetAlert.title : '<strong>'+label+'</strong>',
                icon: sweetAlert.icon != undefined ? sweetAlert.icon : 'info',
                html: sweetAlert.html != undefined ? sweetAlert.html : 'Percentage: <b>' + percentage.toFixed(2) + '%</b><br/><b>'+value+'</b> data from <b>'+sum+'</b><br/> ',
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
                  window.location = toLink;
                }
              })}
            };
          };
          // END == SETUP POPUP

          if( this.card.options.showPercentage != undefined ) {
            if( this.card.options.showPercentage == true ) {
              let dataArr = this.card.series[0].data;
              let sum = 0;
              sum = dataArr.reduce((a, b) => parseInt(a) + parseInt(b), 0);
              this.options.tooltips = {
                callbacks: {
                  label: function(tooltipItem, data) {
                    return data['labels'][tooltipItem['index']] + ': ' + '' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + (data['datasets'][0]['data'][tooltipItem['index']]*100/sum).toFixed(2) + '%)';
                  }
                }
              };
            }
          }
        } else {
          if(this.showAdvanceFilter == true) this.card.options.advanceFilterSelected = this.advanceFilterSelected != undefined ? this.advanceFilterSelected : false;
          
          // Use Model
          Nova.request().get("/nova-vendor/coroowicaksono/check-data/circle-endpoint", {
            params: {
              model: this.card.model,
              series: this.card.series,
              options: this.card.options,
              join: this.card.join,
              col_xaxis: this.card.col_xaxis,
              expires: 0,
            },
          })
          .then(({ data }) => {
            this.datacollection = {
              labels: data.dataset.xAxis,
              datasets: data.dataset.yAxis,
            };
          
            // START == SETUP POPUP
            const sweetAlertWithLink = this.sweetAlert;
            if(sweetAlertWithLink != undefined) {
              this.options.onClick = function (event) {
                let element = this.getElementAtEvent(event);
                if (element.length > 0) {
                var series= element[0]._model.datasetLabel;
                var label = element[0]._model.label;
                var value = this.data.datasets[element[0]._datasetIndex].data[element[0]._index];

                const toLink = sweetAlertWithLink.linkTo != undefined ? sweetAlertWithLink.linkTo : "https://coroo.github.io/nova-chartjs/";
                const { linkTo, ...sweetAlert } = sweetAlertWithLink;

                // sum data
                let dataArr = this.data.datasets[0].data;
                let sum = 0;
                sum = dataArr.reduce((a, b) => parseInt(a) + parseInt(b), 0);
                var percentage = (value / sum) * 100 ;

                const Swal = require('sweetalert2')
                Swal.fire({
                  title: sweetAlert.title != undefined ? sweetAlert.title : '<strong>'+label+'</strong>',
                  icon: sweetAlert.icon != undefined ? sweetAlert.icon : 'info',
                  html: sweetAlert.html != undefined ? sweetAlert.html : 'Percentage: <b>' + percentage.toFixed(2) + '%</b><br/><b>'+value+'</b> data from <b>'+sum+'</b><br/> ',
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
                    window.location = toLink;
                  }
                })}
              };
            };
            // END == SETUP POPUP

            if( this.card.options.showPercentage != undefined ) {
              if( this.card.options.showPercentage == true ) {
                let dataArr = data.dataset.yAxis[0].data;
                let sum = 0;
                sum = dataArr.reduce((a, b) => parseInt(a) + parseInt(b), 0);
                this.options.tooltips = {
                  callbacks: {
                    label: function(tooltipItem, data) {
                      return data['labels'][tooltipItem['index']] + ': ' + '' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + (data['datasets'][0]['data'][tooltipItem['index']]*100/sum).toFixed(2) + '%)';
                    }
                  }
                };
              }
            }
          })
          .catch(({ response }) => {
            this.$set(this, "errors", response.data.errors)
          })
        }
      },
    },
  }
</script>