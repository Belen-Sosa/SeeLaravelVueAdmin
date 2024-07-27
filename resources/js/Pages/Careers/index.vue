<script>
export default {
    name: "CareersIndex",
};
</script>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import {Inertia} from '@inertiajs/inertia'

defineProps({

    //aseguramos que recibimos el elemento que es un objeto y ponemos que es requerido para que todo funcione correctamente
    careers:{
        type: Object,
        required: true
    } 
})
//utilizamos el confirm de js para asegurarnos de la accion y si es asi inertia hace una solicitud de delete
const deleteCareer= id =>{
    if(confirm('¿Desea eliminar esta carrera?')){
        Inertia.delete(route('careers.destroy',id))
    }
}
</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1 class="title">
                Carreras
            </h1>
        </template>
        <div class="py-12  ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
                <div class="content-data">
                    <div class="flex justify-between" v-if="$page.props.user.permissions.includes('create career')">
                        <Link :href="route('careers.create')" class="button-add">
                            Agregar Carrera
                        </Link>
                    </div>

                    <div class="mt-4 ">
                        <ul role="list"  class="divide-y  divide-gray-300">
                            <!-- recorremos la lista de carreras para mostrarlas a traves de un v-for (recorremos careers.data porque los datos estan paginados.)-->
                            <li class="flex justify-between gap-x-6 py-5"  v-for="career in careers.data ">
                                <div class="flex min-w-0 gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p
                                            class="text-md font-semibold leading-6 text-gray-900"
                                        >
                                            {{career.name}}
                                        </p>
                                        <p
                                            class="mt-1 truncate text-xs leading-5 text-gray-500"
                                        >
                                        {{career.duration}} años
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="hidden shrink-0 sm:flex sm:flex-col sm:items-end"
                                >
                                    <p class="text-md leading-6 text-gray-900">
                                        <Link class="button-edit" :href="route('careers.edit',career.id)"  v-if="$page.props.user.permissions.includes('update career')" > <v-icon name="bi-pencil-fill" class="drop-shadow-md" /> </Link>
                                        <Link class="button-delete" @click="deleteCareer(career.id)"  v-if="$page.props.user.permissions.includes('delete career')">  <v-icon name="bi-trash3-fill" class="drop-shadow-md" /></Link>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="flex justify-between mt-2 ">
                        <Link v-if="careers.current_page>1" :href="careers.prev_page_url" class=" py-2 px-4 rounded">
                          ANTERIOR
                        </Link>
                        <div v-else></div>
                        <Link v-if="careers.current_page< careers.last_page" :href="careers.next_page_url" class=" py-2 px-4 rounded">
                          SIGUIENTE
                        </Link>
                        <div v-else></div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
