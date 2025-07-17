<script setup>
defineProps({
  content: {
    type: Object,
    default: () => ({
      title: "À propos de nous",
      description:
        "Notre équipe vous accueille dans un espace moderne pour prendre soin de vous. Nous nous engageons à offrir une expérience de qualité à chaque visite.",
      features: [
        "Facilité de prise de rendez-vous",
        "Équipe expérimentée",
        "Service personnalisé",
        "Disponibilité 7j/7",
      ],
      images: [
        "/images/room.jpg",
        "/images/waiting.jpg",
        "/images/team.jpg",
        "/images/tools.jpg",
      ],
        buttonText: "En savoir plus",
    }),
  },
});
</script>

<template>
  <section class="bg-gray-50 dark:bg-gray-900 py-16" data-aos="fade-up">
    <div class="max-w-screen-xl mx-auto px-4 md:px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
      
      <!-- Texte à gauche -->
      <div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
          {{ content.title }}
        </h2>
        <p class="text-gray-600 dark:text-gray-300 mb-6 text-lg leading-relaxed">
          {{ content.description }}
        </p>
        <ul class="space-y-3 text-gray-700 dark:text-gray-400">
          <li
            v-for="(feature, index) in content.features"
            :key="index"
            class="flex items-center"
          >
            <svg
              class="w-5 h-5 text-primary-600 mr-2"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414L9 14.414l7-7a1 1 0 000-1.414z"
                clip-rule="evenodd"
              />
            </svg>
            {{ feature }}
          </li>
        </ul>
         <div class="mt-6">
    <button
      class="inline-flex items-center px-6 py-3 bg-primary-600 text-black font-medium text-sm rounded-lg shadow-md hover:bg-primary-700 focus:outline-none transition duration-300"
    >
     {{ content.buttonText }}
      <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>
      </div>

      <!-- Album photo à droite -->
      <div class="flex justify-center md:justify-end">
        <div class="grid grid-cols-2 gap-x-4">
          
          <!-- Colonne 1 -->
          <div class="flex flex-col gap-4">
            <div
              v-for="(image, index) in content.images.filter((_, i) => i % 2 === 0).slice(0, 3)"
              :key="`left-${index}`"
            >
              <img
                :src="image"
                alt="Photo"
                class="w-28 h-36 md:w-32 md:h-40 lg:w-36 lg:h-48 object-cover rounded-2xl shadow-lg transition-transform duration-300 hover:scale-105"
              />
            </div>
          </div>

          <!-- Colonne 2 (avec un décalage) -->
          <div class="flex flex-col gap-4 mt-8 md:mt-12">
            <div
              v-for="(image, index) in content.images.filter((_, i) => i % 2 === 1).slice(0, 3)"
              :key="`right-${index}`"
            >
              <img
                :src="image"
                alt="Photo"
                class="w-28 h-36 md:w-32 md:h-40 lg:w-36 lg:h-48 object-cover rounded-2xl shadow-lg transition-transform duration-300 hover:scale-105"
              />
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</template>
