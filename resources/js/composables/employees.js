import { onMounted, ref } from 'vue'
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
        await router.push({name: 'employees.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyEmployee = async (id) => {
        await axios.delete('/api/employees/' + id)
    }

    const companies = ref({}); // Об'єкт для збереження імен компаній

    const fetchCompanies = async () => {
        try {
            const response = await axios.get('/api/companies');
            const companiesData = response.data.data;

            // Зберігаємо імена компаній у внутрішньому стані
            companies.value = companiesData.reduce((acc, company) => {
                acc[company.id] = company.name;
                return acc;
            }, {});
        } catch (error) {
            console.error("Помилка отримання імен компаній:", error);
        }
    }

    onMounted(fetchCompanies);

    return {
        employees,
        employee,
        errors,
        getEmployees,
        getEmployee,
        storeEmployee,
        updateEmployee,
        destroyEmployee,
        companies,
    }
}
