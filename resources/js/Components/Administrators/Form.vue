<script>
export default {
    name:'AdministratorForm'
}
</script>

<script setup>
import FormSection from '@/Components/FormSection.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'





defineProps({

    form:{
        type:Object,
        required:true
    },
    updating:{
        type:Boolean,
        required:false,
        default:false
    },
    careers:{
        type:Object,
        required: true
    }
   
})

defineEmits(['submit'])
 


</script>
<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>{{  updating? "Editar Administrador": "Crear Nuevo Administrador"}} </template>
        <template #description> {{ updating? "Editando el registro del administrador seleccionado":"Creando un nuevo registro de administrador" }}</template>
        <template #form>
             <div class="col-span-6 sm:col-span-6">
                <InputLabel for="name"  value="Nombre"></InputLabel>
                <TextInput id="name" v-model="form.name" type="text"  class="mt-1 block w-full"></TextInput>
                <InputError :message="$page.props.errors.name" class="mt-2"></InputError>

             

                 <InputLabel class="mt-2" for="career" value="Carrera"></InputLabel>
                 <select id="career_id" v-model="form.career_id" class="mt-1 block w-full">
                    <option  v-for="career in careers" :value="career.id">{{ career.name }}</option>
                 </select>
                 <InputError :message="$page.props.errors.career"  class="mt-2"/>
         
                 <InputLabel for="email" value="Correo"></InputLabel>
                <TextInput id="email" v-model="form.email" type="email"  class="mt-1 block w-full"></TextInput>
                <InputError  :message="$page.props.errors.email" class="mt-2"></InputError>

                <InputLabel  v-if="!updating" for="password" value="Contraseña"></InputLabel>
                <TextInput v-if="!updating" id="password" v-model="form.password" type="password"  class="mt-1 block w-full"></TextInput>
                <InputError  v-if="!updating" :message="$page.props.errors.password" class="mt-2"></InputError>

                


           
         
                
             </div>

        </template>
        <template #actions>
            <PrimaryButton>
                {{ updating? 'Actualizar': 'Crear'}}
            </PrimaryButton>

        </template>
    </FormSection>
     
</template>