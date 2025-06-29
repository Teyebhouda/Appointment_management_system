<template>
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-extrabold mb-10 text-gray-900">Nos Services</h2>
      <div class="grid gap-8 md:grid-cols-3">
        <div
          v-for="service in services"
          :key="service.id"
          class="bg-white p-6 rounded-lg shadow cursor-pointer hover:shadow-lg transition"
          @click="selectService(service)"
        >
          <div class="mb-4 text-primary-600">
            <component :is="getIcon(service.icon)" class="w-12 h-12 mx-auto" />
          </div>
          <h3 class="text-xl font-semibold mb-2 text-center">{{ service.title }}</h3>
          <p class="text-gray-600 text-center">{{ service.description }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { CalendarIcon  , LifebuoyIcon, AcademicCapIcon } from '@heroicons/vue/24/outline'


const services = ref([
  {
    id: 1,
    title: 'Consultation',
    description: 'Rencontrez nos experts pour des conseils personnalisés.',
    icon: 'calendar-check',
  },
  {
    id: 2,
    title: 'Support',
    description: 'Assistance 24/7 pour tous vos besoins.',
    icon: 'lifebuoy',
  },
  {
    id: 3,
    title: 'Formation',
    description: 'Formations dédiées pour apprendre efficacement.',
    icon: 'academic-cap',
  },
])

function getIcon(name) {
  switch (name) {
    case 'calendar-check':
      return CalendarIcon  
    case 'lifebuoy':
      return LifebuoyIcon
    case 'academic-cap':
      return AcademicCapIcon
    default:
      return CalendarIcon  
  }
}

function selectService(service) {
  alert(`Vous avez choisi le service : ${service.title}`)
  // Ici tu peux router vers une autre page, ouvrir un modal, etc.
}
</script>



