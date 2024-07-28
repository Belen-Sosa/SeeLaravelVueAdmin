<script>
export default {
    name: "SubjectsCreate",
};
</script>

<script setup>
//importamos el componente form de inertia que nos permite pintar un formulario 
import {useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import SubjectForm from '@/Components/Subjects/Form.vue'

defineProps({
    careers:{
        type: Object,
        required:true
    },
    teachers:{
        type:Object,
        required:true
    }
})

const form = useForm({
    name:'',
    year:'',
    career_id:null,
    teacher_id:null,
   
})


  </script>

<template>
    <AppLayout >
        <template #header>
            <h1 class="title" v-if="$page.props.user.permissions.includes('create subject')">
                Agregar nueva materia
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 ">
                        <!-- haacemos un emit a traves del submit (@ es el atajo para el v-on dentro de vue)para llamar a la ruta de store(ruta de guardado) -->
                        <SubjectForm :form="form" :careers="careers" :teachers="teachers" @submit="form.post(route('subjects.store'))"></SubjectForm>

                    </div>

                </div>

            </div>

        </div>
    </AppLayout>

</template>