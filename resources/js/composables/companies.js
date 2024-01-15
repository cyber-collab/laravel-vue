import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useCompanies() {
    const companies = ref([])
    const company = ref([])
    const router = useRouter()
    const errors = ref('')

    const getCompanies = async () => {
        let response = await axios.get('/api/companies')
        companies.value = response.data.data;
    }

    const getCompany = async (id) => {
        let response = await axios.get('/api/companies/' + id)
        company.value = response.data.data;
    }

    const storeCompany = async (data) => {
        const formData = new FormData();
        Object.keys(data).forEach(key => {
            if (key === 'logo' && data[key] instanceof File) {
                formData.append(key, data[key]);
            } else {
                formData.append(key, data[key]);
            }
        });
        try {
            await axios.post('/api/companies', formData);
            await router.push({name: 'companies.index'})

        } catch (error) {
            if (error.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateCompany = async (id) => {
        errors.value = '';

        try {
            const formData = new FormData();
            Object.keys(company.value).forEach(key => {
                if (key === 'logo' && company.value[key] instanceof File) {
                    formData.append('logo', company.value.logo);
                } else {
                    formData.append(key, company.value[key]);
                }
            });

            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            };

            await axios.post(`/api/companies/${id}?_method=PUT`, formData, config);
            await router.push({ name: 'companies.index' });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };


    const destroyCompany = async (id) => {
        await axios.delete('/api/companies/' + id)
    }

    return {
        companies,
        company,
        errors,
        getCompanies,
        getCompany,
        storeCompany,
        updateCompany,
        destroyCompany
    }
}
