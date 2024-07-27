<script>
export default {
    name: "TeacherIndex",
};
</script>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import {Inertia} from '@inertiajs/inertia'

defineProps({

    //aseguramos que recibimos el elemento que es un objeto y ponemos que es requerido para que todo funcione correctamente
    teachers:{
        type: Object,
        required: true
    } 
})
//utilizamos el confirm de js para asegurarnos de la accion y si es asi inertia hace una solicitud de delete
const deleteTeacher= id =>{
    if(confirm('¿Desea eliminar el registro de este profesor?')){
        Inertia.delete(route('teachers.destroy',id))
    }
}
</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1 class="font-semibold text-3xl drop-shadow-md  text-white leading-tight">
                Profesores
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="content-data">
                    <div class="flex justify-between" v-if="$page.props.user.permissions.includes('create teacher')">
                        <Link :href="route('teachers.create')" class="button-add">
                            Registrar Profesor
                        </Link>
                    </div>

                    <div class="mt-4">
                        <table
            class="divide-y divide-gray-300 min-w-full text-left text-sm font-light text-surface ">
            <thead
              class="border-b border-neutral-200 font-medium dark:border-white/10">
              <tr>
                <th scope="col" class="px-6 py-4">Nombre</th>
                <th scope="col" class="px-6 py-4">N° Legajo</th>
                <th scope="col" class="px-6 py-4">Correo</th>
                <th scope="col" class="px-6 py-4">Celular</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b border-neutral-200 dark:border-white/10"  v-for="teacher in teachers.data">
                <td class="whitespace-nowrap px-6 py-4 font-medium">  {{teacher.name}}</td>
                <td class="whitespace-nowrap px-6 py-4">  {{teacher.file}}</td>
                <td class="whitespace-nowrap px-6 py-4">  {{teacher.mail}}</td>
                <td class="whitespace-nowrap px-6 py-4"> {{teacher.phone}}</td>
                <td>  <Link class="button-edit" :href="route('teachers.edit',teacher.id)"  v-if="$page.props.user.permissions.includes('update teacher')" > <v-icon name="bi-pencil-fill" class="drop-shadow-md" /> </Link></td>
               <td> <Link class="button-delete" @click="deleteTeacher(teacher.id)"  v-if="$page.props.user.permissions.includes('delete teacher')"> <v-icon name="bi-trash3-fill" class="drop-shadow-md" /></Link></td>
            </tr>
             
            </tbody>
          </table>
                      
                    </div>
                    <div class="flex justify-between mt-2">
                        <Link v-if="teachers.current_page>1" :href="teachers.prev_page_url" class=" py-2 px-4 rounded">
                          ANTERIOR
                        </Link>
                        <div v-else></div>
                        <Link v-if="teachers.current_page< teachers.last_page" :href="teachers.next_page_url" class=" py-2 px-4 rounded">
                          SIGUIENTE
                        </Link>
                        <div v-else></div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
