<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'
import 'swiper/css/autoplay'
import { Autoplay } from 'swiper/modules'

const testimonials = [
  {
    name: "Amira B.",
    role: "Cliente fidèle",
    message: "Une équipe à l’écoute, un accueil chaleureux et un résultat impeccable. Je recommande à 100% !",
    image: "/images/client1.jpg"
  },
   {
    name: "Amira B.",
    role: "Cliente fidèle",
    message: "Une équipe à l’écoute, un accueil chaleureux et un résultat impeccable. Je recommande à 100% !",
    image: "/images/client1.jpg"
  },
  {
    name: "Youssef M.",
    role: "Client",
    message: "Service rapide, propre et très professionnel. Un vrai plaisir d’y revenir.",
    image: "/images/client2.jpg"
  },
  {
    name: "Nadia T.",
    role: "Cliente",
    message: "Le personnel est bienveillant et attentionné. Je suis ravie de chaque visite !",
    image: "/images/client3.jpg"
  }
]
</script>

<template>
  <section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-extrabold text-center mb-12 text-gray-900 dark:text-white">
        Témoignages
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
       
          v-for="(testimonial, index) in testimonials"
          :key="index"
          class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition"
        >
          <div class="flex flex-col items-center text-center">
            <img
              :src="testimonial.image"
              alt="Client photo"
              class="w-16 h-16 rounded-full object-cover mb-4 shadow"
            />
            <p class="text-gray-700 dark:text-gray-300 mb-4 italic">"{{ testimonial.message }}"</p>
            <h3 class="font-semibold text-gray-900 dark:text-white">{{ testimonial.name }}</h3>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ testimonial.role }}</span>
          </div>
        </SwiperSlide>
      </Swiper>
    </div>
  </section>
</template>
