<template>
    <v-app>
        <Menu />

        <v-main class="grey lighten-3">
            <v-container>
                <v-sheet>
                    <router-view />
                </v-sheet>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import Menu from "@/components/Menu";

export default {
    components: {
        Menu,
    }
}
</script>
