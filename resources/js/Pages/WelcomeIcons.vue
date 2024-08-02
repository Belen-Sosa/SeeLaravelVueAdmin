<script setup>
import { addIcons } from "oh-vue-icons";
import { HiTruck, IoAccessibility, LaDesktopSolid } from "oh-vue-icons/icons";
addIcons(HiTruck, IoAccessibility, LaDesktopSolid);
</script>

<template>
    <div class="flex space-x-4 items-center text-white">
        <div class="flex flex-col items-center space-y-2 p-2">
            <v-icon name="hi-truck" class="icon-color icon-shadow" />
            <span class="text-shadow">Rápido</span>
        </div>
        <div class="flex flex-col items-center space-y-2 p-2">
            <v-icon name="io-accessibility" class="icon-color icon-shadow" />
            <span class="text-shadow">Accesible</span>
        </div>
        <div class="flex flex-col items-center space-y-2 p-2">
            <v-icon name="la-desktop-solid" class="icon-color icon-shadow" />
            <span class="text-shadow">Adaptable</span>
        </div>
    </div>
</template>

<style scoped>
.icon-color {
    color: rgb(17, 151, 17);
}

.icon-shadow {
    filter: drop-shadow(
        0 4px 6px rgb(0, 0, 0)
    ); /* Ajusta el sombreado del ícono */
}

.text-shadow {
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.863); /* Ajusta el sombreado del texto */
}

.shadow-container {
    /* Sombra del contenedor si se desea */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Ajusta el sombreado del contenedor */
}

.flex-col {
    display: flex;
    flex-direction: column;
}

.space-y-2 {
    margin-top: 0.5rem; /* Ajusta el espacio entre íconos y texto */
}
</style>
