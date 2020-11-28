<template>
    <div class="register">
        <div id="form">
            <div>
                <label for='name'>
                    <input
                        id='name'
                        v-model='form.name'
                        type="text"
                    >
                    Name
                </label>
            </div>
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
                @click.prevent="register"
            >
                register
            </button>
        </div>
    </div>
</template>

<script>
import User from './../apis/User';

export default {
    data () {
        return {
            form: {
                name: '',
                email: '',
                password: '',
            }
        }
    },
    methods: {
        register() {
            User.register(this.form)
                .then(() => {
                    this.$router.push({ name: "Login" });
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        console.log(error.response.data.errors);
                    }
                });
        }
    }
}
</script>
