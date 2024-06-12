<script>
export default {
    name:'TeacherForm'
}
</script>

<script setup>
import FormSection from '@/Components/FormSection.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import FormError from '@/Components/FormError.vue'

defineProps({
    form:{
        type:Object,
        required:true
    },
    updating:{
        type:Boolean,
        required:false,
        default:false
    }
})

defineEmits(['submit'])
 


</script>
<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>{{  updating? "Editar Profesor": "Agregar nuevo Profesor "}} </template>
        <template #description> {{ updating? "Editando el profesor seleccionado":"Creando un nuevo registro de Profesor" }}</template>
        <template #form>
             <div class="col-span-6 sm:col-span-6">
                <InputLabel for="name" value="Nombre"></InputLabel>
                <TextInput id="name" v-model="form.name" type="text"  class="mt-1 block w-full"></TextInput>

                <InputLabel for="file" value="N° Legajo"></InputLabel>
                <TextInput id="file" v-model="form.file" type="number"  class="mt-1 block w-full"></TextInput>

                <InputLabel for="mail" value="Correo"></InputLabel>
                <TextInput id="mail" v-model="form.mail" type="email"  class="mt-1 block w-full"></TextInput>

                <InputLabel for="phone" value="Telefono"></InputLabel>
                <TextInput id="phone" v-model="form.phone" type="number"  class="mt-1 block w-full"></TextInput>

         
                <InputError :message="$page.props.errors.name" class="mt-2"></InputError>
                <InputError :message="$page.props.errors.file"  class="mt-2"></InputError>
                <InputError :message="$page.props.errors.mail" class="mt-2"></InputError>
                <InputError :message="$page.props.errors.phone"  class="mt-2"></InputError>

             </div>

        </template>
        <template #actions>
            <PrimaryButton>
                {{ updating? 'Actualizar': 'Crear'}}
            </PrimaryButton>

        </template>
    </FormSection>
     
</template>