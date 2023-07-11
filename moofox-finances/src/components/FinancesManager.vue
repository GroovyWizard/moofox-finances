<template>
    <h3> New Item</h3>
    <div v-for="count in formCount">
        {{ count }}
        <FinanceForm :financeForm="financeList[0]" />
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
            formCount: 1,
           
        };
    },
    methods: {
        addNewForm() {
            const defaultFormStructure = {
                    id: crypto.randomUUID(),
                    name: "",
                    value: 0,
                    payTo: "",
                    dueDate: "",
            };
            this.financeList.push(defaultFormStructure);
            this.formCount++;
            console.log(this.financeList)
        }
    }

}

</script>

<style></style>