<template>
  <Bar
      :chart-data="chartData"
      :chart-options="options"
      :height="height"
      :plugins="plugins"
  />
</template>

<script>
import { Bar } from 'vue-chartjs'
import HandlesPlugins from './mixins/HandlesPlugins';

export default {
  components: {Bar},
  props: {
    height: {
      default: 120,
      type: Number
    }
  },
  mixins: [HandlesPlugins],
}
</script>
