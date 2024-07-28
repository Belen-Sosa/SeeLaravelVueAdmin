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
            <h1 class="title" v-if="$page.props.user.permissions.includes('create career')">
                Agregar nueva carrera 
            </h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="content-data">
                        <!-- haacemos un emit a traves del submit (@ es el atajo para el v-on dentro de vue)para llamar a la ruta de store(ruta de guardado) -->
                        <CareerForm :form="form" @submit="form.post(route('careers.store'))"></CareerForm>

                    </div>

                </div>

            </div>

        </div>
    </AppLayout>

</template>