<template>
    <div class="login">
        <div id="form">
            <v-card
                class="mx-auto  mt-15"
                max-width="420"
            >
                <v-card-text>
                    <p class="display-1 text--primary">
                        Войти
                    </p>
                    <v-form
                        ref="form"
                        lazy-validation
                    >
                        <v-text-field
                            v-model="form.email"
                            label="E-mail"
                            required
                        ></v-text-field>

                        <v-text-field
                            v-model="form.password"
                            label="Пароль"
                            required
                            type="password"
                        ></v-text-field>

                        <v-btn
                            @click.prevent="login"
                            class="primary"
                        >
                            Войти
                        </v-btn>
                    </v-form>
                </v-card-text>
            </v-card>
        </div>
    </div>
</template>

<script>

import User from "@/apis/User";

export default {
    data() {
        return {
            form: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        login() {
            User.login(this.form).then((response) => {
                localStorage.setItem("token", response.data);
                this.$store.dispatch('setAuthUser');
                this.$router.push({ name: 'policyList' });
            });
        }
    },
    computed: {
    }
}
</script>
