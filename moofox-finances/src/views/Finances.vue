<template>
    <v-container class="fill-height">
        <v-responsive class="align-center text-center fill-height">
            <v-row>
                <v-col cols="12" class="text-start">
                    <v-btn class="ml-2 me-2 " @click="goBack" elevation="5" density="default" icon="mdi-arrow-left">
                    </v-btn>
                    <v-btn class="me-2 text-end" @click="toggleEditMode" density="default" elevation="5"
                        icon="mdi-pencil"></v-btn>
                    <v-btn class="text-end" @click="refreshTable" elevation="5" density="default" icon="mdi-reload"></v-btn>
                </v-col>
            </v-row>

            <MonthlyTable ref="tableRef" :year="year" :month="month" v-if="editMode == false" />
            <FinancesManager ref="financesEditorRef" v-if="editMode == true" :month="month" :year="year" />
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
        goBack() {
            this.$router.push({ name: 'Home' });
        },
        toggleEditMode() {
            this.editMode = this.editMode ^ true;
        },
        refreshTable() {
            if (this.editMode == true) {

                return this.$refs.financesEditorRef.loadItems();
            }
            return this.$refs.tableRef.loadItems();
        }
    }
}
</script>

<style></style>