<template>
  <form @submit.prevent="submit" class="space-y-6">
    <div>
      <label class="block font-semibold mb-1">Titre</label>
      <input v-model="form.title" type="text" class="input" />
    </div>

    <div>
      <label class="block font-semibold mb-1">Sous-titre</label>
      <input v-model="form.subtitle" type="text" class="input" />
    </div>

    <div>
      <label class="block font-semibold mb-2">Étapes</label>
      <div v-for="(step, index) in form.steps" :key="index" class="border p-4 rounded mb-4">
        <label>Icône</label>
        <input v-model="step.icon" type="text" class="input" />

        <label>Titre</label>
        <input v-model="step.title" type="text" class="input" />

        <label>Description</label>
        <textarea v-model="step.description" class="input" rows="3" />
      </div>
    </div>

    <button type="submit" class="btn-primary">Enregistrer</button>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  initialData: Object,
})
// Initialize form with initial data or default values
// If initialData is not provided, use empty strings or default values  
const data = props.initialData?.content || {}

const form = useForm({
  title: data.title || '',
  subtitle: data.subtitle || '',
  steps: data.steps || [
    { icon: '', title: '', description: '' },
    { icon: '', title: '', description: '' },
    { icon: '', title: '', description: '' },
  ],
})

function submit() {
  form.submit('post', `/home/sections/${props.initialData.section_key}`)
}
</script>

<style scoped>
.input {
  width: 100%;
  border: 1px solid #ccc;
  padding: 0.5rem;
  margin-top: 0.25rem;
  margin-bottom: 0.75rem;
  border-radius: 0.25rem;
}
.btn-primary {
  background-color: #2563eb;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
}
</style>
