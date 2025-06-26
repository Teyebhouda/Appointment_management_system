<script setup> 
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { ref } from 'vue';


const { services } = usePage().props;
const servicesRef = ref(services.data);
const links = ref(services.links);
 
function destroy(id) {
    if (confirm('voulez-vous vraiment supprimer ce service ?')) {
        router.delete(route('services.destroy', id)
            , {
            onSuccess: () => {
                servicesRef.value = servicesRef.value.filter(service => service.id !== id);
            },
            onError: (error) => {
                console.error('Erreur lors de la suppression du service:', error);
            }
        });
    }
}

</script>
<template>
    <DashboardLayout>   

        <Head title="Services" />
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold">Services</h1>
            <Link :href="route('services.create')" class="btn btn-primary px-5 py-2 rounded-md hover:bg-blue-700">
                Nouveau Service
            </Link>
        </div>


        <table class="min-w-full bg-white rounded shadow overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Nom</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Description</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Prix</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="service in servicesRef" :key="service.id" class="border-t hover:bg-gray-50">
                    <td class="px-6 py-4">{{ service.name }}</td>
                    <td class="px-6 py-4">{{ service.description }}</td>
                    <td class="px-6 py-4">{{ Number(service.price).toFixed(2) }} €</td>
                    <td class="px-6 py-4 space-x-3">
                        <Link
                            :href="route('services.edit', service.id)"
                            class="text-indigo-600 hover:text-indigo-900 font-medium"
                        >Modifier</Link>
                        <button
                            @click="destroy(service.id)"
                            class="text-red-600 hover:text-red-900 font-medium"
                        >Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
        

    </DashboardLayout>



</template>