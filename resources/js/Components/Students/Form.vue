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
                <select id="career_id" v-model="form.career_id" required @change="updateSubjects"  class="mt-1 block w-full">
                    <option v-for="career in careers" :value="career.id" :key="career.id">{{ career.name }}</option>
                </select>
                <InputError :message="$page.props.errors.career_id" class="mt-2"/>

               
              <div id="subjects" v-if="!updating" class="mt-1 block w-full">
                    <InputLabel class="mt-2" for="subjects" value="Materias" ></InputLabel>
                <div v-for="subject in filteredSubjects" :key="subject.id">
                    <input
                        type="checkbox"
                        :value="subject.id"
                        v-model="form.subjects"
                         @change="addSubject(subject.id)"
                    >
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
import { ref, computed, watch, onMounted } from 'vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    form: {
        type: Object,
        required: true,
    
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
    },
    registrations: {
        type: Array,
        required: true
    }
});

console.log(props.registrations)

const emit = defineEmits(['submit']);

const filteredSubjects = computed(() => {
    //si no hay una carrera seleccionada devuelve array vacio
    if (!props.form.career_id) return [];
    //si hay una carrera seleccionada devuelve la lista de las materias de esa carrera 
    const career = props.subjects.find(career => career.id === props.form.career_id);

    if (!career || !career.subjects) return [];
    return career.subjects;
});

function updateSubjects() {
    //si el formulario esta en modo edicion hace lo siguiente 
    if (props.updating) {

        //guarda las materias en las que el usuario ya se encuentra inscripto
        const registeredSubjects = props.registrations
            .filter(reg => reg.career_id === props.form.career_id)
            .map(reg => reg.subject_id);
        //guarda las materias que estan seleccionadas ahora  y si no hay anda devuelve un array vacio 
        const currentSubjects = props.form.subjects || [];

        //convina los 2 array sin duplicados
        const updatedSubjects = Array.from(new Set([...currentSubjects, ...registeredSubjects]));
        
        //lo guarda en form subjects 
        props.form.subjects = updatedSubjects;


        console.log("Materias actualizadas:",         props.form.subjects);
    } else {
        props.form.subjects = [];
    }
}

function addSubject(subjectId) {
    if (!props.form.subjects.includes(subjectId)) {
        props.form.subjects.push(subjectId);
        updateSubjects();
    }
}

onMounted(() => {
    if (props.updating) {
        updateSubjects();
    }
});

watch(() => props.form.career_id, updateSubjects);
</script>
