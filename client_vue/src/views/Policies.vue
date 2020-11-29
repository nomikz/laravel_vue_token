<template>
    <div class="home">
        <InsurancePolicies />
    </div>
</template>

<script>

import User from "@/apis/User";
import Api from "@/apis/Api";
import InsurancePolicies from "@/components/InsurancePolicies";

export default {
    name: 'Home',
    data() {
        return {
            authUser: {},
        }
    },
    components: {
        InsurancePolicies,
    },
    mounted() {
        User.auth()
            .then((response) => {
                this.authUser = response.data;
            });
    },
    methods: {

    }
}
</script>
