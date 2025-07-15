<template>
  <form @submit.prevent="submit" class="space-y-6">
    <div>
      <label class="block font-semibold mb-1">Titre du footer</label>
      <input v-model="localForm.title" type="text" class="input" />
    </div>

    <div>
      <label class="block font-semibold mb-1">Description</label>
      <textarea v-model="localForm.description" class="input" rows="3" />
    </div>

    <div>
      <label class="block font-semibold mb-2">Liens</label>
      <div
        v-for="(link, index) in localForm.links"
        :key="index"
        class="border p-4 rounded mb-4 relative"
      >
        <button
          type="button"
          class="absolute top-2 right-2 text-red-600 font-bold"
          @click="removeLink(index)"
          aria-label="Supprimer ce lien"
        >
          &times;
        </button>

        <label>Titre du lien</label>
        <input v-model="link.title" type="text" class="input" />

        <label>URL</label>
        <input v-model="link.url" type="url" class="input" />
      </div>

      <button type="button" class="btn-secondary" @click="addLink">
        + Ajouter un lien
      </button>
    </div>

    <button type="submit" class="btn-primary">Enregistrer</button>
  </form>
</template>


<script setup>
import { computed } from 'vue'

const props = defineProps({
  form: Object,
})
const emit = defineEmits(['update:form'])

const localForm = computed({
  get: () => props.form,
  set: (value) => emit('update:form', value),
})

function addLink() {
  localForm.value.links.push({ title: '', url: '' })
}

function removeLink(index) {
  localForm.value.links.splice(index, 1)
}

function submit() {
  // Ici, la soumission est gérée par le composant parent
  // Donc tu peux soit ne rien faire ici, soit appeler une méthode de validation
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
  cursor: pointer;
}
.btn-secondary {
  background-color: #e5e7eb;
  color: #374151;
  padding: 0.4rem 0.75rem;
  border-radius: 0.375rem;
  margin-top: 0.5rem;
  cursor: pointer;
}
</style>
