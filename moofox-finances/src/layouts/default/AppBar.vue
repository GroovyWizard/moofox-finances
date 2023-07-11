<template>
  <v-app-bar flat>
    <v-app-bar-title  @click="redirectToHome()">
      <v-icon class="site-icon" />
      {{ SITE_NAME }}
    </v-app-bar-title>
  </v-app-bar>
</template>

<script>
import { SITE_NAME } from '@/configs/global-config';

export default {
  data() {
    return {
      SITE_NAME: SITE_NAME,
    };
  },
  methods: {
    redirectToHome() {
      this.$router.push({ name: 'Home' });
    }
  },
}
</script>

<style>
.site-icon {
  background-image: url('../../assets/logo.png');
  background-size: cover;
  width: 24px;
  height: 24px;
}
</style>
