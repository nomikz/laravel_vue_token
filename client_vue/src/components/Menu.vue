<template>
    <div>
        <v-app-bar
            app
            color="white"
        >
            <v-container class="py-0 fill-height">
                <div class="d-flex align-center">
                    <v-img
                        alt="logo"
                        class="mr-4"
                        contain
                        src="https://ffins.kz/static/img/general/logo.svg"
                        transition="scale-transition"
                        width="100"
                    />
                    |
                    <span class="ml-4">Insurance</span>
                </div>

                <v-spacer></v-spacer>

                <template
                    v-if="isLoggedIn"
                >
                    <v-btn
                        to="/"
                        text
                    >
                        <span class="mr-2">Полисы</span>
                        <v-icon>mdi-login</v-icon>
                    </v-btn>

                    <v-btn
                        href="#"
                        @click="logout"
                        text
                    >
                        <span class="mr-2">Выйти</span>
                        <v-icon>mdi-login</v-icon>
                    </v-btn>
                </template>

                <template v-else>
                    <v-btn
                        to="/login"
                        text
                    >
                        <span class="mr-2">Войти</span>
                        <v-icon>mdi-login</v-icon>
                    </v-btn>

                    <v-btn
                        to="/register"
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

export default {
    data() {
        return {
            isLoggedIn: false
        }
    },
    mounted() {
        this.isLoggedIn = !! localStorage.getItem("token");
    },
    methods: {
        logout() {
            localStorage.removeItem("token");
            this.$router.push({ "name": 'Login'});
        }
    },
}
</script>
