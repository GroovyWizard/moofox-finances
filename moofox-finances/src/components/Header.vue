<template>
    <v-row>
        <v-col>
            {{ siteName }}
        </v-col>
    </v-row>
    <v-row>
        <v-col>
            <img src="../assets/logo.png">
        </v-col>
    </v-row>
</template>

<script>
import { SITE_NAME } from "@/configs/global-config.js";

export default {
    data() {
        return {
            siteName: SITE_NAME
        };
    }
}
</script>

<style scoped></style>