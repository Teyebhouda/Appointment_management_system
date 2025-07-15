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

      <Swiper
        :modules="[Autoplay]"
        :spaceBetween="24"
        :loop="true"
        :autoplay="{ delay: 2500, disableOnInteraction: false }"
        :breakpoints="{
          640: { slidesPerView: 1 },
          768: { slidesPerView: 2 },
          1024: { slidesPerView: 3 }
        }"
        class="mySwiper"
      >
        <SwiperSlide
          v-for="(service, index) in content.items"
          :key="index"
        >
          <div
            class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition cursor-pointer"
            @click="selectService(service)"
            data-aos="zoom-in"
          >
            <div class="mb-4 text-primary-600">
              <component
                :is="getIcon(service.icon)"
                class="w-12 h-12 mx-auto"
              />
            </div>
            <h3 class="text-xl font-semibold mb-2 text-center">
              {{ service.title }}
            </h3>
            <p class="text-gray-600 text-center">
              {{ service.description }}
            </p>
          </div>
        </SwiperSlide>
      </Swiper>
    </div>
  </section>
</template>
