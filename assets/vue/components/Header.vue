<template>
    <b-navbar
        toggleable="lg"
        type="dark"
        class="bg-primary"
    >
        <b-navbar-brand to="/">GTM Doc</b-navbar-brand>
        <b-navbar-toggle target="nav-collapse" />

        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav class="mr-auto">
                <b-nav-item-dropdown v-if="$store.getters.isAuthenticated">
                    <template v-slot:button-content>
                        <em class="text-white">Accounts</em>
                    </template>
                    <!-- eslint-disable-next-line vue/no-use-v-if-with-v-for -->
                    <template v-if="accounts.length" v-for="(account, index) in accounts">
                        <span :key="`account-${index}`" class="text-white pl-3 pr-3">{{ account.name }}</span>
                        <b-dropdown-item
                            v-for="(container, containerIndex) in account.containers" :key="`account-${index}-container-${containerIndex}`"
                            :to="{ name: 'tags', params: { accountId: account.id, containerId: container.id }}"
                            class="ml-2"
                        >
                            ➤ {{ container.name }}
                        </b-dropdown-item>
                    </template>
                </b-nav-item-dropdown>

                <b-nav-item v-if="$store.getters.isAuthenticated" @click="logout">Revoke access</b-nav-item>
                <b-nav-item to="/data-privacy">Privacy Policy</b-nav-item>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>
export default {
    computed: {
        accounts () {
            return this.$store.getters.accounts
        },
    },

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
