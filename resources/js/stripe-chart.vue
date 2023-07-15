<template>
  <Line
      :chart-data="chartData"
      :chart-options="options"
      :height="height"
      :plugins="plugins"
  />
</template>
<script>
  import { Line } from 'vue-chartjs'
  import HandlesPlugins from './mixins/HandlesPlugins';

  export default {
    components: {Line},
    props: {
      height: {
        default: 120,
        type: Number
      }
    },
    mixins: [HandlesPlugins],
  }
</script>
