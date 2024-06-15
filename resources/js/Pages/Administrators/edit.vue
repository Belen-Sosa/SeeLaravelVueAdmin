<script>
export default {
    name:'AdministratorEdit'
}
</script>


<script setup>
//importamos el componente form de inertia que nos permite pintar un formulario 
import {useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import AdministratorForm from '@/Components/Administrators/Form.vue'

const props= defineProps({
    admin:{
        type: Object,
        required:true
    },
    careers:{
        type: Object,
        required:true
    },
  

})

const form = useForm({
    name:props.admin.name,
    career_id:props.admin.career_id,
    email:props.admin.email,
    password: props.admin.password
    
})
   
</script>

<template>
<AppLayout >
   
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Editar Administrador</h1>
        </template>
        <div class="py-12">
            <div class="max-ww-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <AdministratorForm :updating="true" :careers="careers"  :form="form" @submit="form.put(route('administrators.update',admin.id))"></AdministratorForm>

                    </div>

                </div>


            </div>

        </div>
  

</AppLayout>
</template>