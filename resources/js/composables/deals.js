import { onMounted, ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useDeals() {
    const deals = ref([])
    const deal = ref([])
    const router = useRouter()
    const errors = ref('')

    const getDeals = async () => {
        let response = await axios.get('/api/deals')
        deals.value = response.data.data;
    }

    const getDeal = async (id) => {
        let response = await axios.get('/api/deals/' + id)
        deal.value = response.data.data;
    }

    const storeDeal = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/deals/', data)
            await router.push({name: 'deals.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateDeal = async (id) => {
    errors.value = ''
    try {
        await axios.put('/api/deals/' + id, deal.value)
        await router.push({name: 'deals.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyDeal = async (id) => {
        await axios.delete('/api/deals/' + id)
    }

    const accounts = ref({});

    const fetchAccounts = async () => {
        try {
            const response = await axios.get('/api/accounts');
            const accountsData = response.data.data;

            accounts.value = accountsData.reduce((acc, account) => {
                acc[account.id] = account.name;
                return acc;
            }, {});
        } catch (error) {
            console.error("Not Found this Account", error);
        }
    }

    onMounted(fetchAccounts);

    return {
        deals,
        deal,
        errors,
        getDeals,
        getDeal,
        storeDeal,
        updateDeal,
        destroyDeal,
        accounts,
    }
}
