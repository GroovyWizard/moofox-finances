<template>
  <v-container class="mx-auto text-center">
    <v-row class="pa-5">
      <v-col cols=12>
          <p class="pick-hint">
            Pick a month from the calendar below:
          </p>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <img src="../assets/lottie/animation_lm48yiia_small.gif">
      </v-col>
    </v-row>

    <v-row class="date-picker text-center mx-auto">
      <v-col cols="12" class="">
        <VueDatePicker v-model="selectedMonth" :month-picker="true" ></VueDatePicker>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <v-btn :disabled="!isValidMonth" color="success" @click="redirectToMonthTableEditor()"> Continue </v-btn>
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
  watch: {
    selectedMonth(value) {
      if(!value) {
        this.isValidMonth = false;
      } else {
        this.isValidMonth = true;
      }
    }
  },
  methods: {
    redirectToMonthTableEditor() {
      this.$router.push({ name: 'finances', params: { month: (this.selectedMonth.month + 1), year: this.selectedMonth.year } });
    },
  },
  data() {
    return {
      isValidMonth: true,
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

.pick-hint {
  font-size: large;
}
</style>
