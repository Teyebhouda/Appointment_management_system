<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { Head } from '@inertiajs/vue3'


</script>

<template>
  <DashboardLayout>
    <Head title="Dashboard" />

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            You're logged in! 🎉
          </div>
       
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
