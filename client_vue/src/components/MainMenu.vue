<template>
    <div>
        <v-app-bar
            app
            color="white"
        >
            <v-container class="py-0 fill-height">
                <router-link
                    :to="{ name: 'policyList'}"
                    style="text-decoration: none;"
                >
                    <div
                        class="d-flex align-center black--text"
                    >
                        <v-img
                            alt="logo"
                            class="mr-4"
                            contain
                            transition="scale-transition"
                            src="https://ffins.kz/static/img/general/logo.svg"
                            width="100"
                        />
                        |
                        <span class="ml-4">Insurance</span>
                    </div>
                </router-link>


                <v-spacer></v-spacer>

                <template
                    v-if="authUser"
                >
                    <v-btn
                        class="mr-2"
                        :to="{ name: 'policyList'}"
                        dark
                        color="orange"
                    >
                        <span class="mr-2">Полисы</span>
                        <v-icon>mdi-format-list-bulleted</v-icon>
                    </v-btn>

                    <v-btn
                        href="#"
                        @click="logout"
                        text
                    >
                        <span class="mr-2">Выйти</span>
                        <v-icon>mdi-logout</v-icon>
                    </v-btn>
                </template>

                <template v-else>
                    <v-btn
                        class="mr-3 primary"
                        :to="{ name: 'login'}"
                        color="primary"
                    >
                        <span class="mr-2">Войти</span>
                        <v-icon>mdi-login</v-icon>
                    </v-btn>

                    <v-btn
                        :to="{ name: 'register'}"
                        text
                    >
                        <span class="mr-2">Зарегистрироваться</span>
                        <v-icon>mdi-account-plus-outline</v-icon>
                    </v-btn>
                </template>
            </v-container>
        </v-app-bar>
    </div>
</template>

<script>
import { mapState } from 'vuex';
import User from "@/apis/User";

export default {
    data() {
        return {
        }
    },
    mounted() {
    },
    methods: {
        logout() {
            User.logout().then(() => {
                localStorage.removeItem("token");
                this.$store.dispatch('logout');
                this.$router.push({ 'name': 'login'});
            });
        }
    },
    computed: {
        ...mapState(['authUser']),
    }
}
</script>
