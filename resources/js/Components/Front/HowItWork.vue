<script setup>
const props = defineProps({
  content: {
    type: Object,
    default: () => ({
      title: '',
      subtitle: '',
      steps: []
    })
  }
})
</script>




<template>
  <section class="bg-white dark:bg-gray-900">
    <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
         {{ content.title }}
        </h2>
        <p class="mt-4 text-gray-500 dark:text-gray-300">
         {{ content.subtitle }}
        </p>
      </div>

      <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-3">
        <div v-for="(step, index) in content.steps" :key="index" class="text-center">
          <div class="flex justify-center mb-4">
            <span class="inline-block p-4 bg-blue-100 text-blue-600 rounded-full">
              {{ step.icon }}
            </span>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ step.title }}</h3>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ step.description }}
          </p>
        </div>

        
      </div>
    </div>
  </section>
</template>


