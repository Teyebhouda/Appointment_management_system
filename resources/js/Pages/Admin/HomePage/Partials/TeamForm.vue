<script setup>
import { toRefs } from 'vue'

// On reçoit le formulaire en prop depuis le parent
const props = defineProps({
  form: Object
})
const { form } = toRefs(props)

// Ajouter un membre
function addMember() {
  form.value.members.push({
    name: '',
    role: '',
    bio: '',
    photo: '',
    github: '',
    twitter: '',
    instagram: '',
  })
}

// Supprimer un membre
function removeMember(index) {
  form.value.members.splice(index, 1)
}


</script>

<template>
  <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Équipe</h2>
    <label class="block mb-4">
      Titre équipe :
      <input v-model="form.title" class="input mt-1" type="text" />
    </label>
    <div v-for="(member, idx) in form.members" :key="idx" class="mb-8 border-b pb-4">
      <h3 class="font-semibold mb-2">Membre {{ idx + 1 }}</h3>
      <label class="block mb-2">
        Nom :
        <input v-model="member.name" class="input mt-1" type="text" />
      </label>
      <label class="block mb-2">
        Rôle :
        <input v-model="member.role" class="input mt-1" type="text" />
      </label>
      <label class="block mb-2">
        Bio :
        <textarea v-model="member.bio" class="input mt-1"></textarea>
      </label>
      <label class="block mb-2">
        Photo (URL) :
        <input v-model="member.photo" class="input mt-1" type="url" />
      </label>
      <label class="block mb-2">
        Github :
        <input v-model="member.github" class="input mt-1" type="url" />
      </label>
      <label class="block mb-2">
        Twitter :
        <input v-model="member.twitter" class="input mt-1" type="url" />
      </label>
      <label class="block mb-2">
        Instagram :
        <input v-model="member.instagram" class="input mt-1" type="url" />
      </label>
      <button type="button" @click="removeMember(idx)" class="text-red-500 mt-2">Supprimer ce membre</button>
    </div>
    <button type="button" @click="addMember" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter un membre</button>
  </div>
</template>

<style scoped>
.input {
  @apply w-full border border-gray-300 p-2 rounded;
}
</style>