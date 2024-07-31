<script>
export default {
    name: "StudentsIndex",
};
</script>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import {Inertia} from '@inertiajs/inertia'
import { ref } from 'vue';
import Modal from '@/Components/ModalAlert.vue';


defineProps({

    //aseguramos que recibimos el elemento que es un objeto y ponemos que es requerido para que todo funcione correctamente
    students:{
        type: Object,
        required: true
    } 
   
})

const showConfirm = ref(false);
  const confirmMessage = ref('');
  let student_id = null;
  
  const confirmDelete = (id) => {
    confirmMessage.value = '¿Desea eliminar esta carrera?';
    student_id = id;
    showConfirm.value = true;
  };
  
  const confirmAction = () => {
    Inertia.delete(route('students.destroy', student_id));
    showConfirm.value = false;
  };
</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1 class="title">
                Estudiantes
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="content-data">
                    <div class="flex justify-between" v-if="$page.props.user.permissions.includes('create student')">
                      
                        <Link :href="route('students.create')" class="button-add">
                            Agregar Estudiante
                        </Link>
                    </div>

                    <div class="mt-4">
                        <table
                        class="divide-y divide-gray-300 min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead
                        class="border-b border-neutral-200 font-medium dark:border-white/10">
                        <tr>
                            <th scope="col" class="px-6 py-4">Nombre</th>
                            <th scope="col" class="px-6 py-4">Carrera</th>
                            <th scope="col" class="px-6 py-4">Correo Electronico</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-neutral-200 dark:border-white/10"  v-for="student in students.data">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">  {{student.name}}</td>
                            <td class="whitespace-nowrap px-6 py-4">  {{student.career.name}}</td>
                            <td class="whitespace-nowrap px-6 py-4"> {{student.email}}</td>
                            <td>  <Link  class="py-2 px-4 border rounded shadow-inner bg-gray-200 hover:bg-gray-300" :href="route('students.editSubjects',student.id)"  v-if="$page.props.user.permissions.includes('update student')" >Inscibir en Materias </Link></td>
                            <td>  <Link class="button-edit" :href="route('students.edit',student.id)"  v-if="$page.props.user.permissions.includes('update student')" ><v-icon name="bi-pencil-fill" class="drop-shadow-md" /> </Link></td>
                        <td> <button class="button-delete" @click="confirmDelete(student.id)"  v-if="$page.props.user.permissions.includes('delete student')">  <v-icon name="bi-trash3-fill" class="drop-shadow-md" /></button></td>
                        </tr>
                        
                        </tbody>
                    </table>
                      
                    </div>
                   
                    <div class="flex justify-between mt-2">
                        <Link v-if="students.current_page>1" :href="students.prev_page_url" class=" py-2 px-4 rounded">
                          ANTERIOR
                        </Link>
                        <div v-else></div>
                        <Link v-if="students.current_page< students.last_page" :href="students.next_page_url" class=" py-2 px-4 rounded">
                          SIGUIENTE
                        </Link>
                        <div v-else></div>
                    </div>

                </div>
            </div>
            <Modal v-if="showConfirm" :message="confirmMessage" @confirm="confirmAction" @close="showConfirm = false" />
        </div>
    </AppLayout>
</template>
