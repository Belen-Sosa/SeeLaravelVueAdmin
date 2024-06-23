<script>
export default {
    name: "QuestionsIndex",
};
</script>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import {Inertia} from '@inertiajs/inertia'
import { useForm } from '@inertiajs/vue3';
import FormQuestion from "@/Components/Surveys/FormQuestion.vue";
import Modal from "@/Components/Modal.vue"



const props= defineProps({

    //aseguramos que recibimos el elemento que es un objeto y ponemos que es requerido para que todo funcione correctamente
    survey_questions:{
        type: Object,
        required: true
    } ,
    type_questions:{
        type:Object,
        required: true
    },

   
})

const form = useForm({
  
    survey_id:props.survey_questions.id,
    title:"",
    type_question_id:"",
 
   
})


//utilizamos el confirm de js para asegurarnos de la accion y si es asi inertia hace una solicitud de delete
const deleteQuestion= id =>{
    if(confirm('¿Desea eliminar esta pregunta?')){
        Inertia.delete(route('questions.destroy',id))
    }
}

const handleEdit = (question, updatedData) => {
    form.title = updatedData.title;
    form.type_question_id = question.type_question.id;
    form.put(route('questions.update', question.id));
};

</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Preguntas
                
            </h1>

        </template>
      <div class="py-12">
 
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             
                <div class="p-6 bg-white border-b border-gray-200">
                  
                    <div class="flex justify-between" >
                          
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                      Preguntas de la Encuesta :  {{survey_questions.title }}
                      </h1>
                      <FormQuestion  v-if="$page.props.user.permissions.includes('create question')"  :form="form" :survey_id="survey_questions.id" :type_questions="type_questions" @submit="form.post(route('questions.store'))"></FormQuestion>
                      <!-- Button trigger modal -->
                      
                    </div>

                    <div class="mt-4">
                        <table
                        class="divide-y divide-gray-100 min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead
                        class="border-b border-neutral-200 font-medium dark:border-white/10">
                        <tr>
                            <th scope="col" class="px-6 py-4">Titulo</th>
                            <th scope="col" class="px-6 py-4">Tipo de pregunta</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-neutral-200 dark:border-white/10"  v-for="question in survey_questions.questions">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">  {{question.title}}</td>
                            <td class="whitespace-nowrap px-6 py-4">  {{question.type_question.name}}</td>
                       
                      
                            <td  class="whitespace-nowrap px-6 py-4"> <Link class="py-2 px-4" :href="route('options.index',question.id)"  v-if="$page.props.user.permissions.includes('create option')" >Agregar Opcion </Link></td>
                            <td>  <FormQuestion  v-if="$page.props.user.permissions.includes('update question')" 
                                 :updating="true" :form="form" :survey_id="survey_questions.id" :type_questions="type_questions"
                                  @submitEdit="handleEdit(question,$event)"></FormQuestion>
                            </td>
                                
                             
                            <td> <Link class="py-2 px-4 text-red-600" @click="deleteQuestion(question.id)"  v-if="$page.props.user.permissions.includes('delete question')"> Borrar</Link></td>
                           
                    
                       </tr>


                        
                        
                        </tbody>
                    </table>
                      
                    </div>
                   
               

                </div>
            </div>
        </div>
    




        
    </AppLayout>

</template>



