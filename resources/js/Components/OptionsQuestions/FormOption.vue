  
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

  
 
  
})
const cleanForm = () => {
    const formData = {
        value: "",
      
    };
    emit('cleanForm', formData);
   
    
};



const emit =  defineEmits(['submit'],['submitEdit'],['updatingForm'],['cleanForm'])



const openModal = () => {
    //para que me rellene los campos en el formulario de edicion con los datos que ya tiene el registro 
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
        value: props.form.value,
       
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
   




    <button @click="openModal">{{  updating? "Editar ": "Agregar Opcion"}} </button>

<Modal :show="showModal" @close="closeModal" maxWidth="2xl" closeable>
    <!-- Contenido del modal -->
    <div class="p-4">
      <FormSection @submitted="handleSubmit()">
        <template #title>{{  updating? "Editar Opcion": "Crear Nueva Opcion"}} </template>
        <template #description> {{ updating? "Editando el registro de la Opción seleccionada":"Creando un nuevo registro de Opción" }}</template>
        <template #form>
             <div class="col-span-6 sm:col-span-6">
                <InputLabel for="value" value="Valor"></InputLabel>
                <TextInput id="value" v-model="form.value" type="text"  class="mt-1 block w-full"></TextInput>
                <InputError :message="$page.props.errors.value" class="mt-2"></InputError>

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
