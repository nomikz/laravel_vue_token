<template>
    <div class="register">
        <div id="form">
            <v-card
                class="mx-auto  mt-15 pa-5"
                max-width="420"
            >
                <v-card-text
                    class="text-center"
                >
                    <p class="display-1 text--primary">
                        Зарегистрироваться
                    </p>
                    <v-form
                        ref="form"
                        lazy-validation
                    >
                        <v-text-field
                            v-model="form.name"
                            label="Имя"
                            :rules="rules.name"
                            required
                        ></v-text-field>

                        <v-text-field
                            v-model="form.email"
                            label="E-mail"
                            :rules="rules.email"
                            required
                        ></v-text-field>

                        <v-text-field
                            v-model="form.password"
                            label="Пароль"
                            required
                            :rules="rules.password"
                            type="password"
                        ></v-text-field>

                        <v-btn
                            @click.prevent="register"
                            class="primary mt-2"
                        >
                            Зарегистрироваться
                        </v-btn>
                    </v-form>
                </v-card-text>
            </v-card>
        </div>
    </div>
</template>

<script>
import User from '../../apis/User';

export default {
    data () {
        return {
            form: {
                name: '',
                email: '',
                password: '',
            },
            rules: {
                name: [
                    v => !!v || 'Заполните имя',
                    v => v.length > 5 || 'Имя слишком короткое',
                ],
                email: [
                    v => !!v || 'Заполните e-mail',
                    v => /.+@.+/.test(v) || 'E-mail должен содержать "@"',
                    v => v.length > 5 || 'E-mail слишком короткое',
                ],
                password: [
                    v => !!v || 'Слишком короткий пароль',
                    v => v.length > 8 || 'Пароль слишком короткое',
                ]
            },
        }
    },
    methods: {
        register() {
            if(!this.$refs.form.validate()) {
                return;
            }

            User.register(this.form)
                .then(() => {
                    this.$router.push({ name: "login" });
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.$store.dispatch(
                            'setNotification',
                            {
                                isVisible: true,
                                text: 'Проверьте что вы правильно заполнили форму 😭😭',
                                color: 'orange'
                            }
                        );
                    }
                });
        }
    }
}
</script>
