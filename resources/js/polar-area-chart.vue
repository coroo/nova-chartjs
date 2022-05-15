<template>
  <PolarArea
      :chart-data="chartData"
      :chart-options="options"
      :height="height"
      :plugins="plugins"
  />
</template>
<script>
  import { PolarArea } from 'vue-chartjs'
  import HandlesDataLabelsPlugin from './mixins/HandlesDataLabelsPlugin';

  export default {
    components: {PolarArea},
    props: {
      height: {
        default: 110,
        type: Number
      }
    },
    mixins: [HandlesDataLabelsPlugin],
  }
</script>
