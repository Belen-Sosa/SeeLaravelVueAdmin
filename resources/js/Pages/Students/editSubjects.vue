<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { Inertia } from '@inertiajs/inertia'
import { addIcons } from "oh-vue-icons";
import { BiPlusSquareFill } from "oh-vue-icons/icons";
addIcons(BiPlusSquareFill);

const props = defineProps({
    student: {
        type: Object,
        required: true
    },
    career_subjects: {
        type: Object,
        required: true
    },
    registrations: {
        type: Array,
        required: true
    }
});

const deleteRegister = id => {
    if (confirm('¿Desea eliminar esta inscripción?')) {
        Inertia.delete(route('students.destroyRegister', id));
    }
}

const addSubject = (subjectId) => {
    const careerId = props.student.career.id;
    const studentId = props.student.id;

    if (studentId && careerId && subjectId) {
        console.log('Student ID:', studentId);
        console.log('Career ID:', careerId);
        console.log('Subject ID:', subjectId);
        Inertia.post(route('students.addSubjects', {
            id: studentId,
            career_id: careerId,
            subject_id: subjectId
        }));
    } else {
        console.error('Faltan parámetros para la ruta.');
    }
};
</script>

<template>
    <AppLayout>
        <template #header>
            <h1 class="title">Inscripción a Materias</h1>
            <div class="block justify-between" v-if="$page.props.user.permissions.includes('create student')">
                <h2 class="font-semibold leading-tight text-2xl drop-shadow-md text-gray-100">
                    Estudiante: {{ student.name }}
                </h2>
                <p class="leading-tight text-1xl drop-shadow-md text-gray-100">
                    Carrera: {{ student.career.name }}
                </p>
            </div>
        </template>
        <div class="py-9">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="content-data mb-5">
                    <div class="mt-4">
                        <h3 class="font-semibold leading-tight text-1xl drop-shadow-md">
                            Materias a las que ya se encuentra inscrito
                        </h3>
                        <table class="divide-y divide-gray-300 min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Nombre</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-neutral-200 dark:border-white/10" v-for="reg in props.registrations" :key="reg.id">
                                    <td class="whitespace-nowrap px-6 py-4">{{ reg.subject.name }}</td>
                                    <td>
                                        <Link class="py-2 px-6 text-red-600 hover:text-red-700" @click="deleteRegister(reg.id)" v-if="$page.props.user.permissions.includes('delete student')">
                                            <v-icon name="bi-trash3-fill" class="drop-shadow-md" />
                                        </Link>
                                    </td>
                                </tr>
                                <tr v-if="props.registrations.length === 0">
                                    <td colspan="2" class="whitespace-nowrap px-6 py-4 text-center text-gray-500">
                                        Aún no se ha inscrito a ninguna materia.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="content-data">
                    <div class="mt-4">
                        <h3 class="font-semibold leading-tight text-1xl drop-shadow-md">
                            Materias a las que se puede inscribir
                        </h3>
                        <table class="divide-y divide-gray-300 min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead class="border-b border-neutral-200 font-medium">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Nombre</th>
                                    <th class="px-6 py-4"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-neutral-200" v-for="subject in career_subjects" :key="subject.id">
                                    <td class="whitespace-nowrap px-6 py-4">{{ subject.name }}</td>
                                    <td>
                                        <Link class="py-2 px-8 text-green-600 hover:text-green-700" @click="addSubject(subject.id)" v-if="$page.props.user.permissions.includes('delete student')">
                                            <v-icon name="bi-plus-square-fill" class="drop-shadow-md"></v-icon>
                                        </Link>
                                    </td>
                                </tr>
                                <tr v-if="props.career_subjects.length === 0">
                                    <td colspan="2" class="whitespace-nowrap px-6 py-4 text-center text-gray-500">
                                        Aún no se han cargado las materias de esta carrera.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
