<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  title: '',
  description: '',
  appointment_time: '',
});

function submit() {
  form.post(route('appointments.store'));
}
</script>

<template>
  <DashboardLayout>
    <Head title="Créer un rendez-vous" />

    <h1 class="text-2xl font-bold mb-4">Créer un rendez-vous</h1>

    <form @submit.prevent="submit" class="space-y-4 max-w-md">
      <div>
        <label class="block font-medium">Titre</label>
        <input
          v-model="form.title"
          type="text"
          class="border rounded w-full px-3 py-2"
          :class="{ 'border-red-500': form.errors.title }"
        />
        <div v-if="form.errors.title" class="text-red-600 text-sm">{{ form.errors.title }}</div>
      </div>

      <div>
        <label class="block font-medium">Description</label>
        <textarea
          v-model="form.description"
          class="border rounded w-full px-3 py-2"
          rows="3"
        ></textarea>
      </div>

      <div>
        <label class="block font-medium">Date & Heure</label>
        <input
          v-model="form.appointment_time"
          type="datetime-local"
          class="border rounded w-full px-3 py-2"
          :class="{ 'border-red-500': form.errors.appointment_time }"
        />
        <div v-if="form.errors.appointment_time" class="text-red-600 text-sm">{{ form.errors.appointment_time }}</div>
      </div>

      <div class="flex space-x-4">
        <button type="submit" class="btn btn-primary" :disabled="form.processing">Créer</button>
        <Link href="/appointments" class="btn btn-secondary">Annuler</Link>
      </div>
    </form>
  </DashboardLayout>
</template>
