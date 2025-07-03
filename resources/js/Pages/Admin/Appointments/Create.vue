<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const { users, services } = usePage().props;
console.log('users:', users)
console.log('services:', services)


const form = useForm({
  title: '', 
  description: '',
  status: '',
  appointment_time: '',
  user_id: '',
  service_id: '',
});

function submit() {
  form.post(route('appointments.store'));
}
</script>

<template>
  <DashboardLayout>
    <Head title="Créer un rendez-vous" />

    <h1 class="text-3xl font-extrabold mb-6">Créer un rendez-vous</h1>

    <form @submit.prevent="submit" class="space-y-6 max-w-lg">
      <div>
        <label class="block text-gray-700 font-semibold mb-1" for="title">Titre</label>
        <input
          v-model="form.title"
          id="title"
          type="text"
          placeholder="Titre du rendez-vous"
          class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
          :class="{ 'border-red-500': form.errors.title }"
        />
        <p v-if="form.errors.title" class="text-red-600 text-sm mt-1">{{ form.errors.title }}</p>
      </div>

      <div>
        <label class="block text-gray-700 font-semibold mb-1" for="description">Description</label>
        <textarea
          v-model="form.description"
          id="description"
          rows="4"
          placeholder="Description optionnelle"
          class="w-full border rounded-md px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-400"
        ></textarea>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold mb-1" for="status">Statut</label>
        <select
          v-model="form.status"
          id="status"
          class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
          :class="{ 'border-red-500': form.errors.status }"
        >
          <option value="" disabled>-- Sélectionner un statut --</option>
          <option value="pending">En attente</option>
          <option value="confirmed">Confirmé</option>
          <option value="cancelled">Annulé</option>
        </select>
        <p v-if="form.errors.status" class="text-red-600 text-sm mt-1">{{ form.errors.status }}</p>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold mb-1" for="appointment_time">Date & Heure</label>
        <input
          v-model="form.appointment_time"
          id="appointment_time"
          type="datetime-local"
          class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
          :class="{ 'border-red-500': form.errors.appointment_time }"
        />
        <p v-if="form.errors.appointment_time" class="text-red-600 text-sm mt-1">{{ form.errors.appointment_time }}</p>
      </div>

      <div>
        <label class="block text-gray-700 font-semibold mb-1" for="user_id">Utilisateur</label>
        <select
          v-model="form.user_id"
          id="user_id"
          class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
          :class="{ 'border-red-500': form.errors.user_id }"
        >
          <option value="" disabled>-- Sélectionner un utilisateur --</option>
          <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
        </select>
        <p v-if="form.errors.user_id" class="text-red-600 text-sm mt-1">{{ form.errors.user_id }}</p>
      </div>

      <div>
        <label class="block text-gray-700 font-semibold mb-1" for="service_id">Service</label>
        <select
          v-model="form.service_id"
          id="service_id"
          class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
          :class="{ 'border-red-500': form.errors.service_id }"
        >
          <option value="" disabled>-- Sélectionner un service --</option>
          <option v-for="service in services" :key="service.id" :value="service.id">{{ service.name }}</option>
        </select>
        <p v-if="form.errors.service_id" class="text-red-600 text-sm mt-1">{{ form.errors.service_id }}</p>
      </div>

      <div class="flex space-x-4">
        <button
          type="submit"
          :disabled="form.processing"
          class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          Créer
        </button>
        <Link
          href="route('appointments.index')'"
          class="btn btn-secondary px-6 py-2 rounded-md bg-gray-300 hover:bg-gray-400"
        >
          Annuler
        </Link>
      </div>
    </form>
  </DashboardLayout>
</template>
