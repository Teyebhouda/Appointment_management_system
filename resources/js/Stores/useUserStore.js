// resources/js/Stores/useUserStore.js
import { defineStore } from 'pinia'
import { usePage } from '@inertiajs/vue3'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
  }),
  actions: {
    loadUser() {
      // Récupère l’utilisateur authentifié depuis les props Inertia
      this.user = usePage().props.auth.user
    },
  },
})
