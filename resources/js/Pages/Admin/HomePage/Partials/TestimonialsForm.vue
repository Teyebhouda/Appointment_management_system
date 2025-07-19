<script setup>
import { toRefs } from 'vue'

const props = defineProps({
  form: {
    type: Object
  }
})
const { form } = toRefs(props)

function addTestimonial() {
  form.value.testimonials.items.push({
    name: '',
    role: '',
    message: '',
    image: ''
  })
}

function removeTestimonial(index) {
  form.value.testimonials.items.splice(index, 1)
}

function submit() {
  console.log('Données soumises :', form.value)
}
</script>

<template>
  <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Témoignages</h2>

    <label class="block mb-4">
      Titre :
      <input v-model="form.title" class="input mt-1" type="text" placeholder="Ex : Ce que disent nos utilisateurs" />
    </label>

    <div
      v-for="(testimonial, index) in form.items"
      :key="index"
      class="mb-6 border p-4 rounded"
    >
      <label class="block mb-2">
        Nom :
        <input v-model="testimonial.name" class="input mt-1" type="text" />
      </label>
      <label class="block mb-2">
        Rôle :
        <input v-model="testimonial.role" class="input mt-1" type="text" />
      </label>
      <label class="block mb-2">
        Message :
        <textarea v-model="testimonial.message" class="input mt-1"></textarea>
      </label>
      <label class="block mb-2">
        URL de l'image :
        <input v-model="testimonial.image" class="input mt-1" type="url" />
      </label>
      <button type="button" @click="removeTestimonial(index)" class="text-red-500 mt-2">Supprimer</button>
    </div>

    <button type="button" @click="addTestimonial" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">
      Ajouter un témoignage
    </button>

    <button type="button" @click="submit" class="bg-green-600 text-white px-4 py-2 rounded">
      Enregistrer
    </button>
  </div>
</template>

<style scoped>
.input {
  @apply w-full border border-gray-300 p-2 rounded;
}
</style>
