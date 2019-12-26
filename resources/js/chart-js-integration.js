import StackedChart from './components/StackedChart'
import BarChart from './components/BarChart'
import LineChart from './components/StripeChart'

Nova.booting((Vue, router, store) => {
    Vue.component('stacked-chart', StackedChart);
    Vue.component('bar-chart', BarChart);
    Vue.component('stripe-chart', LineChart);
})
