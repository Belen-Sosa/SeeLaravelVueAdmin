<script>
export default {
    name:'StudentEdit'
}
</script>


<script setup>
//importamos el componente form de inertia que nos permite pintar un formulario 
import {useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import StudentForm from '@/Components/Students/Form.vue'


const props= defineProps({
    student:{
        type: Object,
        required:true
    },
    careers:{
        type: Object,
        required:true
    },

  registrations:{
        type: Array,
        required:false
    },
    subjects:{
        type: Object,
        required:true
    },

})

const form = useForm({
    name:props.student.name,
    career_id:props.student.career_id,
    email:props.student.email,
    password: props.student.password,

    
})
   
</script>

<template>
<AppLayout >
   
        <template #header>
            <h1 class="title">Editar Estudiante</h1>
        </template>
        <div class="py-12">
            <div class="max-ww-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <StudentForm :updating="true" :careers="careers"  :form="form" :registrations="registrations"  @submit="form.put(route('students.update',student.id))"></StudentForm>

                    </div>

                </div>


            </div>

        </div>
  

</AppLayout>
</template>