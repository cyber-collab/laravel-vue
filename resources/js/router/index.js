import { createRouter, createWebHistory } from "vue-router";
//path for company
import CompaniesIndex from '@/components/companies/CompaniesIndex.vue'
import CompaniesCreate from '@/components/companies/CompaniesCreate.vue'
import CompaniesEdit from '@/components/companies/CompaniesEdit.vue'

//path for employees
import EmployeesIndex from '@/components/employees/EmployeesIndex.vue'
import EmployeesCreate from '@/components/employees/EmployeesCreate.vue'
import EmployeesEdit from '@/components/employees/EmployeesEdit.vue'

const routes = [
    {
        path: '/dashboard',
        name: 'companies.index',
        component: CompaniesIndex
    },
    {
        path: '/dashboard/create',
        name: 'companies.create',
        component: CompaniesCreate
    },
    {
        path: '/dashboard/:id/edit',
        name: 'companies.edit',
        component: CompaniesEdit,
        props: true
    },

    {
        path: '/employees',
        name: 'employees.index',
        component: EmployeesIndex
    },
    {
        path: '/employees/create',
        name: 'employees.create',
        component: EmployeesCreate
    },
    {
        path: '/employees/:id/edit',
        name: 'employees.edit',
        component: EmployeesEdit,
        props: true
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
