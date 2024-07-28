<template>
  <AppLayout>

    <div class="p-3  bg-white ">
    
      <button @click="generatePDF" class=" button-add ml-10">Generar PDF</button>
      <h1 class="m-10 font-semibold  leading-tight text-3xl drop-shadow-md  text-gray-800">Resultados de la encuesta: {{ data.title }}</h1>
      <div  class="m-10 font-semibold  ">


          <h2 >Apreciado/a Docente: </h2>  <br/>

           <p class="text-gray-700">El siguiente informe correspondiente a su asignatura, se ha realizado con la intención de dar a conocer a cada profesor,<br/>de manera individual las opiniones de los alumnos. <br/><br/>
            El mismo puede incluir, datos sobre su desempeño docente,<br/> situación adaptativa de los alumnos a las nuevas modalidades, etc. <br/><br/>
            Las opciones para su respuesta son adaptadas a la pregunta correspondiente. <br/><br/>
            El mismo quizás no refleje el esfuerzo y el desafio que ha representado para Ud. desarrollar las clases en forma mixta,<br/> pero a pesar de todo, ha demostrado su competencia. <br/><br/>
            Los resultados serán para la mejora continua de su labor docente y mejorar la comprensión de la situación entre los alumnos cursantes. </p> <br/>


      </div>
    
     
      <div ref="content">
        <div v-for="(question, index) in dataResponses" :key="index">
          <div v-if="question.type == 'graphic'" class=" m-10">
            <h3 class="ml-10 font-semibold leading-tight text-2xl drop-shadow-md text-gray-600">{{ question.text }}</h3>
            <DoughnutChart class="ml-10" :labels="question.labels" :data="question.data" ref="chartRefs"/>
          </div>
          <div v-if="question.type == 'text'" class=" m-10">
            <h3 class="ml-10 font-semibold leading-tight text-2xl drop-shadow-md text-gray-600 mb-5">{{ question.text }}</h3>
            <lo>
              <li class="ml-10" v-for="(response, index) in question.responses" :key="index">{{ response }}</li>
            </lo>
          </div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import DoughnutChart from '@/Components/Surveys/DoughnutChart.vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import { jsPDF } from "jspdf";
import html2canvas from "html2canvas";

const props = defineProps({
  data: {
    type: Object,
    required: true
  }
});

const dataResponses = ref([]);

onMounted(() => {
  transformSurveyData(props.data);
});

function transformSurveyData(survey) {
  const data = [];

  survey.questions.forEach(question => {
    if (question.type_question_id !== 3) {
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
  const pdf = new jsPDF('p', 'pt', 'a4');
  const content = document.querySelector('.p-3');

  // Hide the button and add a PDF-specific style class
  const button = content.querySelector('.button-add');
  if (button) button.style.display = 'none';
  content.classList.add('pdf-style');

  await html2canvas(content, { scale: 2 }).then(canvas => {
    const imgData = canvas.toDataURL('image/png');
    const imgWidth = 595.28; // A4 width in pt
    const pageHeight = 841.89; // A4 height in pt
    const imgHeight = canvas.height * imgWidth / canvas.width;
    let heightLeft = imgHeight;
    let position = 0;

    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
    heightLeft -= pageHeight;

    while (heightLeft >= 0) {
      position = heightLeft - imgHeight;
      pdf.addPage();
      pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
      heightLeft -= pageHeight;
    }
  });

 // Restore original styles
 if (button) button.style.display = 'block';
  content.classList.remove('pdf-style');

  const pdfBlob = pdf.output('blob');
  const pdfUrl = URL.createObjectURL(pdfBlob);
  window.open(pdfUrl, '_blank');
}
</script>

<style>
.pdf-style {
  background-color: #ffffff;
  color: #000000;
  /* Add other styles you want to apply specifically for the PDF */
}
</style>