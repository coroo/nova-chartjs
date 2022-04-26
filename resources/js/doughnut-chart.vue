<template>
  <Doughnut
      :chart-data="chartData"
      :chart-options="options"
      :height="height"
      :plugins="plugins"
  />
</template>
<script>
import { Doughnut } from 'vue-chartjs'
import HandlesDataLabelsPlugin from './mixins/HandlesDataLabelsPlugin';

export default {
  components: {Doughnut},
  props: {
    height: {
      default: 110,
      type: Number
    }
  },
  mixins: [HandlesDataLabelsPlugin],
}
</script>
