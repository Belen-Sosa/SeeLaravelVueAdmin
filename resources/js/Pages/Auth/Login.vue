<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <!-- Contenedor para la imagen de fondo con sombreado -->
    <div  class="relative flex flex-col min-h-screen bg-cover bg-center ">
        <div class="absolute inset-0 bg-black bg-opacity-50   "></div> <!-- Sombreado de la imagen de fondo -->

        <AuthenticationCard class="relative flex flex-col min-h-screen bg-transparent ">
            

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
                
            </div>

            <form  @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email"  class=" text-white" />
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

                <div class="mt-4">
                    <InputLabel for="password" value="Password"  class=" text-white"/>
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" name="remember" />
                        <span class="ms-2 text-sm text-gray-400">Remember me</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                 

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Log in
                    </PrimaryButton>
                </div>
            </form>
        </AuthenticationCard>
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

.bg-transparent {
    background-color: transparent;
}
/* Fondo del formulario */
.bg-form-background {
    background-color: rgba(0, 0, 0, 0.5); /* Fondo con opacidad */
    padding: 1rem; /* Espaciado opcional alrededor del formulario */
    border-radius: 0.5rem; /* Bordes redondeados opcional */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Sombra opcional */
}
</style>
