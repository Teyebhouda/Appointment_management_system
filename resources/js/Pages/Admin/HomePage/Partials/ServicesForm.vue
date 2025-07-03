<template>
  <form @submit.prevent="submit" class="space-y-6">
    <div>
      <label class="block font-semibold mb-1">Titre de la section</label>
      <input v-model="form.title" type="text" class="input" />
    </div>

    <div>
      <label class="block font-semibold mb-2">Services</label>
      <div v-for="(item, index) in form.items" :key="index" class="border p-4 rounded mb-4 relative">
        <button
          type="button"
          class="absolute top-2 right-2 text-red-600 font-bold"
          @click="removeItem(index)"
          aria-label="Supprimer ce service"
        >
          &times;
        </button>

        <label>Titre</label>
        <input v-model="item.title" type="text" class="input" />

        <label>Description</label>
        <textarea v-model="item.description" class="input" rows="3" />

        <label>Icône (nom ou classe CSS)</label>
        <input v-model="item.icon" type="text" class="input" />
      </div>

      <button type="button" class="btn-secondary" @click="addItem">+ Ajouter un service</button>
    </div>

    <button type="submit" class="btn-primary">Enregistrer</button>
  </form>
</template>

<script setup>
import { reactive } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  initialData: Object,
})
const data = props.initialData?.content || {}

const form = useForm({
  title: data.title || '',
  items: data.items?.length ? props.initialData.content.items : [
    { title: '', description: '', icon: '' },
  ],
})

function addItem() {
  form.items.push({ title: '', description: '', icon: '' })
}

function removeItem(index) {
  form.items.splice(index, 1)
}

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
.btn-secondary {
  background-color: #e5e7eb;
  color: #374151;
  padding: 0.4rem 0.75rem;
  border-radius: 0.375rem;
  margin-top: 0.5rem;
}
</style>
