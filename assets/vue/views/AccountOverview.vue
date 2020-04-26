<template>
    <b-container>
        <h1 class="text-white">You're authorized!</h1>
        <h2 class="text-white mb-5">Choose a container to inspect its tags</h2>

        <b-card v-for="(account, accountIndex) in accounts" :key="`account-${accountIndex}`" class="bg-primary text-white text-left mb-4">
            <b-card-text>
                <h3 class="mb-4 h4">
                    <Icon name="device-desktop" class="mr-2" /> {{ account.name }}
                </h3>
                <ul class="list-unstyled">
                    <li
                        v-for="(container, containerIndex) in account.containers"
                        :key="`container-${accountIndex}-${containerIndex}`"
                        class="mb-2"
                    >
                        <Icon name="folder-open" class="mr-1" />
                        <router-link :to="{ name: 'tags', params: { accountId: account.id, containerId: container.id } }" class="text-white">
                            {{ container.name }}
                        </router-link>
                    </li>
                </ul>
            </b-card-text>
        </b-card>
    </b-container>
</template>

<script>
import Icon from "~/components/base/Icon"


export default {
    components: { Icon },

    computed: {
        accounts () {
            return this.$store.getters.accounts
        },
    },

    mounted () {
        if (!this.accounts.length) {
            this.$store.dispatch('loadAccounts')
        }
    },
}
</script>

<style lang="scss" scoped>
</style>
