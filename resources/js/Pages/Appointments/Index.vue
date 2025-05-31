<script setup>
import { ref } from 'vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const props = usePage().props;
const appointments = ref(props.appointments.data);
const links = ref(props.appointments.links);

function destroy(id) {
  if (confirm('Voulez-vous vraiment supprimer ce rendez-vous ?')) {
    Inertia.delete(route('appointments.destroy', id));
  }
}
</script>

<template>
  <DashboardLayout>
    <Head title="Liste des rendez-vous" />

    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold">Mes Rendez-vous</h1>
      <Link href="/appointments/create" class="btn btn-primary">Nouveau RDV</Link>
    </div>

    <table class="min-w-full bg-white rounded shadow">
      <thead>
        <tr>
          <th class="border px-4 py-2">Titre</th>
          <th class="border px-4 py-2">Date & Heure</th>
          <th class="border px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="appointment in appointments" :key="appointment.id">
          <td class="border px-4 py-2">{{ appointment.title }}</td>
          <td class="border px-4 py-2">{{ new Date(appointment.appointment_time).toLocaleString() }}</td>
          <td class="border px-4 py-2">
            <Link
              :href="`/appointments/${appointment.id}/edit`"
              class="text-blue-600 hover:underline mr-4"
            >Modifier</Link>
            <button
              @click="destroy(appointment.id)"
              class="text-red-600 hover:underline"
            >Supprimer</button>
          </td>
        </tr>
        <tr v-if="appointments.length === 0">
          <td colspan="3" class="text-center py-4">Aucun rendez-vous trouvé.</td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination simple -->
    <div class="mt-4 flex justify-center space-x-2">
      <template v-for="link in links" :key="link.label">
        <Link
          v-if="link.url"
          :href="link.url"
          class="px-3 py-1 rounded border"
          :class="{'bg-gray-300 font-bold': link.active}"
          v-html="link.label"
        />
        <span v-else class="px-3 py-1 text-gray-400" v-html="link.label"></span>
      </template>
    </div>
  </DashboardLayout>
</template>
