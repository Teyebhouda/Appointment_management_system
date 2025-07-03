<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head,router, usePage } from '@inertiajs/vue3';   
import { ref } from 'vue';


const props = usePage().props;
const clients = ref(props.clients?.data || []);
const links = ref(props.clients?.links || []);

// 🔍 Affichage debug
console.log('clients:', clients.value);
function destroy(id) {
  if (confirm('Voulez-vous vraiment supprimer ce client ?')) {
    router.delete(route('clients.destroy', id), {
      onSuccess: () => {
        clients.value = clients.value.filter(client => client.id !== id);
      },
      onError: (error) => {
        console.error('Erreur lors de la suppression du client:', error);
      }
    });
  }
}
</script>
<template>
    <DashboardLayout>
        <Head title="Clients" />
        <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-extrabold">Clients</h1>
        </div>
    
        <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
            <th class="px-6 py-3 text-left font-semibold text-gray-600">Nom</th>
            <th class="px-6 py-3 text-left font-semibold text-gray-600">Email</th>
            <th class="px-6 py-3 text-left font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="client in clients" :key="client.id" class="border-t hover:bg-gray-50">
            <td class="px-6 py-4">{{ client.name }}</td>
            <td class="px-6 py-4">{{ client.email }}</td>
            <td class="px-6 py-4 space-x-3">
                <!-- Actions -->
                <button @click="destroy(client.id)" class="text-red-600 hover:text-red-800">Supprimer</button>
            </td>
            </tr>
        </tbody>
        </table>
    </DashboardLayout>
</template>