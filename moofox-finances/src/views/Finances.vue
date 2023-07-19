<template>
    <v-container class="fill-height">
        <v-responsive class="align-center text-center fill-height">
            <v-row class="text-end">
                <v-col cols="12">
                    <v-btn class="me-5" @click="toggleEditMode" density="default" elevation="5" icon="mdi-pencil"></v-btn>
                    <v-btn class="" @click="refreshTable" elevation="5" density="default" icon="mdi-reload"></v-btn>
                </v-col>
            </v-row>
            <MonthlyTable ref="tableRef" :year="year" :month="month" v-if="editMode == false" />

            <FinancesManager v-if="editMode == true" />
          
        </v-responsive>
    </v-container>
</template>

<script>
import FinancesManager from "@/components/FinancesManager.vue"
import MonthlyTable from "@/components/MonthlyTable.vue";
import { ref } from 'vue';
const tableRef = ref(0);
export default {
    components: {
        FinancesManager,
        MonthlyTable,
        MonthlyTable
    },
    data() {
        return {
            editMode: false,
        }
    },
    props: {
        month: {
            type: String,
            required: true
        },
        year: {
            type: String,
            required: true
        }
    },
    methods: {
        toggleEditMode() {
            this.editMode = this.editMode ^ true;
        },
        refreshTable() {
            this.$refs.tableRef.loadItems();
        }
    }
}
</script>

<style></style>