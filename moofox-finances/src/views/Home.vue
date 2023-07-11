<template>

  <v-container class="fill-height">
    <v-responsive class="align-center text-center fill-height">
      <Header />
      <MonthPicker />
    </v-responsive>
  </v-container>

</template>

<script setup>
  import MonthPicker from '@/components/MonthPicker.vue';
  import Header from "@/components/Header.vue"
</script>
