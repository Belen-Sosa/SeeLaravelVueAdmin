<!-- DoughnutChart.vue -->
<template>
  <div style="width: 400px; margin-bottom: 20px;">
    <canvas ref="canvas"></canvas>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Chart from 'chart.js/auto';

const props = defineProps({
  labels: {
    type: Array,
    required: true
  },
  data: {
    type: Array,
    required: true
  }
});

const canvas = ref(null);

onMounted(() => {
  // Calculate percentages
  const total = props.data.reduce((acc, val) => acc + val, 0);
  const labelsWithPercentages = props.labels.map((label, index) => {
    const percentage = ((props.data[index] / total) * 100).toFixed(2) + '%';
    return `${label} (${percentage})`;
  });

  new Chart(canvas.value.getContext('2d'), {
    type: 'doughnut',
    data: {
      labels: labelsWithPercentages,
      datasets: [{
        data: props.data,
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(153, 102, 255)',
          'rgb(255, 159, 64)'
        ],
        hoverOffset: 4
      }]
    },
    
  });
});
</script>
