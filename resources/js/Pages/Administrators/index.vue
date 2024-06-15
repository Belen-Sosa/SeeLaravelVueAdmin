<script>
export default {
    name: "AdministratorsIndex",
};
</script>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import {Inertia} from '@inertiajs/inertia'

defineProps({

    //aseguramos que recibimos el elemento que es un objeto y ponemos que es requerido para que todo funcione correctamente
    admins:{
        type: Object,
        required: true
    } 
   
})
//utilizamos el confirm de js para asegurarnos de la accion y si es asi inertia hace una solicitud de delete
const deleteAdmin= id =>{
    if(confirm('¿Desea eliminar este administrador?')){
        Inertia.delete(route('administrators.destroy',id))
    }
}
</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Administradores
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between" v-if="$page.props.user.permissions.includes('create admin')">
                      
                        <Link :href="route('administrators.create')" class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded">
                            Agregar Administrador
                        </Link>
                    </div>

                    <div class="mt-4">
                        <table
                        class="divide-y divide-gray-100 min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead
                        class="border-b border-neutral-200 font-medium dark:border-white/10">
                        <tr>
                            <th scope="col" class="px-6 py-4">Nombre</th>
                            <th scope="col" class="px-6 py-4">Carrera</th>
                            <th scope="col" class="px-6 py-4">Correo Electronico</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-neutral-200 dark:border-white/10"  v-for="admin in admins.data">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">  {{admin.name}}</td>
                            <td class="whitespace-nowrap px-6 py-4">  {{admin.career.name}}</td>
                            <td class="whitespace-nowrap px-6 py-4"> {{admin.id}}</td>
                            <td>  <Link class="py-2 px-4" :href="route('administrators.edit',admin.id)"  v-if="$page.props.user.permissions.includes('update admin')" >Editar </Link></td>
                        <td> <Link class="py-2 px-4 text-red-600" @click="deleteAdmin(admin.id)"  v-if="$page.props.user.permissions.includes('delete admin')"> Borrar</Link></td>
                        </tr>
                        
                        </tbody>
                    </table>
                      
                    </div>
                   
                    <div class="flex justify-between mt-2">
                        <Link v-if="admins.current_page>1" :href="admins.prev_page_url" class=" py-2 px-4 rounded">
                          ANTERIOR
                        </Link>
                        <div v-else></div>
                        <Link v-if="admins.current_page< admins.last_page" :href="admins.next_page_url" class=" py-2 px-4 rounded">
                          SIGUIENTE
                        </Link>
                        <div v-else></div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
