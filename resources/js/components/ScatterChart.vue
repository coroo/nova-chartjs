<template>
  <loading-card :loading="loading" class="min-h-40">
    <div class="h-6 flex items-center px-6 mt-4 pb-0">
      <h4 class="mr-3 leading-tight text-sm font-bold">{{ checkTitle }}</h4>
      <div class="flex relative ml-auto flex-shrink-0">
        <default-button size="xs" class="mr-2" @click="fillData()" v-show="buttonRefresh">
          <icon-refresh />
        </default-button>
        <default-button size="xs" class="mr-2" @click="reloadPage()" v-show="buttonReload">
          <icon-refresh />
        </default-button>
        <default-button size="xs" class="mr-2" component="a" :href="externalLink" :target="externalLinkIn" v-show="btnExtLink">
          <icon-external-link />
        </default-button>
      </div>
    </div>
    <line-chart v-if="!loading" :chart-data="datacollection" :options="options"></line-chart>
  </loading-card>
</template>

<script>
  import LineChart from '../scatter-chart.vue';
  import IconRefresh from './Icons/IconRefresh';
  import IconExternalLink from './Icons/IconExternalLink';

  export default {
    components: {
      IconExternalLink,
      IconRefresh,
      LineChart
    },
    data () {
      this.card.options = this.card.options != undefined ? this.card.options : false;
      return {
        datacollection: {},
        options: {},
        loading: false,
        buttonRefresh: (this.card.options != undefined) ? this.card.options.btnRefresh : false,
        buttonReload: this.card.options.btnReload,
        btnExtLink: this.card.options.extLink != undefined ? true : false,
        externalLink: this.card.options.extLink,
        externalLinkIn: this.card.options.extLinkIn != undefined ? this.card.options.extLinkIn : '_self',
        chartTooltips: this.card.options.tooltips != undefined ? this.card.options.tooltips : undefined,
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
      reloadPage(){
        window.location.reload()
      },
      fillData () {
        this.options = {
          ...this.card.options,
          layout: this.chartLayout,
          scales: {
            ...this.card.options.scales || {},
            xAxes: {
              type: 'linear',
              position: 'bottom',
              stacked: true,
              ...this.card.options.scales?.xAxes || {},
              ticks: {
                ...this.card.options.scales?.xAxes?.ticks || {},
                font: {
                  lineHeight: 0.8,
                  size: 10,
                  ...this.card.options.scales?.xAxes?.ticks?.font || {},
                }
              }
            }
          },
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: this.chartLegend,
            ...this.chartPlugins,
          },
        };

        if(this.chartTooltips !== undefined){
          this.options.plugins.tooltip = this.chartTooltips;
          const tooltiplist = ["custom", "itemSort", "filter"];
          for (let z = 0; z < tooltiplist.length; z++) {
            if(this.options.plugins.tooltip[tooltiplist[z]] != undefined){
              if(this.options.plugins.tooltip[tooltiplist[z]].search("function") != -1){
                eval("this.options.plugins.tooltip." + tooltiplist[z] + " = " + this.options.plugins.tooltip[tooltiplist[z]]);
              }
            }
          }

          if(this.chartTooltips.callbacks !== undefined){
            const callbacklist = ["beforeTitle", "title", "afterTitle", "beforeBody", "beforeLabel", "label", "labelColor", "labelTextColor", "afterLabel", "afterBody", "beforeFooter", "footer", "afterFooter"];
            for (let i = 0; i < callbacklist.length; i++) {
              if(this.options.plugins?.tooltip?.callbacks?.[callbacklist[i]] != undefined){
                if(this.options.plugins.tooltip.callbacks[callbacklist[i]].search("function") != -1){
                  eval("this.options.plugins.tooltip.callbacks." + callbacklist[i] + " = " + this.options.plugins.tooltip.callbacks[callbacklist[i]]);
                }
              }
            }
          }
        }

        if(this.card.model == 'custom' || this.card.model == undefined){
        // Custom Data
          this.title = this.card.title;
          this.datacollection = {
            datasets: this.card.series,
          }
          this.options = this.options;
        } else {
        // Use Model
          this.loading = true;
          Nova.request().get("/nova-vendor/coroowicaksono/check-data/endpoint", {
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
            this.loading = false;
          })
          .catch(({ response }) => {
            this.errors = response.data.errors;
            this.loading = false;
          })
        }
      },
    },
  }
</script>
