<template>
    <v-app>
        <MainMenu />

        <v-main class="grey lighten-3">
            <v-container>
                <transition
                    name="fade"
                    mode="out-in"
                >
                    <router-view />
                </transition>
            </v-container>
        </v-main>

        <NotificationSnackbar
            :isVisible="notification.isVisible"
            :text="notification.text"
            :color="notification.color"
        ></NotificationSnackbar>
    </v-app>
</template>

<script>
import MainMenu from '@/components/MainMenu';
import NotificationSnackbar from '@/components/NotificationSnackbar'
import { mapState } from 'vuex';

export default {
    data() {
        return {
        }
    },
    components: {
        MainMenu,
        NotificationSnackbar,
    },
    computed: {
        ...mapState(['notification']),
    }
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition-duration: 0.3s;
    transition-property: opacity;
    transition-timing-function: ease;
}

.fade-enter,
.fade-leave-active {
    opacity: 0
}
</style>
