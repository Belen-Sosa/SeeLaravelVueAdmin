<script>
export default {
    name:'SurveyEdit'
}
</script>


<script setup>
//importamos el componente form de inertia que nos permite pintar un formulario 
import {useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import SurveyForm from '@/Components/Surveys/Form.vue'

const props= defineProps({
    survey:{
        type: Object,
        required:true
    },
   
  

})
const form = useForm({
    title:props.survey.title,
    career_id:props.survey.career_id,
    subject_id:props.survey.subject_id,
    description:props.survey.description,
    final_date:props.survey.final_date
   
})
   
</script>

<template>
<AppLayout >
   
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Editar Encuesta</h1>
        </template>
        <div class="py-12">
            <div class="max-ww-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <SurveyForm :updating="true" :careers="careers"  :form="form" @submit="form.put(route('surveys.update',survey.id))"></SurveyForm>

                    </div>

                </div>


            </div>

        </div>
  

</AppLayout>
</template>