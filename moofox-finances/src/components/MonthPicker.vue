<template>
  <v-container>

    <v-row>
      <v-col>
        <h3>
          Select a month:
        </h3>
      </v-col>
    </v-row>

    <v-row class="date-picker text-center mx-auto">
      <v-col cols="12" class="">
        <VueDatePicker v-model="selectedMonth" :month-picker="true"></VueDatePicker>
      </v-col>

    </v-row>
    <v-row>
      <v-col cols="12">
        <v-btn color="info" @click="redirectToMonthTable()"> Continue </v-btn>
      </v-col>
    </v-row>

  </v-container>
</template>

<script>
import { ref } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
  components: { VueDatePicker },
  methods: {
    redirectToMonthTable() {
      console.log("here");

      this.$router.push({ name: 'finances', params: { month: (this.selectedMonth.month + 1), year: this.selectedMonth.year } });
    },
  },
  data() {
    return {
      selectedMonth: {
        month: new Date().getMonth(),
        year: new Date().getFullYear()
      },
    };
  },
}
</script>

<style>
@media (max-width: 600px) {
  .date-picker {
    width: 100% !important;
  }
}

.date-picker {
  width: 50%;
}
</style>
