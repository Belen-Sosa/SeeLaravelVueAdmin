<script>
export default {
    name:'SubjectEdit'
}
</script>


<script setup>
//importamos el componente form de inertia que nos permite pintar un formulario 
import {useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import SubjectForm from '@/Components/Subjects/Form.vue'

const props= defineProps({
    subject:{
        type: Object,
        required:true
    },
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
    name:props.subject.name,
    year:props.subject.year,
    career_id:props.subject.career_id,
    teacher_id:props.subject.teacher_id
})
   
</script>

<template>
<AppLayout title="Editar Materia">
   
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Editar Materia</h1>
        </template>
        <div class="py-12">
            <div class="max-ww-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <SubjectForm :updating="true" :careers="careers" :teachers="teachers"  :form="form" @submit="form.put(route('subjects.update',subject.id))"></SubjectForm>

                    </div>

                </div>


            </div>

        </div>
  

</AppLayout>
</template>