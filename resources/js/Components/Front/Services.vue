<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'
import 'swiper/css/autoplay'
import { Autoplay } from 'swiper/modules'

import { CalendarIcon, LifebuoyIcon, AcademicCapIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
  content: {
    type: Object,
    default: () => ({
      title: '',
      items: []
    })
  }
})

// Mapping icon names to Heroicons
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
}
</script>

<template>
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-extrabold mb-10 text-gray-900 text-center">
        {{ content.title }}
      </h2>

      <!-- ✅ Nouvelle grille -->
      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="(service, index) in content.items.slice(0, 6)"
          :key="index"
          class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition group"
          data-aos="fade-up"
        >
          <div class="mb-4 text-primary-600 flex justify-center">
            <component :is="getIcon(service.icon)" class="w-12 h-12 group-hover:scale-110 transition" />
          </div>
          <h3 class="text-xl font-semibold text-center mb-2 text-gray-900">
            {{ service.title }}
          </h3>
          <p class="text-gray-600 text-center mb-4">{{ service.description }}</p>
          <div class="text-center">
            <button
              @click="selectService(service)"
              class="inline-flex items-center px-4 py-2 bg-primary-600 text-black rounded-lg text-sm font-medium hover:bg-primary-700 transition"
            >
              Prendre rendez-vous
            </button>
          </div>
        </div>
      </div>

      <!-- ✅ Bouton Voir tous -->
      <div class="mt-10 text-center">
        <a
          href="/services"
          class="inline-block px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold rounded-md transition"
        >
          Voir tous les services
        </a>
      </div>
    </div>
  </section>
</template>

