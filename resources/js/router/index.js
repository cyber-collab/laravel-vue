import { createRouter, createWebHistory } from "vue-router";
//path for user
import AccountsIndex from '@/components/accounts/AccountsIndex.vue'
import AccountsCreate from '@/components/accounts/AccountsCreate.vue'
import AccountsEdit from '@/components/accounts/AccountsEdit.vue'

//path for deals
import DealsIndex from '@/components/deals/DealsIndex.vue'
import DealsCreate from '@/components/deals/DealsCreate.vue'
import DealsEdit from '@/components/deals/DealsEdit.vue'

const routes = [
    {
        path: '/dashboard',
        name: 'accounts.index',
        component: AccountsIndex
    },
    {
        path: '/dashboard/create',
        name: 'accounts.create',
        component: AccountsCreate
    },
    {
        path: '/dashboard/:id/edit',
        name: 'accounts.edit',
        component: AccountsEdit,
        props: true
    },

    {
        path: '/deals',
        name: 'deals.index',
        component: DealsIndex
    },
    {
        path: '/deals/create',
        name: 'deals.create',
        component: DealsCreate
    },
    {
        path: '/deals/:id/edit',
        name: 'deals.edit',
        component: DealsEdit,
        props: true
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
