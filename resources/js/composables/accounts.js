import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useAccounts() {
    const accounts = ref([])
    const account = ref([])
    const router = useRouter()
    const errors = ref('')

    const getAccounts = async () => {
        let response = await axios.get('/api/accounts')
        accounts.value = response.data.data;
    }

    const getAccount = async (id) => {
        let response = await axios.get('/api/accounts/' + id)
        account.value = response.data.data;
    }

    const storeAccount = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/accounts/', data)
            await router.push({name: 'accounts.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateAccount = async (id) => {
        errors.value = ''
        try {
            await axios.put('/api/accounts/' + id, account.value)
            await router.push({name: 'accounts.index'})
            } catch (e) {
                if (e.response.status === 422) {
                    errors.value = e.response.data.errors
                }
            }
    };

    const destroyAccount = async (id) => {
        await axios.delete('/api/accounts/' + id)
    }

    return {
        accounts,
        account,
        errors,
        getAccounts,
        getAccount,
        storeAccount,
        updateAccount,
        destroyAccount
    }
}
