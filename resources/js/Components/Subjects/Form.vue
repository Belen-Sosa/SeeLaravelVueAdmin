<script>
export default {
    name:'SubjectForm'
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
    },
    careers:{
        type:Object,
        required: true
    },
    teachers:{
        type:Object,
        required:true
    }
})

defineEmits(['submit'])
 


</script>
<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>{{  updating? "Editar Materia": "Crear nueva Materia"}} </template>
        <template #description> {{ updating? "Editando la materia seleccionada":"Creando una nueva materia" }}</template>
        <template #form>
             <div class="col-span-6 sm:col-span-6">
                <InputLabel for="name" value="Nombre"></InputLabel>
                <TextInput id="name" v-model="form.name" type="text" autocomplete="nombre" class="mt-1 block w-full"></TextInput>
                <InputError :message="$page.props.errors.name" class="mt-2"></InputError>

                <InputLabel  class="mt-2" for="year" value="Año"></InputLabel>
                <TextInput id="year" v-model="form.year" type="number"  class="mt-1 block w-full"></TextInput>
                 <InputError :message="$page.props.errors.year"  class="mt-2"></InputError>
         




                 <InputLabel class="mt-2" for="career" value="Carrera"></InputLabel>
                 <select id="career_id" v-model="form.career_id" class="mt-1 block w-full">
                    <option  v-for="career in careers" :value="career.id">{{ career.name }}</option>
                 </select>
                 <InputError :message="$page.props.errors.career"  class="mt-2"/>
         
                

                 
                 <InputLabel  class="mt-2" for="teacher" value="Profesor"></InputLabel>
                 <select id="teacher_id" v-model="form.teacher_id" class="mt-1 block w-full">
                    <option  v-for="teacher in teachers" :value="teacher.id">{{ teacher.name }}</option>
                 </select>
                 <InputError :message="$page.props.errors.teacher"  class="mt-2"/>
         
                
             </div>

        </template>
        <template #actions>
            <PrimaryButton>
                {{ updating? 'Actualizar': 'Crear'}}
            </PrimaryButton>

        </template>
    </FormSection>
     
</template>