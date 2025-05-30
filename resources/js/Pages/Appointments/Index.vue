<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head } from '@inertiajs/vue3';
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
const calendarOptions = {
  plugins: [dayGridPlugin],
  initialView: 'dayGridMonth',
  events: [
    { title: 'Consultation', date: '2025-06-05' },
    { title: 'Suivi', date: '2025-06-10' }
  ]
}
</script>

<template>
  <DashboardLayout>
    <Head title="Appointments" />
    <div class="p-6 text-gray-900">📅 Appointments Page</div>
     <div class="p-4">
    <FullCalendar :options="calendarOptions" />
  </div>
  </DashboardLayout>
</template>
