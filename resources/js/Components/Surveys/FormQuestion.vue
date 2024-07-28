  
  <script  setup>
  import { ref,defineEmits, watchEffect } from 'vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import Modal from "@/Components/Modal.vue"
import FormSection from '@/Components/FormSection.vue'
import SecondaryButton from '../SecondaryButton.vue'
import { useForm } from '@inertiajs/vue3'



  
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
    },
    title:{
        type:String,
        required:false,
   
    },

})
const cleanForm = () => {
    const formData = {
        title: "",
        type_question_id:"",
    };
    emit('cleanForm', formData);
   
    
};



const emit =  defineEmits(['submit'],['submitEdit'],['updatingForm'],['cleanForm'])



const openModal = () => {
    emit('updatingForm');
    showModal.value = true;
   
};

const closeModal = () => { 
    showModal.value = false;
   
    cleanForm();

  
};



const showModal = ref(false);

const handleSubmit = () => {
    const formData = {
        title: props.form.title,
       
    };
    if (props.updating) {
   
        emit('submitEdit', formData);
        closeModal();
    
    } else {
     
        emit('submit', formData);
        closeModal();
        
    }
};




  </script>


<template>
   




    <button  @click="openModal"><v-icon v-if="updating" name="bi-pencil-fill" class="drop-shadow-md" />
                                <p  v-if="!updating"> Agregar Pregunta</p>
    </button>

<Modal :show="showModal" @close="closeModal" maxWidth="2xl" closeable>
    <!-- Contenido del modal -->
    <div class="p-4">
      <FormSection @submitted="handleSubmit()">
        <template #title>{{  updating? "Editar Pregunta": "Crear Nueva Pregunta"}} </template>
        <template #description> {{ updating? "Edite la pregunta seleccionada":"Complete los datos para agregar la pregunta" }}</template>
        <template #form>
             <div class="col-span-6 sm:col-span-6">
                <InputLabel for="title" value="Titulo"></InputLabel>
                <TextInput id="title" v-model="form.title" type="text"  class="mt-1 block w-full" required></TextInput>
                <InputError :message="$page.props.errors.title" class="mt-2"></InputError>

             

                 <InputLabel   v-if="!updating" class="mt-2" for="type_questions" value="Tipo de Pregunta"></InputLabel>
                 <select   v-if="!updating" id="type" v-model="form.type_question_id" class="mt-1 block w-full" required>
                    <option   v-if="!updating"  v-for="type in type_questions" :value="type.id">{{ type.name }}</option>
                 </select>
                 <InputError  v-if="!updating"  :message="$page.props.errors.career_id"  class="mt-2"/>
             </div>

        </template>
        <template #actions>

          
            <PrimaryButton >
                {{ updating? 'Actualizar': 'Crear'}}
            </PrimaryButton>




        </template>
    </FormSection>
  
    
    <SecondaryButton @click="closeModal">
             cerrar
    </SecondaryButton>
        

    </div>
</Modal>
  </template>
