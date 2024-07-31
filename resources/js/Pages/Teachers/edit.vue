<script>
export default {
    name:'TeacherEdit'
}
</script>


<script setup>
//importamos el componente form de inertia que nos permite pintar un formulario 
import {useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import TeacherForm from '@/Components/Teachers/Form.vue'

const props= defineProps({
    teacher:{
        type: Object,
        required:true
    }
})

const form = useForm({
    name:props.teacher.name,
    file:props.teacher.file,
    mail: props.teacher.mail,
    phone: props.teacher.phone
})
   

</script>

<template>
<AppLayout title="Editar Profesor">
   
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Editar Profesor</h1>
        </template>
        <div class="py-12">
            <div class="max-ww-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <TeacherForm :updating="true" :form="form" @submit="form.put(route('teachers.update',teacher.id))"></TeacherForm>

                    </div>

                </div>


            </div>

        </div>
  

</AppLayout>
</template>