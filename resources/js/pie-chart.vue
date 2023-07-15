<template>
    <Pie
        :chart-data="chartData"
        :chart-options="options"
        :height="height"
        :plugins="plugins"
    />
</template>

<script>
import { Pie } from 'vue-chartjs'
import HandlesPlugins from './mixins/HandlesPlugins';

export default {
  components: {Pie},
  props: {
    height: {
      default: 110,
      type: Number
    }
  },
  mixins: [HandlesPlugins],
}
</script>
