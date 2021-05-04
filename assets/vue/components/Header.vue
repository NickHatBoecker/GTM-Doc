<template>
    <b-navbar
        toggleable="lg"
        type="dark"
        class="bg-primary"
        sticky
    >
        <b-navbar-brand to="/">GTM Doc</b-navbar-brand>
        <b-navbar-toggle target="nav-collapse" />

        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav class="mr-auto">
                <b-nav-item v-if="$store.getters.isAuthenticated" :to="{ name: 'accounts' }">Choose container</b-nav-item>
                <b-nav-item :to="{ name: 'howto' }">How to</b-nav-item>
                <b-nav-item :to="{ name: 'data-privacy' }">Privacy Policy</b-nav-item>
            </b-navbar-nav>
            <b-navbar-nav class="ml-auto">
                <b-nav-item v-if="$store.getters.isAuthenticated" @click="logout">Revoke access</b-nav-item>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>
export default {
    methods: {
        logout () {
            this.$store.dispatch('revokeAccessToken')
        },
    },
}
</script>

<style lang="scss">
    .dropdown-menu {
        background-color: #007bff;
        min-width: 13rem;
    }

    .dropdown-item {
        color: #fff;
    }

    .dropdown-item:hover {
        color: #fff;
        background-color: #005fc5;
    }
</style>
