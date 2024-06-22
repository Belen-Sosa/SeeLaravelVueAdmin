  
  <script  setup>
  import { ref } from 'vue'
  import { FwbButton, FwbModal } from 'flowbite-vue'

import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import Modal from "@/Components/Modal.vue"

import FormSection from '@/Components/FormSection.vue'
import SecondaryButton from '../SecondaryButton.vue'




  
const props=defineProps({
    form:{
        type:Object,
        required:true
    },
    updating:{
        type:Boolean,
        required:false,
        default:false
    },

    survey_id:{
        type:String,
        required:true,
   
    },
    type_questions:{
        type:Object,
        required: true
    }
})

defineEmits(['submit'])
const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};


const showModal = ref(false);


  </script>


<template>
   




    <button @click="openModal" class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded">Agregar Pregunta</button>

<Modal :show="showModal" @close="closeModal" maxWidth="2xl" closeable>
    <!-- Contenido del modal -->
    <div class="p-4">
      <FormSection @submitted="$emit('submit')">
        <template #title>{{  updating? "Editar Pregunta": "Crear Nueva Pregunta"}} </template>
        <template #description> {{ updating? "Editando el registro de la Pregunta seleccionada":"Creando un nuevo registro de Pregunta" }}</template>
        <template #form>
             <div class="col-span-6 sm:col-span-6">
                <InputLabel for="title" value="Titulo"></InputLabel>
                <TextInput id="title" v-model="form.title" type="text"  class="mt-1 block w-full"></TextInput>
                <InputError :message="$page.props.errors.title" class="mt-2"></InputError>

             

                 <InputLabel   v-if="!updating" class="mt-2" for="type_questions" value="Tipo de Pregunta"></InputLabel>
                 <select   v-if="!updating" id="type" v-model="form.type_question_id" class="mt-1 block w-full">
                    <option   v-if="!updating"  v-for="type in type_questions" :value="type.id">{{ type.name }}</option>
                 </select>
                 <InputError  v-if="!updating"  :message="$page.props.errors.career_id"  class="mt-2"/>
             </div>

        </template>
        <template #actions>
            <PrimaryButton>
                {{ updating? 'Actualizar': 'Crear'}}
            </PrimaryButton>




        </template>
    </FormSection>
  
    <SecondaryButton  @click="closeModal">
             cerrar
    </SecondaryButton>
        

    </div>
</Modal>
  </template>
