import { createRouter, createWebHistory } from "vue-router";
//path for user
import AccountsIndex from '@/components/accounts/AccountsIndex.vue'
import AccountsCreate from '@/components/accounts/AccountsCreate.vue'
import AccountsEdit from '@/components/accounts/AccountsEdit.vue'

// //path for employees
// import EmployeesIndex from '@/components/employees/EmployeesIndex.vue'
// import EmployeesCreate from '@/components/employees/EmployeesCreate.vue'
// import EmployeesEdit from '@/components/employees/EmployeesEdit.vue'

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

    // {
    //     path: '/employees',
    //     name: 'employees.index',
    //     component: EmployeesIndex
    // },
    // {
    //     path: '/employees/create',
    //     name: 'employees.create',
    //     component: EmployeesCreate
    // },
    // {
    //     path: '/employees/:id/edit',
    //     name: 'employees.edit',
    //     component: EmployeesEdit,
    //     props: true
    // }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
