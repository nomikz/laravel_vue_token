<template>
    <div class="home">
        <template
            v-if="user"
        >
            {{user.name}}
            <br>
            {{user.email}}
        </template>
    </div>
</template>

<script>
// @ is an alias to /src @/components
import User from './../apis/User'

export default {


    name: 'Home',
    components: {},
    data() {
        return {
            user: null,
        }
    },
    mounted() {
        User.auth().then((response) => {
            this.user = response.data;
        });
    },
    methods: {

    }
}
</script>
