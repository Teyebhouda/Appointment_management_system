<script setup>
defineProps({
  form: Object
})
</script>

<template>
  <div class="grid gap-4">
    <label>
      Titre
      <input v-model="form.title" type="text" class="input" />
    </label>
    <label>
      Sous-titre
      <textarea v-model="form.subtitle" class="input" />
    </label>
    <label>
      Texte du bouton
      <input v-model="form.button_text" type="text" class="input" />
    </label>
    <label>
      Image de fond (URL)
      <input v-model="form.background_image" type="url" class="input" />
    </label>
  </div>
</template>

<style scoped>
.input {
  @apply w-full border border-gray-300 p-2 rounded;
}
</style>
