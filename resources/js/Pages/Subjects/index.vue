<script>
export default {
    name: "SubjectsIndex",
};
</script>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { Inertia } from '@inertiajs/inertia'
import Modal from "@/Components/ModalAlert.vue";
import { ref } from "vue";


defineProps({

    //aseguramos que recibimos el elemento que es un objeto y ponemos que es requerido para que todo funcione correctamente
    subjects: {
        type: Array,
        required: true
    }

})
const showConfirm = ref(false);
const confirmMessage = ref('');
let subject_id = null;

const confirmDelete = (id) => {
    confirmMessage.value = '¿Desea eliminar esta carrera?';
    subject_id = id;
    showConfirm.value = true;
};

const confirmAction = () => {
    Inertia.delete(route('subjects.destroy', subject_id));
    showConfirm.value = false;
};
</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1 class="title">
                Materias
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="content-data">
                    <div class="flex justify-between" v-if="$page.props.user.permissions.includes('create subject')">
                        <Link :href="route('subjects.create')" class="button-add">
                        Agregar Materia
                        </Link>
                    </div>

                    <div class="mt-4">
                        <table class="divide-y divide-gray-300 min-w-full text-left text-sm font-light text-surface">
                            <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Nombre</th>
                                    <th scope="col" class="px-6 py-4">Año</th>
                                    <th scope="col" class="px-6 py-4">Carrera</th>
                                    <th scope="col" class="px-6 py-4">Profesor</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-neutral-200 dark:border-white/10"
                                    v-for="subject in subjects.data">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium"> {{ subject.name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4"> {{ subject.year }}</td>
                                    <td class="whitespace-nowrap px-6 py-4"> {{ subject.career.name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4"> {{ subject.teacher.name }}</td>
                                    <td>
                                        <Link class="button-edit" :href="route('subjects.edit', subject.id)"
                                            v-if="$page.props.user.permissions.includes('update subject')"><v-icon
                                            name="bi-pencil-fill" class="drop-shadow-md" /> </Link>
                                    </td>
                                    <td>
                                        <button class="button-delete"@click="confirmDelete(subject.id)"
                                            v-if="$page.props.user.permissions.includes('delete subject')"> <v-icon
                                            name="bi-trash3-fill" class="drop-shadow-md" /></button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <div class="flex justify-between mt-2">
                        <Link v-if="subjects.current_page > 1" :href="subjects.prev_page_url" class=" py-2 px-4 rounded">
                        ANTERIOR
                        </Link>
                        <div v-else></div>
                        <Link v-if="subjects.current_page < subjects.last_page" :href="subjects.next_page_url"
                            class=" py-2 px-4 rounded">
                        SIGUIENTE
                        </Link>
                        <div v-else></div>
                    </div>

                </div>
            </div>
        </div>
        <Modal v-if="showConfirm" :message="confirmMessage" @confirm="confirmAction" @close="showConfirm = false" />
    </AppLayout>
</template>
