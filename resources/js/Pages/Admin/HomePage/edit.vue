<template>
  <DashboardLayout>
    <div class="flex min-h-screen bg-gray-100">
      <!-- Main content -->
      <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Modifier la section : {{ formatLabel(activeSection) }}</h1>

        <form @submit.prevent="submit">
          <!-- Chargement du bon composant selon la section -->
          <component
            :is="sectionComponents[activeSection]"
            v-model:form="form"
          />

          <button
            type="submit"
            class="mt-6 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            :disabled="processing"
          >
            {{ processing ? 'Enregistrement...' : 'Enregistrer' }}
          </button>
        </form>
      </main>

      <!-- Sidebar avec les sections -->
      <aside class="w-64 bg-white shadow p-4">
        <h2 class="text-xl font-bold mb-4">Sections</h2>
        <ul class="space-y-2">
          <li
            v-for="key in sectionKeys"
            :key="key"
            @click="activeSection = key"
            class="cursor-pointer px-3 py-2 rounded hover:bg-blue-100"
            :class="{ 'bg-blue-500 text-white': activeSection === key }"
          >
            {{ formatLabel(key) }}
          </li>
        </ul>
      </aside>
    </div>
  </DashboardLayout>
</template>

<script setup>
import { reactive, ref, watch } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { defineProps } from 'vue'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'

// Import des composants de formulaire pour chaque section
import HeroSectionForm from './Partials/HeroSectionForm.vue'
import FooterForm from './Partials/FooterForm.vue'
import HowItWorkForm from './Partials/HowItWorkForm.vue'
import ServicesForm from './Partials/ServicesForm.vue'
import TeamForm from './Partials/TeamForm.vue'
import AboutUsForm from './Partials/AboutUsForm.vue'
import Testimonials from './Partials/TestimonialsForm.vue'


// Props
const props = defineProps({
  sections: Object,
})

// Liste des clés de sections disponibles
const sectionKeys = Object.keys(props.sections)
const activeSection = ref(sectionKeys[0] || '')

// Formulaire réactif
const form = reactive({})

// Associer les clés de section à leurs composants respectifs
const sectionComponents = {
  hero: HeroSectionForm,
  footer: FooterForm,
  howItWork: HowItWorkForm,
  services: ServicesForm,
  teamMembers: TeamForm,
  AboutUs: AboutUsForm,
  testimonials: Testimonials
}

// Charger les données de la section sélectionnée
function loadSectionData(sectionKey) {
  const data = props.sections[sectionKey] || {}
  console.log('Chargement des données pour la section:', sectionKey, data)
  Object.keys(form).forEach(key => delete form[key])
  Object.assign(form, data)
}
watch(activeSection, loadSectionData, { immediate: true })

// Soumission du formulaire
const processing = ref(false)
function submit() {
  processing.value = true
  const formData = new FormData()

for (const key in form) {
  // Ne pas envoyer l'image preview URL
  if (key === 'background_image_file' && form[key] instanceof File) {
    formData.append('background_image', form[key])
  } else {
    formData.append(key, form[key])
  }
}

formData.append('_method', 'PUT') // car Inertia utilise PUT

Inertia.post(route('admin.homepage.update', activeSection.value), formData, {
  forceFormData: true,
  onFinish: () => {
    processing.value = false
  }
})
  console.log('Données soumises pour la section:', activeSection.value, form)
}

// Formatage des labels
function formatLabel(key) {
  const labels = {
    hero: 'Bannière',
    footer: 'Pied de page',
    howItWork: 'Fonctionnement',
    services: 'Services',
    teamMembers: 'Équipe',
    AboutUs: 'À propos de nous',
    testimonials: 'Témoignages',
  }
  return labels[key] || key
}
</script>
