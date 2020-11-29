<template>
    <div>
        <MainLayout />
    </div>
</template>

<script>
import MainLayout from './views/Layouts/Main'

export default {
    name: 'App',
    components: {
        MainLayout,
    },
    mounted() {
        this.$store.dispatch('setAuthUser');
    },
    data: () => ({
        //
    }),
};
</script>
