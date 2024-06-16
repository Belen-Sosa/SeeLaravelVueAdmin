<script>
export default {
    name: "SurveysIndex",
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
    surveys:{
        type: Object,
        required: true
    } 
   
})


// Estado para controlar el dropdown activo
const state = reactive({
  activeDropdown: null
});



// Función para alternar la visibilidad del dropdown
const toggleDropdown = (surveyId) => {
  state.activeDropdown = state.activeDropdown === surveyId ? null : surveyId;
};
//utilizamos el confirm de js para asegurarnos de la accion y si es asi inertia hace una solicitud de delete
const deleteSurvey= id =>{
    if(confirm('¿Desea eliminar esta encuesta?')){
        Inertia.delete(route('surveys.destroy',id))
    }
}
// Utilizamos el confirm de JS para asegurarnos de la acción y si es así, Inertia hace una solicitud de PUT
const updateState = (id, newState) => {
    if (confirm('¿Desea modificar el estado de esta encuesta?')) {
        Inertia.put(route('surveys.updateState', id), { estate: newState });
    }
};
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
                            <td class="whitespace-nowrap px-6 py-4"> {{survey.estate?'publica':'oculta'}}</td>
                            <td class="whitespace-nowrap px-6 py-4"> {{survey.start_date}}</td>
                            <td class="whitespace-nowrap px-6 py-4"> {{survey.final_date}}</td>
                            <td>  <Link class="py-2 px-4" :href="route('surveys.edit',survey.id)"  v-if="$page.props.user.permissions.includes('update survey')" >Editar </Link></td>
                        <td> <Link class="py-2 px-4 text-red-600" @click="deleteSurvey(survey.id)"  v-if="$page.props.user.permissions.includes('delete survey')"> Borrar</Link></td>
                         
                        <!-- Comienza boton de opciones-->
                        <td>
                              <!-- Botón de Opciones (Dropdown) -->
                    <div class="relative inline-block text-left">
                      <button
                        type="button"
                        @click="toggleDropdown(survey.id)"
                        class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                        aria-expanded="true"
                        aria-haspopup="true"
                      >
                        Acciones
                        <svg
                          class="-mr-1 h-5 w-5 text-gray-400"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                          aria-hidden="true"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>

                      <!-- Menú desplegable -->
                      <div
                        v-if="state.activeDropdown === survey.id"
                        class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="menu-button"
                        tabindex="-1"
                      >
                        <div class="py-1" role="none">
                      
                          <a  :href="route('surveys.edit',survey.id)"  v-if="$page.props.user.permissions.includes('update survey')" class="block px-4 py-2 text-sm text-gray-700  hover:bg-gray-50 " role="menuitem" tabindex="-1">Modificar</a>
                          <a href="#" class="block px-4 py-2 text-sm text-gray-700  hover:bg-gray-50" role="menuitem" tabindex="-1">Agregar Preguntas</a>
                          <a href="#"  @click="deleteSurvey(survey.id)"  v-if="$page.props.user.permissions.includes('delete survey')" class="block px-4 py-2 text-sm text-gray-700  hover:bg-gray-50" role="menuitem" tabindex="-1">Borrar</a>
                          <a href="#" @click="() => updateState(survey.id, 1)" v-if="$page.props.user.permissions.includes('update survey')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" role="menuitem" tabindex="-1">Publicar</a>
                           <a href="#" @click="() => updateState(survey.id, 0)" v-if="$page.props.user.permissions.includes('update survey')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" role="menuitem" tabindex="-1">Finalizar</a>
                                                  
                          <a href="#" class="block px-4 py-2 text-sm text-gray-700  hover:bg-gray-50" role="menuitem" tabindex="-1">Vista Previa</a>
                          <a href="#" class="block px-4 py-2 text-sm text-gray-700  hover:bg-gray-50 " role="menuitem" tabindex="-1">Resultados</a>

                          
                        </div>
                      </div>
                    </div>
                        
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


















