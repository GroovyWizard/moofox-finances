<template>
    <v-container class="fill-height">
        <v-responsive class="align-center text-center fill-height">
            <v-row>
                <v-col cols="12" class="text-end">
                    <v-btn @click="toggleEditMode" density="default" icon="mdi-table-eye"></v-btn>
                </v-col>
            </v-row>
            <MonthlyTable v-if="editMode == false" />

            <FinancesManager v-if="editMode == true" />
            <v-row class="mt-2">
                <v-col cols="12">
                    <v-btn icon="mdi-plus" color="primary">
                    </v-btn>
                </v-col>
            </v-row>
        </v-responsive>
    </v-container>
</template>

<script>
import FinancesManager from "@/components/FinancesManager.vue"
import MonthlyTable from "@/components/MonthlyTable.vue";
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
        }
    }
}
</script>

<style></style>