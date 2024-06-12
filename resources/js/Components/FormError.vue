<template>
    <div v-if="message" class="mt-2 text-red-600">
      {{ message }}
    </div>
  </template>
  
  <script>
  export default {
    props: {
      errors: {
        type: Object,
        required: true,
      },
      fields: {
        type: Array,
        required: true,
      }
    },
    computed: {
      message() {
        for (const field of this.fields) {
          if (this.errors[field]) {
            return this.errors[field];
          }
        }
        return null;
      }
    }
  };
  </script>
