<template>
  <div class="flex h-screen">
    <Sidebar />
    <div class="flex-1 flex flex-col overflow-hidden">
      <Navbar />
      <main class="flex-1 overflow-auto p-6 bg-gray-50 dark:bg-gray-900">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { usePage, Link } from '@inertiajs/vue3';

const page = usePage();
const userName = page.props.auth.user.name;
import Sidebar from '@/Components/Layout/Sidebar.vue'
import Navbar from '@/Components/Layout/Navbar.vue'

</script>