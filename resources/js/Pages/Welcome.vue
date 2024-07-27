<script setup>
import { Head, Link } from '@inertiajs/vue3';
import WelcomeIcons from './WelcomeIcons.vue';
import Footer from './Footer.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="SEE" />

    <div class="relative flex flex-col min-h-screen bg-center  selection:bg-red-500 selection:text-white"
         :style="{ backgroundImage: 'url(/imgs/imagenBanner1.jpg)', backgroundSize: 'cover', backgroundPosition: 'center' }">
         <div class="flex-grow text-center flex flex-col items-center justify-center z-10 space-y-4">
            <h1 class="text-4xl font-bold text-white">Sistema de Encuestas y Estadísticas</h1>
            <h3 class="text-2xl font-semibold text-white">Gestión administrativa</h3>
            <div class=" p-4">
                <WelcomeIcons />
            </div>
            
        </div>
        <footer class="w-full bg-footer py-4 "
        :style="{ backgroundColor: 'rgba(0, 0, 0, 0.6)' }">
            <Footer />
        </footer>

       
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm ">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white ">Iniciar Sesión</Link>
            </template>
        </div>
       
    </div>
</template>

<style scoped>
div.relative::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5); /* Cambia el valor de opacidad según sea necesario */
    z-index: 0; /* Asegúrate de que esta capa esté detrás del contenido */
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.bg-footer {
    background-color: #15191d;
}
footer {
    position: relative;
    bottom: 0;
    left: 0;
    right: 0;
}
</style>
