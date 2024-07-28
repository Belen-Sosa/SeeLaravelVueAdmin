<script>
export default {
    name: "QuestionsOptionsIndex",
};
</script>
<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import {Inertia} from '@inertiajs/inertia'
import { useForm } from '@inertiajs/vue3';
import FormOption from "@/Components/OptionsQuestions/FormOption.vue";



const props= defineProps({

    //aseguramos que recibimos el elemento que es un objeto y ponemos que es requerido para que todo funcione correctamente
    question:{
        type: Object,
        required: true
    } 
    

   
})

const form = useForm({
  
    question_id:props.question.id,
    value:"",

 
   
})
const updatingForm=option =>{
    form.value = option.value;
    

}
const cleanForm = option => {
    form.value = option.value;
  
};


//utilizamos el confirm de js para asegurarnos de la accion y si es asi inertia hace una solicitud de delete
const deleteOption= id =>{
    if(confirm('¿Desea eliminar esta opcion?')){
        Inertia.delete(route('options.destroy',id))
    }
}
const handleEdit = (option) => {
    form.put(route('options.update', option.id), {
        onSuccess: () => cleanForm()
    });
};

const handleSubmit = () => {
    form.post(route('options.store'), {
        onSuccess: () => cleanForm()
    });
};






</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1 class="title">
                Opciones
                
            </h1>

        </template>
      <div class="py-12">
 
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             
                <div class="content-data">
                  
                    <div class="flex justify-between" >
                          
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                      Opciones de la Pregunta :  {{question.title }}
                      </h1>
                     <div class="button-add"><FormOption  v-if="$page.props.user.permissions.includes('create option')"  
                      :form="form" 
                      @cleanForm="cleanForm($event)";
                      @submit="handleSubmit"
                       
                   
                      ></FormOption> </div> 
                   
                      
                    </div>

                    <div class="mt-4">
                        <table
                        class="divide-y divide-gray-100 min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead
                        class="border-b border-neutral-200 font-medium dark:border-white/10">
                        <tr>
                            <th scope="col" class="px-6 py-4">Valor</th>
                     
            
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-neutral-200 dark:border-white/10"  v-for="option in question.options">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">  {{option.value}}</td>
                         
                       
                      
                       
                            <td> <div class="button-edit">  <FormOption  v-if="$page.props.user.permissions.includes('update option')" 
                                 :updating="true" :form="form" :question_id="question.id" 
                                  @submitEdit="handleEdit(option,$event)" 
                                  @updatingForm="updatingForm(option)"
                                  @cleanForm="cleanForm($event)";
                                  ></FormOption>
                                </div>
                            </td>
                                
                             
                            <td> <Link class="button-delete" @click="deleteOption(option.id)"  v-if="$page.props.user.permissions.includes('delete option')"> <v-icon name="bi-trash3-fill" class="drop-shadow-md" /></Link></td>
                           
                    
                       </tr>


                        
                        
                        </tbody>
                    </table>
                      
                    </div>
                   
               

                </div>
            </div>
        </div>
    




        
    </AppLayout>

</template>



