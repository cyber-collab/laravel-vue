import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from "vue";
import router from '@/router/index.js'
import AccountsIndex from '@/components/accounts/AccountsIndex.vue'
import DealsIndex from '@/components/deals/DealsIndex.vue'

createApp({
    components: {
        AccountsIndex,
        DealsIndex,
    }
}).use(router).mount('#app')
