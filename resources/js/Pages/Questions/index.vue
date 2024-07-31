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
import Modal from "@/Components/ModalAlert.vue";
import { ref } from "vue";


const showConfirm = ref(false);
  const confirmMessage = ref('');
  let question_id = null;
  
  const confirmDelete = (id) => {
    confirmMessage.value = '¿Desea eliminar esta Pregunta?';
    question_id= id;
    showConfirm.value = true;
  };
  
  const confirmAction = () => {
    Inertia.delete(route('questions.destroy', question_id));
    showConfirm.value = false;
  };



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
const updatingForm=question =>{
    form.title = question.title;
    form.type_question_id = question.type_question.id;

}
const cleanForm = question => {
    form.title = question.title;
    form.type_question_id = question.type_question.id;
};



const handleEdit = (question) => {
    form.put(route('questions.update', question.id), {
        onSuccess: () => cleanForm()
    });
};

const handleSubmit = () => {
    form.post(route('questions.store'), {
        onSuccess: () => cleanForm()
    });
};






</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1 class="title">
                Preguntas
                
            </h1>

        </template>
      <div class="py-12">
 
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             
                <div class="content-data">
                  
                    <div class="flex justify-between" >
                          
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                        Preguntas de la Encuesta :  {{survey_questions.title }}
                      </h1>
                      <div class="button-add">
                      <FormQuestion  v-if="$page.props.user.permissions.includes('create question')"  
                      :form="form" :survey_id="survey_questions.id" :type_questions="type_questions" 
                      @cleanForm="cleanForm($event)";
                      @submit="handleSubmit"
                       
                   
                      ></FormQuestion>
                      <!-- Button trigger modal -->
                      </div>
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
                       
                      
                            <td  class="whitespace-nowrap px-6 py-4"> <Link class="py-2 px-4 border rounded shadow-inner bg-gray-200 hover:bg-gray-300" :href="route('options.show',question.id)"  v-if="$page.props.user.permissions.includes('create option') && question.type_question_id!=3" >Agregar Opcion </Link></td>
                            <td> <div class="button-edit"> <FormQuestion  v-if="$page.props.user.permissions.includes('update question')" 
                                 :updating="true" :form="form" :survey_id="survey_questions.id" :type_questions="type_questions"
                                  @submitEdit="handleEdit(question,$event)" 
                                  @updatingForm="updatingForm(question)"
                                  @cleanForm="cleanForm($event)";
                                  ></FormQuestion> </div>
                                  
                            </td>
                                
                             
                            <td> <button class="button-delete"  @click="confirmDelete(question.id)"  v-if="$page.props.user.permissions.includes('delete question')"><v-icon name="bi-trash3-fill" class="drop-shadow-md" /></button></td>
                           
                    
                       </tr>


                        
                        
                        </tbody>
                    </table>
                      
                    </div>
                   
               

                </div>
            </div>
            <Modal v-if="showConfirm" :message="confirmMessage" @confirm="confirmAction" @close="showConfirm = false" />
        </div>
    




        
    </AppLayout>

</template>



