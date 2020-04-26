<template>
    <b-container>
        <div id="top" class="bg-primary text-white p-3 mb-4">
            <router-link :to="{ name: 'home' }" class="text-white">Home</router-link> <icon name="chevron-right" />
            <router-link v-if="currentAccount" :to="{ name: 'accounts' }" class="text-white">{{ currentAccount.name }} <icon name="chevron-right" /></router-link>
            <template v-if="currentContainer">{{ currentContainer.name }}</template>
        </div>

        <tag
            v-for="(tag, index) in tags"
            :key="`tag-${index}`"
            class="mb-4"
            v-bind="tag"
        />

        <top-button />
    </b-container>
</template>

<script>
import Icon from '../components/base/Icon'
import Tag from '../components/Tag'
import TopButton from '../components/TopButton'

export default {
    components: { Icon, Tag, TopButton },

    props: {
        accountId: { type: String, required: true },
        containerId: { type: String, required: true },
    },

    computed: {
        tags () {
            return this.$store.getters.tags
        },


        currentAccount () {
            return this.$store.getters.accounts.find(x => x.id === this.accountId)
        },

        currentContainer () {
            return this.currentAccount.containers.find(x => x.id === this.containerId)
        },
    },

    mounted () {
        if (this.$store.getters.currentContainer !== this.containerId) {
            this.$store.dispatch('loadTags', {accountId: this.accountId, containerId: this.containerId})
        }

        this.$store.commit('setCurrentContainer', this.containerId)
    },
}
</script>
