<script>
export default {
    name:'CareerForm'
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
        <template #title>{{  updating? "Editar Carrera": "Nueva Carrera"}} </template>
        <template #description> {{ updating? "Edite los datos que desee de la carrera.":"Complete los datos de la carrera que quiere cargar." }}</template>
        <template #form>
             <div class="col-span-6 sm:col-span-6">
                <InputLabel for="name" value="Nombre"></InputLabel>
                <TextInput id="name" v-model="form.name" type="text" autocomplete="nombre" required class="mt-1 block w-full"></TextInput>

                <InputLabel for="duration" value="Duracion"></InputLabel>
                <TextInput id="duration" v-model="form.duration" type="number" autocomplete="duracion" required class="mt-1 block w-full"></TextInput>
         
                <InputError :message="$page.props.errors.name" class="mt-2"></InputError>
                <InputError :message="$page.props.errors.duration"  class="mt-2"></InputError>

             </div>

        </template>
        <template #actions>
            <PrimaryButton>
                {{ updating? 'Actualizar': 'Crear'}}
            </PrimaryButton>

        </template>
    </FormSection>
     
</template>