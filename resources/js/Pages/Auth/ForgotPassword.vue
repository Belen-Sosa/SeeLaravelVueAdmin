<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />
    <!-- Contenedor para la imagen de fondo con sombreado -->
    <div class="relative min-h-screen flex flex-col bg-cover bg-center">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div> <!-- Sombreado de la imagen de fondo -->

        <div class="relative z-10 flex items-center justify-center flex-grow">
            <AuthenticationCard class="bg-form-background">
                <div class="mb-4 text-sm text-gray-300">
                    ¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña que te permitirá elegir una nueva.
                </div>

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" class="text-white"/>
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                          Enviar
                        </PrimaryButton>
                    </div>
                </form>
            </AuthenticationCard>
        </div>
    </div>
</template>

<style scoped>
/* Ajustes para el contenedor de la imagen de fondo y sombreado */
.bg-cover {
    background-image: url('/imgs/imagenBanner1.jpg');
    background-size: cover;
    background-position: center;
}

.bg-black {
    background-color: black;
}

.bg-opacity-50 {
    background-color: rgba(0, 0, 0, 0.5);
}

.relative {
    position: relative;
}

.absolute {
    position: absolute;
}

.inset-0 {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

/* Fondo del formulario */
.bg-form-background {
    background-color: rgba(32, 6, 6, 0.013); /* Fondo con opacidad */
    padding: 2rem; /* Espaciado opcional alrededor del formulario */
    border-radius: 0.5rem; /* Bordes redondeados opcional */
   
    z-index: 10;
}
</style>
