<template>
  <v-app>
    <v-layout>
      <v-app-bar color="" >
        <template v-slot:image >
          <v-img class="gradient" ></v-img>

        </template>

        <template v-slot:prepend >
            <v-icon class="site-icon pa-5" >
              <img style="height: 60px; width: 60px;" src="../../assets/logo.png" />
            </v-icon>
        </template>

        <v-app-bar-title>{{ SITE_NAME }}</v-app-bar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
          <v-icon>mdi-chart-line</v-icon>
        </v-btn>

        <v-btn icon>
          <v-icon>mdi-calendar-month</v-icon>
        </v-btn>

        <v-btn icon @click="openGithubUrl()">
          <v-icon>mdi-github</v-icon>
        </v-btn>
      </v-app-bar>

      <v-main class="main-wrapper">
        <router-view />
      </v-main>

    </v-layout>


  </v-app>
</template>

<script>
import { SITE_NAME, GITHUB_URL } from '@/configs/global-config';
export default {
  methods: {
     openGithubUrl() {
      window.open(this.GITHUB_URL, '_blank');
    }
  },
  data() {
    return {
      GITHUB_URL: GITHUB_URL,
      SITE_NAME: SITE_NAME,
    };
  }
}
</script>

<style>
.gradient {
 background: rgb(120,105,156);
  background: linear-gradient(90deg, rgba(120,105,156,1) 8%, rgba(58,187,191,1) 57%, rgba(238,148,82,1) 100%); 
}
</style>