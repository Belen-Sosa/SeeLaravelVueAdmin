<script>
export default {
    name: "SurveysShow",
};
</script>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import {Inertia} from '@inertiajs/inertia'
// Use reactive for reactive variables
import { reactive } from 'vue';



defineProps({

    //aseguramos que recibimos el elemento que es un objeto y ponemos que es requerido para que todo funcione correctamente
    survey:{
        type: Object,
        required: true
    } ,
    preview:{
      type:Boolean,
      required:true 
    }
   
})






</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1 class="font-semibold  text-xl text-gray-800 leading-tight">
                {{survey.title.toUpperCase()}}
            </h1>
            <p class="mt-2">
              Por favor responda el siguiente cuestionario sobre la materia de {{ survey.subject.name }} perteneciente a {{ survey.subject.year }} año de la carrera {{ survey.career.name }}
            </p>

            <form>
  <div class="space-y-12"   v-for="question in survey.questions">
   
    <div v-if="question.type_question_id==1" class="border-b border-gray-900/10 pb-12">
   
    

      <div class="mt-4 space-y-10">
        <fieldset >
          <legend class="text-sm font-semibold leading-6 text-gray-900">{{question.title}}</legend> 
          <p class="mt-1 text-sm leading-6 text-gray-600">Por favor, seleccione solo una opcion.</p>
         
          <div class="mt-6 space-y-6"> 
           
               <div  v-for="option in question.options"class="flex items-center gap-x-3">
               <input id={{option.id}} name={{option.value}} type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"> 
               <label for="push-nothing" class="block text-sm font-medium leading-6 text-gray-900">{{option.value}}</label>
               </div> 
            
            </div>
         </fieldset>
      
      </div>
    </div>



 

    <div v-if="question.type_question_id==2" class="border-b border-gray-900/10 pb-12">
    
      <div class="mt-4 space-y-10">
      
        <fieldset>
          <legend class="text-sm font-semibold leading-6 text-gray-900">{{question.title}}</legend> 
          <p class="mt-1 text-sm leading-6 text-gray-600">Por favor, seleccione solo una opcion.</p>
        
         
      
          <div  class="mt-3 space-y-3">


            <div v-for="option in question.options" class="relative flex gap-x-3">
              <div class="flex h-6 items-center">
                <input id="comments"  type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
              </div>
              <div class="text-sm leading-6">
                <label for="comments" class="font-medium text-gray-900">{{option.value}}</label>
               
              </div>
            </div>
           
            
          </div>
        </fieldset>
      </div>
      
      
    </div>





    


    <div v-if="question.type_question_id==3" class="border-b border-gray-900/10 pb-12">
      
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        

        <div class="col-span-full">
          <label for="about" class="text-sm font-semibold leading-6 text-gray-900">{{question.title}}</label>
          <p class="mt-1 text-sm leading-6 text-gray-600">Por favor, escriba su respuesta.</p>
          <div class="mt-2">
            <textarea id="about" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
          </div>
      
        </div>

       

      </div>
    </div>
  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Volver</button>
   <div >  <button type="submit" v-if="$page.props.user.permissions.includes('create survey')"  class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button></div>
  </div>
</form>
        </template>
           
    </AppLayout>
</template>
























