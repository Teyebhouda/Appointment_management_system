<template>  
    <div>
        <h1 class="text-2xl font-bold text-center my-8">Bienvenue dans le panneau d'administration</h1>
        <div class="flex justify-center items-center h-screen bg-gray-100">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-gray-700">Ceci est la page d'accueil de l'administration.</p>
            </div>
             <ul>
      <li v-for="user in users" :key="user.id">
        {{ user.name }} - {{ user.email }}
      </li>
    </ul>
            <div class="mt-4">
                <a href="/admin/users" class="text-blue-500 hover:underline">Gérer les utilisateurs</a>
            </div>
            <div class="mt-4">
                <a href="/admin/appointments" class="text-blue-500 hover:underline">Gérer les rendez-vous</a>
            </div>
        </div>
    </div>
</template>

<script setup>
// You can use props or imports here
</script>