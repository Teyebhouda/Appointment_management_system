<template>
  <div class="max-w-4xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6 capitalize">Éditer la section : {{ sectionKey }}</h1>

    <component
      :is="getFormComponent(sectionKey)"
      v-model:form="form"
    />

    <button
      @click="submit"
      class="mt-6 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
      :disabled="processing"
    >
      {{ processing ? 'Enregistrement...' : 'Enregistrer' }}
    </button>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import HeroForm from './Partials/HeroForm.vue'
import HowItWorksForm from './Partials/HowItWorksForm.vue'
import ServicesForm from './Partials/ServicesForm.vue'
import TestimonialsForm from './Partials/TestimonialsForm.vue'
import FooterForm from './Partials/FooterForm.vue'

// Props
const props = defineProps({ section: Object })
const sectionKey = props.section.section_key
const form = reactive({ ...props.section.content }) // contenu dynamique
const processing = ref(false)
console.log('Form data:', form)

// Rendu du composant dynamique
function getFormComponent(key) {
  switch (key) {
    case 'hero': return HeroForm
    case 'how_it_works': return HowItWorksForm
    case 'services': return ServicesForm
    case 'testimonials': return TestimonialsForm
    case 'footer': return FooterForm
    default:
      return {
        template: '<div>Composant de section inconnu.</div>',
      }
  }
}

// Soumission
function submit() {
  processing.value = true
  router.put(`/home/sections/${sectionKey}`, { content: { ...form } }, {
    preserveScroll: true,
    preserveState: true,
    onFinish: () => (processing.value = false),
  })
}
</script>
