import StackedChart from './components/StackedChart'
import BarChart from './components/BarChart'
import LineChart from './components/StripeChart'
import DoughnutChart from './components/DoughnutChart'
import PieChart from './components/PieChart'
import PolarAreaChart from './components/PolarAreaChart'
import ScatterChart from './components/ScatterChart'

Nova.booting((Vue, router, store) => {
    Vue.component('stacked-chart', StackedChart);
    Vue.component('bar-chart', BarChart);
    Vue.component('stripe-chart', LineChart);
    Vue.component('doughnut-chart', DoughnutChart);
    Vue.component('pie-chart', PieChart);
    Vue.component('polar-area-chart', PolarAreaChart);
    Vue.component('scatter-chart', ScatterChart);
})
