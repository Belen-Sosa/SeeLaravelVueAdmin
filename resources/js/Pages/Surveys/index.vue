<script>
export default {
    name: "SurveysIndex",
};
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { Inertia } from '@inertiajs/inertia';
import { reactive, ref } from 'vue';
import Modal from "@/Components/ModalAlert.vue";


const props = defineProps({
    surveys: {
        type: Object,
        required: true
    },
    default: true,
    message: {
        type: String,
        required: false
    }
});

const state = reactive({
    activeDropdown: null
});

const toggleDropdown = (surveyId) => {
    state.activeDropdown = state.activeDropdown === surveyId ? null : surveyId;
};






const showConfirm = ref(false);
const confirmMessage = ref('');
let survey_id = null;
let newState= null;
const updateState = (id, newState) => {
    if (confirm('¿Desea modificar el estado de esta encuesta?')) {
        Inertia.put(route('surveys.updateState', id), { estate: newState });
    }
};

const confirmDelete = (id) => {
confirmMessage.value = '¿Desea eliminar esta encuesta?';

survey_id = id;

showConfirm.value = true;
};



const confirmAction = () => {
    console.log("id", survey_id)
Inertia.delete(route('surveys.destroy', survey_id));
showConfirm.value = false;
};

</script>

<template>
    <AppLayout>
        <template #header>
            <h1 class="title">
                Encuestas
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="content-data">
                    <div class="flex justify-between" v-if="$page.props.user.permissions.includes('create survey')">
                        <Link :href="route('surveys.create')" class="button-add">
                            Agregar Encuesta
                        </Link>
                    </div>
                    <div v-if="props.message" class="mt-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ props.message }}
                    </div>
                    <div class="mt-4 ">
                        <table class="divide-y divide-gray-300 min-w-full text-left text-sm font-light text-surface">
                            <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
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
                                <tr class="border-b border-neutral-200 dark:border-white/10" v-for="survey in surveys.data" :key="survey.id">
                                    <td class="whitespace-normal break-words px-6 py-4 font-medium">{{ survey.title }}</td>
                                    <td class="whitespace-normal break-words px-6 py-4">{{ survey.description }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ survey.estate ? 'publica' : 'oculta' }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ survey.start_date }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ survey.final_date }}</td>
                                    <td>
                                        <Link class="button-edit" :href="route('surveys.edit', survey.id)" v-if="$page.props.user.permissions.includes('update survey')">
                                            <v-icon name="bi-pencil-fill" class="drop-shadow-md" />
                                        </Link>
                                    </td>
                                    <td>
                                        <button class="button-delete" @click="confirmDelete(survey.id)" v-if="$page.props.user.permissions.includes('delete survey')">
                                            <v-icon name="bi-trash3-fill" class="drop-shadow-md" />
                                        </button>
                                    </td>
                                    <td>
                                        <div class="relative inline-block text-left">
                                            <button type="button" @click="toggleDropdown(survey.id)" class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" aria-expanded="true" aria-haspopup="true">
                                                Acciones
                                                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                            <div v-if="state.activeDropdown === survey.id" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                <div class="py-1">
                                         
                                                    <a :href="route('questions.show', survey.id)" v-if="$page.props.user.permissions.includes('create question')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Agregar Preguntas</a>
                                                    <a href="#" @click=" updateState(survey.id, 1)" v-if="$page.props.user.permissions.includes('update survey')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Publicar</a>
                                                    <a href="#" @click="updateState(survey.id, 0)" v-if="$page.props.user.permissions.includes('update survey')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Finalizar</a>
                                                    <a :href="route('surveys.show', survey.id)" v-if="$page.props.user.permissions.includes('create survey')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Vista Previa</a>
                                                    <a :href="route('result.show', survey.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Resultados</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  
                    <div class="flex justify-between mt-2">
                        <Link v-if="surveys.current_page > 1" :href="surveys.prev_page_url" class="py-2 px-4 rounded">ANTERIOR</Link>
                        <div v-else></div>
                        <Link v-if="surveys.current_page < surveys.last_page" :href="surveys.next_page_url" class="py-2 px-4 rounded">SIGUIENTE</Link>
                        <div v-else></div>
                    </div>
                </div>
            </div>
            <Modal v-if="showConfirm" :message="confirmMessage" @confirm="confirmAction" @close="showConfirm = false" />
       
            
        </div>
    </AppLayout>
</template>
<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.dropdown-container {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    right: 0;
    z-index: 10;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 0.25rem;
    overflow: visible; /* Asegura que el contenido no se recorte */
    max-height: none; /* Asegura que el menú se expanda según su contenido */
    width: 14rem; /* Ajusta el ancho del menú */
}

</style>
