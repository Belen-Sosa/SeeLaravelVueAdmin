<script>
export default {
    name:'CareerEdit'
}
</script>


<script setup>
//importamos el componente form de inertia que nos permite pintar un formulario 
import {useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import CareerForm from '@/Components/Careers/Form.vue'

const props= defineProps({
    career:{
        type: Object,
        required:true
    }
})

const form = useForm({
    name:props.career.name,
    duration:props.career.duration
})
   
</script>

<template>
<AppLayout title="Editar Carrera">
   
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Editar Carrera</h1>
        </template>
        <div class="py-12">
            <div class="max-ww-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <CareerForm :updating="true" :form="form" @submit="form.put(route('careers.update',career.id))"></CareerForm>

                    </div>

                </div>


            </div>

        </div>
  

</AppLayout>
</template>