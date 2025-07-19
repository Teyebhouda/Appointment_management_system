<script setup>
import { toRefs, ref, watch } from 'vue'

const props = defineProps({
  form: Object
})

const { form } = toRefs(props)

const imagePreview = ref(form.value.background_image ?? '')

watch(() => form.value.background_image, (newVal) => {
  imagePreview.value = newVal // actualise si l'image change côté serveur
})

function onImageChange(e) {
  const file = e.target.files[0]
  if (file) {
    imagePreview.value = URL.createObjectURL(file)
    form.value.background_image_file = file // pour l'envoi
  }
}
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
      Image de fond
      <input type="file" @change="onImageChange" />
    </label>

    <div v-if="imagePreview" class="mt-2">
      <img :src="imagePreview" alt="Aperçu" class="rounded shadow max-h-60" />
    </div>
  </div>
</template>

<style scoped>
.input {
  @apply w-full border border-gray-300 p-2 rounded;
}
</style>
