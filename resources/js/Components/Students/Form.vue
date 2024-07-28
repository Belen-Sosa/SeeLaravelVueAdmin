<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>{{ updating ? "Editar Estudiante" : "Crear Nuevo Estudiante" }}</template>
        <template #description>{{ updating ? "Edite los datos que desee del estudiante seleccionado" : "Complete con los datos del estudiante que quiere cargar." }}</template>
        <template #form>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="name" value="Nombre"></InputLabel>
                <TextInput id="name" v-model="form.name" required type="text" class="mt-1 block w-full"></TextInput>
                <InputError :message="$page.props.errors.name" class="mt-2"></InputError>

                <InputLabel class="mt-2" for="career_id" value="Carrera"></InputLabel>
                <select id="career_id" v-model="form.career_id" required @change="updateSubjects" class="mt-1 block w-full">
                    <option v-for="career in careers" :value="career.id" :key="career.id">{{ career.name }}</option>
                </select>
                <InputError :message="$page.props.errors.career_id" class="mt-2"/>

                <InputLabel class="mt-2" for="subjects" value="Materias" ></InputLabel>
                <div id="subjects" class="mt-1 block w-full">
                    <div v-for="subject in filteredSubjects" :key="subject.id">
                        <input type="checkbox" :value="subject.id" v-model="form.subjects " required>
                        <label>{{ subject.name }}</label>
                    </div>
                </div>
                <InputError :message="$page.props.errors.subjects" class="mt-2"/>
                
                <InputLabel for="email" value="Correo" ></InputLabel>
                <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required></TextInput>
                <InputError :message="$page.props.errors.email" class="mt-2"></InputError>

                <InputLabel v-if="!updating" for="password" value="Contraseña"></InputLabel>
                <TextInput v-if="!updating" id="password" v-model="form.password" type="password" class="mt-1 block w-full" required></TextInput>
                <InputError v-if="!updating" :message="$page.props.errors.password" class="mt-2"></InputError>
            </div>
        </template>
        <template #actions>
            <PrimaryButton>{{ updating ? 'Actualizar' : 'Crear' }}</PrimaryButton>
        </template>
    </FormSection>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import FormError from '@/Components/FormError.vue';

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    updating: {
        type: Boolean,
        required: false,
        default: false
    },
    careers: {
        type: Array,
        required: true
    },
    subjects: {
        type: Array,
        required: true
    }
});

const emit = defineEmits(['submit']);
const filteredSubjects = computed(() => {
    if (!props.form.career_id) return []; // Return empty array if no career_id selected

    // Find the career object with the selected career_id
    const career = props.subjects.find(career => career.id === props.form.career_id);

    if (!career || !career.subjects) return []; // Return empty array if career or subjects not found

    console.log('Filtered subjects:', career.subjects); // Log filtered subjects for debugging
    return career.subjects;
});


function updateSubjects() {
    console.log('Selected career_id:', props.form.career_id); // Agregar este log para depuración
    props.form.subjects = [];
}

watch(() => props.form.career_id, updateSubjects);
</script>
