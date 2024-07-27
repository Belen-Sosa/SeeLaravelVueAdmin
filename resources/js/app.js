import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { OhVueIcon, addIcons } from "oh-vue-icons";


import { BiPencilFill ,BiTrash3Fill  } from "oh-vue-icons/icons";
addIcons(BiPencilFill , BiTrash3Fill );

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';



createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
      
            .component('v-icon', OhVueIcon) // Registra el componente globalmente
            .mount(el);
        

    },
    progress: {
        color: '#4B5563',
    },
});
