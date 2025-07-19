<script setup>
import { toRefs } from 'vue'
import {ref} from 'vue'

const props = defineProps({
  form: {
    type: Object,
    
  }
})
const { form } = toRefs(props)

if (!form.value.features) form.value.features = []
if (!form.value.images) form.value.images = []

function addFeature() {
  form.features.push('')
}
function removeFeature(idx) {
  form.features.splice(idx, 1)
}

function addImage() {
  form.images.push('')
}
function removeImage(idx) {
  form.images.splice(idx, 1)
}

function submit() {
  // Adapt to your backend (Inertia, API, etc.)
  console.log('AboutUs data:', form)
}
</script>

<template>
  <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">À propos de nous</h2>
    <label class="block mb-4">
      Titre :
      <input v-model="form.title" class="input mt-1" type="text" />
    </label>
    <label class="block mb-4">
      Description :
      <textarea v-model="form.description" class="input mt-1"></textarea>
    </label>
    <div class="mb-4">
      <label class="block font-semibold mb-2">Fonctionnalités :</label>
      <div v-for="(feature, idx) in form.features" :key="idx" class="flex items-center mb-2">
        <input v-model="form.features[idx]" class="input flex-1" type="text" />
        <button type="button" @click="removeFeature(idx)" class="ml-2 text-red-500">Supprimer</button>
      </div>
      <button type="button" @click="addFeature" class="bg-blue-500 text-white px-3 py-1 rounded">Ajouter une fonctionnalité</button>
    </div>
    <div class="mb-4">
      <label class="block font-semibold mb-2">Images :</label>
      <div v-for="(image, idx) in form.images" :key="idx" class="flex items-center mb-2">
        <input v-model="form.images[idx]" class="input flex-1" type="url" placeholder="URL de l'image" />
        <button type="button" @click="removeImage(idx)" class="ml-2 text-red-500">Supprimer</button>
      </div>
      <button type="button" @click="addImage" class="bg-blue-500 text-white px-3 py-1 rounded">Ajouter une image</button>
    </div>
    <label class="block mb-4">
      Texte du bouton :
      <input v-model="form.buttonText" class="input mt-1" type="text" />
    </label>
    <button type="button" @click="submit" class="bg-green-500 text-white px-4 py-2 rounded">Enregistrer</button>
  </div>
</template>

<style scoped>
.input {
  @apply w-full border border-gray-300 p-2 rounded;
}
</style>