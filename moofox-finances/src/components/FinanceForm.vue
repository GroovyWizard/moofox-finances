<template>
    <v-container class="form-container">
        <v-form class="pa-5">
            <v-row>
                <v-col cols="12" md="6" >
                    <v-text-field variant="solo" v-model="financeForm.name" label="Item name"></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                    <v-text-field  variant="solo" v-model="financeForm.value" label="Item value"></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="6">

                    <v-text-field variant="solo" v-model="financeForm.payTo" label="Who will receive the money:"></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                    <v-text-field variant="solo" v-model="financeForm.dueDate" label="Due date of this item"></v-text-field>

                </v-col>
            </v-row>
            <v-row>
                <v-col class="text-left">
                    <v-btn  type="submit" color="success" class="" @click="validate">
                        Save
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>

<script>
export default {
    props: {
        financeForm: {
            type: Object,
            required: true
        },
    }, 
    data() {
        return {
        }
    },
    methods: {

    }
}

</script>

<style>
@media (max-width: 600px) {
  .form-container{
    width: 100% !important;
  }
}
.form-container {
    width: 50%;
    background-color: rgba(231, 219, 219, 0.527)}
</style>