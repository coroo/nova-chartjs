import ChartDataLabels from 'chartjs-plugin-datalabels';
import ChartDownloadData from 'chartjs-plugin-downloaddata';
import { Chart } from 'chart.js';

export default {
    props: {
        chartData: {
            type: Object,
            required: true
        },
        options:{
            type: Object,
            required: true
        },
    },
    data() {
        return {
            plugins: [],
        }
    },
    watch: {
        chartData () {
            if(this.options.plugins !== undefined){
                if(this.options.plugins.datalabels !== undefined){
                    if(this.options.plugins.datalabels !== false){
                        this.plugins.push(ChartDataLabels);
                    }
                }

                if(this.options.plugins.downloaddata !== undefined){
                    if(this.options.plugins.downloaddata !== false){
                        this.plugins.push(ChartDownloadData);
                    }
                }
            }
        },
    }
}
