<template>
    <div class="modal-overlay" @click.self="close">
      <div class="modal">
        <h3 class="modal-title">{{ title }}</h3>
        <p class="modal-body">{{ message }}</p>
        <div class="modal-actions">
          <button @click="confirm" class="btn-confirm">Confirmar</button>
          <button @click="close" class="btn-cancel">Cancelar</button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineEmits, defineProps } from 'vue';
  
  const props = defineProps({
    title: {
      type: String,
      default: 'Confirmar'
    },
    message: {
      type: String,
      default: 'Estas seguro que desea eliminar el registro?'
    }
  });
  
  const emit = defineEmits(['confirm', 'close']);
  
  const confirm = () => {
    emit('confirm');
    emit('close');
  };
  
  const close = () => {
    emit('close');
  };
  </script>
  
  <style>
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal {
    background: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 400px;
    width: 100%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.8);
  }
  
  .modal-title {
    font-size: 1.5em;
    margin-bottom: 10px;
  }
  
  .modal-body {
    margin-bottom: 20px;
  }
  
  .modal-actions {
    display: flex;
    justify-content: flex-end;
  }
  
  .btn-confirm {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin-right: 10px;
  }
  
  .btn-cancel {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
  }
  </style>
  