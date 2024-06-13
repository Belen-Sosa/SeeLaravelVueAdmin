<script>
export default {
    name: "CareersCreate",
};
</script>

<script setup>
//importamos el componente form de inertia que nos permite pintar un formulario 
import {useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import CareerForm from '@/Components/Careers/Form.vue'

const form = useForm({
    name:'',
    duration: null,
   
})


  </script>

<template>
    <AppLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight" v-if="$page.props.user.permissions.includes('create career')">
                Agregar nueva carrera 
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 ">
                        <!-- haacemos un emit a traves del submit (@ es el atajo para el v-on dentro de vue)para llamar a la ruta de store(ruta de guardado) -->
                        <CareerForm :form="form" @submit="form.post(route('careers.store'))"></CareerForm>

                    </div>

                </div>

            </div>

        </div>
    </AppLayout>

</template>