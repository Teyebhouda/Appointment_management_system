import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import { createPinia } from 'pinia'
// 👇 Import all Lucide icons
import * as lucide from 'lucide-vue-next';
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import AOS from 'aos';
import 'aos/dist/aos.css';

// 1) Créez l’application Vue et ajoutez Pinia
const pinia = createPinia()

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';


createInertiaApp({
  resolve: name => require(`./Pages/${name}`).default,
  setup({ el, App, props, plugin }) {
    const vueApp = createApp({ render: () => h(App, props) })
    vueApp.use(plugin)
    vueApp.use(pinia)
    vueApp.component('DashboardLayout', DashboardLayout)
    vueApp.mount(el)
  },
})





createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // 👇 Register Lucide icons globally
        for (const [key, component] of Object.entries(lucide)) {
            app.component(key, component);
        }

        return app
            .use(plugin)
            .use(ZiggyVue)
            .use(toast)
            .use(createPinia())
            .mount(el);
    },

    progress: {
        color: '#4B5563',
    },
});
AOS.init({
    duration: 1000, // Durée de l'animation en millisecondes
    once: true, // L'animation ne se déclenche qu'une seule fois
    disable: 'mobile', // Désactiver sur mobile
    easing: 'ease-in-out', // Type d'animation
});
