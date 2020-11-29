<template>
    <div class="login">
        <div id="form">
            <div>
                <label for='email'>
                    <input
                        id='email'
                        v-model='form.email'
                        type="text"
                    >
                    Email
                </label>
            </div>
            <div>
                <label for='password'>
                    <input
                        id='password'
                        v-model='form.password'
                        type="text"
                    >
                    Password
                </label>
            </div>
            <button
                @click.prevent="login"
            >
                Login
            </button>
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
