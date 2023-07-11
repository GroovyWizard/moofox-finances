<template>
  <v-app-bar flat>
    <v-app-bar-title>
      <v-icon class="site-icon" />
      {{ SITE_NAME }}
    </v-app-bar-title>
  </v-app-bar>
</template>

<script setup>
import { SITE_NAME } from '@/configs/global-config';
</script>

<style>
.site-icon {
  background-image: url('../../assets/logo.png');
  background-size: cover;
  width: 24px;
  height: 24px;
}
</style>
