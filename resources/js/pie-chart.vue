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
import HandlesDataLabelsPlugin from './mixins/HandlesDataLabelsPlugin';

export default {
  components: {Pie},
  props: {
    height: {
      default: 110,
      type: Number
    }
  },
  mixins: [HandlesDataLabelsPlugin],
}
</script>
