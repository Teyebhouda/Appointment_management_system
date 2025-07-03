<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, useForm,Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    description: '',
    price: 0,
});
 function submitForm() {
    form.post(route('services.store'), {
       
    });
 }
</script>
<template>
    <DashboardLayout>
        <Head title="Create Service" />
        <div class="p-6 text-gray-900">
        <h1 class="text-2xl font-bold mb-4">🛠️ Create Service</h1>
        <form @submit.prevent="submitForm" class="space-y-4">
            <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Service Name</label>
            <input v-model="form.name" type="text" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea v-model="form.description" id="description" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>
            <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input v-model.number="form.price" type="number" id="price" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create Service</button>
       
            <Link :href="route('services.index')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                Cancel
            </Link>
        </form>
        </div>
    </DashboardLayout>
</template>