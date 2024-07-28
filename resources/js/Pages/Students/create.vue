<script>
export default {
    name: "StudentsCreate",
};
</script>

<script setup>
//importamos el componente form de inertia que nos permite pintar un formulario 
import {useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import StudentForm from '@/Components/Students/Form.vue'

defineProps({
    careers:{
        type: Object,
        required:true
    },
    subjects:{
        type: Object,
        required:true
    }
})

const form = useForm({
    name:'',
    career_id:'',
    email:'',
    password:'',
    subjects:[]
   
})
 

  </script>

<template>
    <AppLayout >
        <template #header>
            <h1 class="title" v-if="$page.props.user.permissions.includes('create student')">
                Agregar nuevo Alumno
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 ">
                        <!-- haacemos un emit a traves del submit (@ es el atajo para el v-on dentro de vue)para llamar a la ruta de store(ruta de guardado) -->
                        <StudentForm :form="form" :careers="careers" :subjects="subjects" @submit="form.post(route('students.store'))"></StudentForm>

                    </div>

                </div>

            </div>

        </div>
    </AppLayout>

</template>