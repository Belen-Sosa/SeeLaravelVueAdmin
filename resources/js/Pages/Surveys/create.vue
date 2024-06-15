<script>
export default {
    name: "SurveysCreate",
};
</script>

<script setup>
//importamos el componente form de inertia que nos permite pintar un formulario 
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue'
import SurveyForm from '@/Components/Surveys/Form.vue'

defineProps({
    careers:{
        type: Object,
        required:true
    },
    subjects:{
        type: Object,
        required:true
    }
})

const form = useForm({
    title:'',
    career_id:'',
    subject_id:'',
    description:'',
    final_date:null,
   
})


  </script>

<template>
    <AppLayout >
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight" v-if="$page.props.user.permissions.includes('create survey')">
                Agregar nueva Encuesta
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 ">
                        <!-- haacemos un emit a traves del submit (@ es el atajo para el v-on dentro de vue)para llamar a la ruta de store(ruta de guardado) -->
                        <SurveyForm :form="form" :careers="careers" :subjects="subjects" @submit="form.post(route('surveys.store'))"></SurveyForm>

                    </div>

                </div>

            </div>

        </div>
    </AppLayout>

</template>