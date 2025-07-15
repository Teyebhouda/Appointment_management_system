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
  teamMembers: TeamForm
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
  Inertia.put(
    route('admin.homepage.update', activeSection.value),
  { ...form },
    {
      onFinish: () => {
        processing.value = false
      },
    }
  )
}

// Formatage des labels
function formatLabel(key) {
  const labels = {
    hero: 'Bannière',
    footer: 'Pied de page',
    howItWork: 'Fonctionnement',
    services: 'Services',
    teamMembers: 'Équipe'
  }
  return labels[key] || key
}
</script>
