<template>
  <div>
    <h1>Resultados de la encuesta: {{ data.title }}</h1>
    <button @click="generatePDF">Generar PDF</button>
    <div ref="content">
      <div v-for="(question, index) in dataResponses" :key="index">
        <div v-if="question.type == 'graphic'">
          <h3>{{ question.text }}</h3>
          <DoughnutChart :labels="question.labels" :data="question.data" ref="chartRefs"/>
        </div>
        <div v-if="question.type == 'text'">
          <h3>{{ question.text }}</h3>
          <ul>
            <li v-for="(response, index) in question.responses" :key="index">{{ response }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import DoughnutChart from '@/Components/Surveys/DoughnutChart.vue';
import jsPDF from 'jspdf';

const props = defineProps({
  data: {
    type: Object,
    required: true
  }
});

const dataResponses = ref([]);
const chartRefs = ref([]);

onMounted(() => {
  transformSurveyData(props.data);
});

function transformSurveyData(survey) {
  const data = [];

  survey.questions.forEach(question => {
    if (question.type_question_id !== 3) {
      // Procesar preguntas que no son de texto
      const labels = question.options.map(option => option.value);
      const resultsCount = new Array(labels.length).fill(0);

      question.results.forEach(result => {
        if (result.option_id !== null) {
          const optionIndex = question.options.findIndex(option => option.id === result.option_id);
          if (optionIndex !== -1) {
            resultsCount[optionIndex]++;
          }
        }
      });

      data.push({
        type: "graphic",
        text: question.title,
        labels,
        data: resultsCount
      });
    } else {
      // Procesar preguntas de texto
      const responses = question.results.map(result => result.text).filter(text => text !== null);

      data.push({
        type: "text",
        text: question.title,
        responses
      });
    }
  });

  dataResponses.value = data;
}

async function generatePDF() {
  const doc = new jsPDF();
  let yOffset = 10; // Starting Y offset for content
  const pageHeight = doc.internal.pageSize.height;
  const margin = 10;
  const lineHeight = 10;

  // Add survey title
  doc.text(`Resultados de la encuesta: ${props.data.title}`, 10, yOffset);
  yOffset += lineHeight;

  for (const [index, question] of dataResponses.value.entries()) {
    const lines = doc.splitTextToSize(`${index + 1}. ${question.text}`, pageHeight - margin * 2);
    doc.text(lines, margin, yOffset);
    yOffset += lines.length * lineHeight;

    if (question.type === 'graphic') {
      const chartRef = chartRefs.value[index].$refs.canvas;
      const chartImg = chartRef.toDataURL('image/png');
      const chartWidth = chartRef.width;
      const chartHeight = chartRef.height;
      const ratio = chartWidth / chartHeight;
      const pdfWidth = 180; // Maximum width in PDF
      const pdfHeight = pdfWidth / ratio;

      if (yOffset + pdfHeight > pageHeight - margin) {
        doc.addPage();
        yOffset = margin;
      }

      doc.addImage(chartImg, 'PNG', margin, yOffset, pdfWidth, pdfHeight);
      yOffset += pdfHeight + margin;
    } else if (question.type === 'text') {
      for (const response of question.responses) {
        const responseLines = doc.splitTextToSize(`- ${response}`, pageHeight - margin * 2);
        doc.text(responseLines, margin, yOffset);
        yOffset += responseLines.length * lineHeight;

        if (yOffset > pageHeight - margin) {
          doc.addPage();
          yOffset = margin;
        }
      }
    }

    // Add some space between questions
    yOffset += margin;

    if (yOffset > pageHeight - margin) {
      doc.addPage();
      yOffset = margin;
    }
  }

  doc.save('resultados_encuesta.pdf');
}
</script>
