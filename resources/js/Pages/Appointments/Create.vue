<template>
  <div>
    <h1 class="text-xl font-bold">New Appointment</h1>
    <form @submit.prevent="submit">
      <input v-model="form.title" placeholder="Title" class="border p-2 block my-2" />
      <textarea v-model="form.description" placeholder="Description" class="border p-2 block my-2" />
      <input type="datetime-local" v-model="form.appointment_time" class="border p-2 block my-2" />
      <button type="submit" class="bg-blue-500 text-white px-4 py-2">Create</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  description: '',
  appointment_time: '',
})

const submit = () => {
  form.post('/appointments')
}
</script>
