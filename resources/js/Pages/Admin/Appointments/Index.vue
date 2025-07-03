<script setup>
import { ref } from 'vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';

const { appointments } = usePage().props;
const appointmentsRef = ref(appointments.data);
const links = ref(appointments.links);

function destroy(id) {
  if (confirm('Voulez-vous vraiment supprimer ce rendez-vous ?')) {
    router.delete(route('appointments.destroy', id), {
      onSuccess: () => {
        appointmentsRef.value = appointmentsRef.value.filter(appointment => appointment.id !== id);
      },
      onError: (error) => {
        console.error('Erreur lors de la suppression du rendez-vous:', error);
      }
    });
    
  }
}
</script>

<template>
  <DashboardLayout>
    <Head title="Mes Rendez-vous" />

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-extrabold">Mes Rendez-vous</h1>
      <Link :href="route('appointments.create')" class="btn btn-primary px-5 py-2 rounded-md hover:bg-blue-700">
        Nouveau RDV
      </Link>
    </div>

    <table class="min-w-full bg-white rounded shadow overflow-hidden">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-6 py-3 text-left font-semibold text-gray-600">Titre</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-600">Utilisateur</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-600">Service</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-600">Date & Heure</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-600">Statut</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-600">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="appointment in appointmentsRef" :key="appointment.id" class="border-t hover:bg-gray-50">
          <td class="px-6 py-4">{{ appointment.title }}</td>
          <td class="px-6 py-4">{{ appointment.user?.name ?? 'N/A' }}</td>
          <td class="px-6 py-4">{{ appointment.service?.name ?? 'N/A' }}</td>
          <td class="px-6 py-4">{{ new Date(appointment.appointment_time).toLocaleString() }}</td>
          <td class="px-6 py-4">
            <span :class="{
              'text-green-600': appointment.status === 'confirmed',
              'text-yellow-600': appointment.status === 'pending',
              'text-red-600': appointment.status === 'cancelled'
            }">
              {{ appointment.status.charAt(0).toUpperCase() + appointment.status.slice(1) }}
            </span> 
            </td>  
          <td class="px-6 py-4 space-x-3">
            <Link
              :href="route('appointments.edit', appointment.id)"
              class="text-indigo-600 hover:text-indigo-900 font-medium"
            >Modifier</Link>
            <button
              @click="destroy(appointment.id)"
              class="text-red-600 hover:text-red-900 font-medium"
              type="button"
            >
              Supprimer
            </button>
          </td>
        </tr>
        <tr v-if="appointmentsRef.length === 0">
          <td colspan="5" class="text-center py-8 text-gray-500 italic">Aucun rendez-vous trouvé.</td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination simple -->
    <div class="mt-6 flex justify-center space-x-2">
      <template v-for="link in links" :key="link.label">
        <Link
          v-if="link.url"
          :href="link.url"
          class="px-3 py-1 rounded border text-sm"
          :class="{'bg-blue-500 text-white': link.active, 'hover:bg-gray-200': !link.active}"
          v-html="link.label"
        />
        <span v-else class="px-3 py-1 text-gray-400 text-sm" v-html="link.label"></span>
      </template>
    </div>
  </DashboardLayout>
</template>
