<script>
export default {
    name: 'SurveyForm'
}
</script>

<script setup>
import FormSection from '@/Components/FormSection.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import FormError from '@/Components/FormError.vue'
import { computed, watch, defineProps, defineEmits } from 'vue';

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

<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>{{ updating ? "Editar Encuesta" : "Crear Nueva Encuesta" }}</template>
        <template #description>{{ updating ? "Editando el registro de la Encuesta seleccionada" : "Creando un nuevo registro de Encuesta" }}</template>
        <template #form>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="title" value="Titulo"></InputLabel>
                <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full"></TextInput>
                <InputError :message="$page.props.errors.title" class="mt-2"></InputError>

                <InputLabel v-if="!updating" class="mt-2" for="career_id" value="Carrera"></InputLabel>
                <select v-if="!updating" id="career_id" v-model="form.career_id" @change="updateSubjects" class="mt-1 block w-full">
                    <option v-for="career in careers" :key="career.id" :value="career.id">{{ career.name }}</option>
                </select>
                <InputError v-if="!updating" :message="$page.props.errors.career_id" class="mt-2"></InputError>

                <InputLabel v-if="!updating" class="mt-2" for="subject_id" value="Materia"></InputLabel>
                <select v-if="!updating" id="subject_id" v-model="form.subject_id" class="mt-1 block w-full">
                    <option v-for="subject in filteredSubjects" :key="subject.id" :value="subject.id">{{ subject.name }}</option>
                </select>
                <InputError v-if="!updating" :message="$page.props.errors.subject_id" class="mt-2"></InputError>

                <InputLabel for="description" value="Descripcion"></InputLabel>
                <TextInput id="description" v-model="form.description" type="text" class="mt-1 block w-full"></TextInput>
                <InputError :message="$page.props.errors.description" class="mt-2"></InputError>

                <InputLabel for="final_date" value="Fecha de cierre"></InputLabel>
                <TextInput id="final_date" v-model="form.final_date" type="datetime-local" class="mt-1 block w-full"></TextInput>
                <InputError :message="$page.props.errors.final_date" class="mt-2"></InputError>
            </div>
        </template>
        <template #actions>
            <PrimaryButton>
                {{ updating ? 'Actualizar' : 'Crear' }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
