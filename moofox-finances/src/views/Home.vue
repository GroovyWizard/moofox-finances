<template>
  <v-container class="fill-height">
    <v-responsive class="align-center text-center fill-height">
        <MonthPicker />
    </v-responsive>
  </v-container>
</template>

<script>
import MonthPicker from '@/components/MonthPicker.vue';
export default {
    data() {
        return {};
    },
    components: { MonthPicker }
}

</script>

<style>
.main-container {
  background-color: white !important;
}
</style>
