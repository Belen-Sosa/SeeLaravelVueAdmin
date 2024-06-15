<script>
export default {
    name: "SurveysIndex",
};
</script>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import {Inertia} from '@inertiajs/inertia'
// Initialization for ES Users


defineProps({

    //aseguramos que recibimos el elemento que es un objeto y ponemos que es requerido para que todo funcione correctamente
    surveys:{
        type: Object,
        required: true
    } 
   
})
//utilizamos el confirm de js para asegurarnos de la accion y si es asi inertia hace una solicitud de delete
const deleteSurvey= id =>{
    if(confirm('¿Desea eliminar esta encuesta?')){
        Inertia.delete(route('surveys.destroy',id))
    }
}
</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Encuestas
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between" v-if="$page.props.user.permissions.includes('create survey')">
                      
                        <Link :href="route('surveys.create')" class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded">
                            Agregar Encuesta
                        </Link>
                    </div>

                    <div class="mt-4">
                        <table
                        class="divide-y divide-gray-100 min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead
                        class="border-b border-neutral-200 font-medium dark:border-white/10">
                        <tr>
                            <th scope="col" class="px-6 py-4">Titulo</th>
                            <th scope="col" class="px-6 py-4">Descripcion</th>
                            <th scope="col" class="px-6 py-4">Estado</th>
                            <th scope="col" class="px-6 py-4">Fecha Inicio</th>
                            <th scope="col" class="px-6 py-4">Fecha Final</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-neutral-200 dark:border-white/10"  v-for="survey in surveys.data">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">  {{survey.title}}</td>
                            <td class="whitespace-nowrap px-6 py-4">  {{survey.description}}</td>
                            <td class="whitespace-nowrap px-6 py-4"> {{survey.estate}}</td>
                            <td class="whitespace-nowrap px-6 py-4"> {{survey.start_date}}</td>
                            <td class="whitespace-nowrap px-6 py-4"> {{survey.final_date}}</td>
                            <td>  <Link class="py-2 px-4" :href="route('administrators.edit',survey.id)"  v-if="$page.props.user.permissions.includes('update survey')" >Editar </Link></td>
                        <td> <Link class="py-2 px-4 text-red-600" @click="deleteSurvey(survey.id)"  v-if="$page.props.user.permissions.includes('delete survey')"> Borrar</Link></td>
                         
                        <!-- Comienza boton de opciones-->
                        <td>
  
                        </td>

                      <!-- termina boton de opciones-->
                    
                       </tr>


                        
                        
                        </tbody>
                    </table>
                      
                    </div>
                   
                    <div class="flex justify-between mt-2">
                        <Link v-if="surveys.current_page>1" :href="surveys.prev_page_url" class=" py-2 px-4 rounded">
                          ANTERIOR
                        </Link>
                        <div v-else></div>
                        <Link v-if="surveys.current_page< surveys.last_page" :href="surveys.next_page_url" class=" py-2 px-4 rounded">
                          SIGUIENTE
                        </Link>
                        <div v-else></div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
