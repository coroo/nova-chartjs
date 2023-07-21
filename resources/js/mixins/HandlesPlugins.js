import ChartDataLabels from 'chartjs-plugin-datalabels';
import ChartDownloadData from '@razvanaldo/chart-js-plugin-for-downloading-data';
import {Chart} from 'chart.js';

export default {
    props: {
        chartData: {
            type: Object,
            required: true
        },
        options: {
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
        chartData() {
            if (this.options.plugins !== undefined) {
                if (this.options.plugins.datalabels !== undefined) {
                    if (this.options.plugins.datalabels !== false) {
                        this.plugins.push(ChartDataLabels);
                    }
                }

                if (typeof this.options.plugins === 'object') {
                    if (this.options.plugins.hasOwnProperty('downloaddata')) {
                        if (this.options.plugins.downloaddata !== undefined) {
                            if (this.options.plugins.downloaddata !== false) {
                                this.plugins.push(ChartDownloadData);
                            }
                        }
                    }
                }
            }
        },
    }
}
