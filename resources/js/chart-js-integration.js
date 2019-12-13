import StackedChart from './components/StackedChart'
import BarChart from './components/BarChart'

Nova.booting((Vue, router, store) => {
    Vue.component('stacked-chart', StackedChart);
    Vue.component('bar-chart', BarChart);
})
