<template>
  <header class="w-full bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex items-center justify-between">
    <div class="text-lg font-semibold text-gray-800 dark:text-white">
      {{ title }}
    </div>

    <div class="flex items-center gap-4">
      <button @click="toggleDark" class="text-gray-600 dark:text-gray-300 hover:text-black dark:hover:text-white">
        <span v-if="isDark">🌙</span>
        <span v-else>☀️</span>
      </button>
  <span>Bienvenue, {{ userStore.user?.name || 'Invité' }}</span>
      <Link href="/logout" method="post" as="button" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
        Logout
      </Link>
    </div>
  </header>
</template>

<script setup>
import { computed } from 'vue'
import { usePage, Link } from '@inertiajs/vue3'
import { useUserStore } from '@/Stores/useUserStore'
import { onMounted } from 'vue'


const userStore = useUserStore()
onMounted(() => userStore.loadUser())

const page = usePage()
const title = computed(() => page.props.title ?? 'Dashboard')

// Toggle dark mode
const toggleDark = () => {
  document.documentElement.classList.toggle('dark')
}
const isDark = computed(() => document.documentElement.classList.contains('dark'))
</script>
