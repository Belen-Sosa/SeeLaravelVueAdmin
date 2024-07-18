<template>
  <div>
    <h1>Resultados de la encuesta: {{ data.title }}</h1>



    <div v-for="(question, index) in dataResponses" :key="index">
      <div v-if="question.type=='graphic'">
          <h3>{{ question.text }}</h3>
     
         <DoughnutChart  :labels="question.labels" :data="question.data" />


      </div> 
     
      <div v-if="question.type=='text'">
        <h3>{{ question.text }}</h3>
        <ul>
          <li v-for="(response, index) in question.responses" :key="index">{{ response }}</li>
        </ul>
      </div>
    </div>

    
  </div>
 
 
</template>

<script setup>
import { ref, onMounted } from 'vue';
import DoughnutChart from '@/Components/Surveys/DoughnutChart.vue';

const props = defineProps({
  data: {
    type: Object,
    required: true
  }
});

const questions = ref([]);
const textQuestionsRef = ref([]);
const dataResponses= ref([]);
onMounted(() => {
  transformSurveyData(props.data);
});

function transformSurveyData(survey) {
  const formattedQuestions = [];
  const textQuestions = [];
  const data=[];
 

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

      formattedQuestions.push({
        text: question.title,
        labels,
        data: resultsCount

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

      textQuestions.push({
        text: question.title,
        responses
      });
      data.push({
        type: "text",
        text: question.title,
        responses

      });
    }
  });

  // Actualizar los valores reactivos de Vue
  questions.value = formattedQuestions;
  textQuestionsRef.value = textQuestions; // Actualizar la ref correcta
  dataResponses.value= data;
}
</script>
