import { defineStore } from 'pinia'
import { usePage } from '@inertiajs/vue3'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
  }),
  actions: {
    loadUser() {
      this.user = usePage().props.value.auth.user
    },
  },
})
