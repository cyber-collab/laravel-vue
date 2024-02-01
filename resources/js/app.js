import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from "vue";
import router from '@/router/index.js'
import CompaniesIndex from '@/components/companies/CompaniesIndex.vue'
import EmployeesIndex from '@/components/employees/EmployeesIndex.vue'
import AccountsIndex from '@/components/accounts/AccountsIndex.vue'
import DealsIndex from '@/components/deals/DealsIndex.vue'

createApp({
    components: {
        CompaniesIndex,
        EmployeesIndex,
        AccountsIndex,
        DealsIndex,
    }
}).use(router).mount('#app')
