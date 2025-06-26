<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3'; 
import { ref } from 'vue';

const props  = usePage().props;
const users = ref(props.users?.data || []);
const links = ref(props.users?.links || []);
console.log('users:', users.value);

function destroy(id) {
  if (confirm('Voulez-vous vraiment supprimer cet utilisateur ?')) {
    router.delete(route('users.destroy', id), {
      onSuccess: () => {
        usersRef.value = usersRef.value.filter(user => user.id !== id);
      },
      onError: (error) => {
        console.error('Erreur lors de la suppression de l\'utilisateur:', error);
      }
    });
  }
}



</script>
<template>
  <DashboardLayout>
    <Head title="Utilisateurs" />
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-extrabold">Utilisateurs</h1>
    </div>

    <table class="min-w-full bg-white rounded shadow overflow-hidden">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-6 py-3 text-left font-semibold text-gray-600">Nom</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-600">Email</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-600">Role  </th>
          <th class="px-6 py-3 text-left font-semibold text-gray-600">Actions</th>
        </tr>
      </thead>
      <tbody>
       <tr v-for="user in users" :key="user.id" class="border-t hover:bg-gray-50">
  <td class="px-6 py-4">{{ user.name }}</td>
  <td class="px-6 py-4">{{ user.email }}</td>
  <td class="px-6 py-4">{{ user.role }}</td>
  <td class="px-6 py-4 space-x-3">
    <!-- Actions -->
    
    <button
      @click="destroy(user.id)"
      class="text-red-600 hover:text-red-900 font-medium"
    >Supprimer</button>
  </td>
</tr>

      </tbody>
    </table>
  </DashboardLayout>
</template>

