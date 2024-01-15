import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useEmployees() {
    const employees = ref([])
    const employee = ref([])
    const router = useRouter()
    const errors = ref('')

    const getEmployees = async () => {
        let response = await axios.get('/api/employees')
        employees.value = response.data.data;
    }

    const getEmployee = async (id) => {
        let response = await axios.get('/api/employees/' + id)
        employee.value = response.data.data;
    }

    const storeEmployee = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/employees/', data)
            await router.push({name: 'employees.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

        const updateEmployee = async (id) => {
        errors.value = ''
        try {
            await axios.put('/api/employees/' + id, employee.value)
            await router.push({name: 'Employees.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyEmployee = async (id) => {
        await axios.delete('/api/employees/' + id)
    }


    return {
        employees,
        employee,
        errors,
        getEmployees,
        getEmployee,
        storeEmployee,
        updateEmployee,
        destroyEmployee
    }
}
