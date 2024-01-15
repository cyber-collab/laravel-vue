import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from "vue";
import router from '@/router/index.js'
import CompaniesIndex from '@/components/companies/CompaniesIndex.vue'
import EmployeesIndex from '@/components/employees/EmployeesIndex.vue'

createApp({
    components: {
        CompaniesIndex,
        EmployeesIndex
    }
}).use(router).mount('#app')
