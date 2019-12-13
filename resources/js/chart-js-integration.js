import ChartJsIntegration from './components/ChartJsIntegration'

Nova.booting((Vue, router, store) => {
    Vue.component('chart-js-integration', ChartJsIntegration);
})
