<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="bg-red-400 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>

    <form class="space-y-6" v-on:submit.prevent="saveDeal">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="deal_name" class="block text-sm font-medium text-gray-700">Account Name</label>
                <div class="mt-1">
                    <input type="text" name="deal_name" id="deal_name"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="deal.deal_name">
                </div>
            </div>

            <div>
                <label for="closing_date" class="block text-sm font-medium text-gray-700">Closing Date</label>
                <div class="mt-1">
                    <input type="date" name="closing_date" id="closing_date"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="deal.closing_date">
                </div>
            </div>

            <div>
                <label for="account_id" class="block text-sm font-medium text-gray-700">Account</label>
                <div class="mt-1">
                    <select v-model="deal.account_id"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="" disabled>Select account</option>
                        <option v-for="(accountName, accountId) in accounts" :key="accountId" :value="accountId">
                            {{ accountName }}
                        </option>
                    </select>
                </div>
            </div>

            <div>
                <label for="stage" class="block text-sm font-medium text-gray-700">Stage</label>
                <div class="mt-1">
                    <input type="text" name="stage" id="stage"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="deal.stage">
                </div>
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Save
        </button>
    </form>
</template>

<script setup>
import useDeals from "@/composables/deals";
import { onMounted } from "vue";

const { errors, deal, getDeal, accounts, updateDeal } = useDeals()
const props = defineProps({
    id: {
        required: true,
        type: String
    }
})

onMounted(getDeal(props.id))

const saveDeal = async () => {
    await updateDeal(props.id)
}
</script>
