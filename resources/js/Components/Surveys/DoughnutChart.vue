<!-- DoughnutChart.vue -->
<template>
  <div class="chart-container">
    <div class="chart">
      <canvas ref="canvas"></canvas>
    </div>
    <div class="labels">
      <div v-for="(label, index) in labelsWithPercentages" :key="index" class="label">
        <div class="color-box" :style="{ backgroundColor: backgroundColors[index] }"></div>
        <span>{{ label }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
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

const backgroundColors = [
  'rgb(255, 99, 132)',
  'rgb(54, 162, 235)',
  'rgb(255, 205, 86)',
  'rgb(75, 192, 192)',
  'rgb(153, 102, 255)',
  'rgb(255, 159, 64)'
];

const labelsWithPercentages = computed(() => {
  const total = props.data.reduce((acc, val) => acc + val, 0);
  return props.labels.map((label, index) => {
    const percentage = ((props.data[index] / total) * 100).toFixed(2) + '%';
    return `${label} (${percentage})`;
  });
});

onMounted(() => {
  new Chart(canvas.value.getContext('2d'), {
    type: 'doughnut',
    data: {
    
      datasets: [{
        data: props.data,
        backgroundColor: backgroundColors,
        hoverOffset: 4
      }]
    },
    options: {
      plugins: {
        tooltip: {
          enabled: false // Disable tooltips to avoid overlapping with custom labels
        }
      },
      responsive: true,
      maintainAspectRatio: false
    }
  });
});


</script>


<style scoped>
.chart-container {
  display: flex;
  align-items: center;
}



.labels {
  flex: 0 0 auto;
  margin-left: 20px;
}

.label {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  color: #000;
}

.color-box {
  width: 15px;
  height: 15px;
  margin-right: 10px;
}
.chart {
  width: 150px; /* Ajusta este valor según sea necesario */
  height: 150px; /* Si deseas controlar la altura también */
}
</style>
