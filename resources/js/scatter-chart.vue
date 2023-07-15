<template>
    <Scatter
        :chart-data="chartData"
        :chart-options="options"
        :height="height"
    />
</template>

<script>
import { Scatter } from 'vue-chartjs'
import HandlesPlugins from './mixins/HandlesPlugins';

export default {
  components: { Scatter },
  props: {
    height: {
      default: 120,
      type: Number
    }
  },
  mixins: [HandlesPlugins],
}
</script>
