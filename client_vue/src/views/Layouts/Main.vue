<template>
    <v-app>
        <MainMenu />

        <v-main class="grey lighten-3">
            <v-container>
                    <router-view />
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import MainMenu from "@/components/MainMenu";

export default {
    components: {
        MainMenu,
    }
}
</script>
