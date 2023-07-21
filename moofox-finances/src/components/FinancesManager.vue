<template>
    <h3> New Item</h3>
    <div v-for="(item, index) in financeList" :key="index">
        {{ index }}
        <v-btn @click="removeSelectedForm(item.id)" icon="mdi-delete" color="danger">
        </v-btn>
        <FinanceForm :financeForm="item" />


    </div>
    <v-row class="mt-2">
        <v-col cols="12">
            <v-btn @click="addNewForm" icon="mdi-plus" color="primary">
            </v-btn>
        </v-col>
    </v-row>
</template>

<script>
import FinanceForm from './FinanceForm.vue';
export default {
    props: {
        date: {
            type: Object,
            default: {
                month: "",
                year: ""
            },
            required: false
        },

    },
    components: {
        FinanceForm,
    },
    data() {
        return {
            financeList: [
                {
                    id: crypto.randomUUID(),
                    name: "",
                    value: 0,
                    payTo: "",
                    dueDate: "",
                }
            ],
        };
    },
    methods: {
        removeSelectedForm(formId) {
            const itemToRemove = this.financeList.findIndex(form => form.id === formId)
            if (itemToRemove !== -1) {
                this.financeList.splice(itemToRemove, 1);
            }
        },
        addNewForm() {
            const defaultFormStructure = {
                id: crypto.randomUUID(),
                name: "",
                value: 0,
                payTo: "",
                dueDate: "",
            };
            this.financeList.push(defaultFormStructure);
        }
    }

}

</script>

<style></style>