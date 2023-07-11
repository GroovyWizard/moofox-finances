<template>
    <h3> New Item</h3>
    <FinanceForm />
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
    }

}

</script>

<style>

</style>