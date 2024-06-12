<script>
export default {
    name: 'StudentsIndex' 
}

</script>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

</script>
<template>
    <AppLayout>
        <!--definir el template para el slot del header -->
        <template #header>
            <h1>Estudiantes</h1>

        </template>
         
    </AppLayout>

</template>

