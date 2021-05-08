<template>
    <b-container>
        <div id="top" class="bg-primary text-white p-3 mb-4">
            <router-link :to="{ name: 'home' }" class="text-white">Home</router-link> <icon name="chevron-right" />
            <router-link v-if="currentAccount" :to="{ name: 'accounts' }" class="text-white">{{ currentAccount.name }} <icon name="chevron-right" /></router-link>
            <template v-if="currentContainer">{{ currentContainer.name }}</template>
        </div>

        <div class="mb-4">
            <input
                v-model="searchTerm"
                type="text"
                class="form-control search"
                placeholder="Search..."
            />
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

    data: () => ({ searchTerm: null }),

    computed: {
        tags () {
            const tags = this.$store.getters.tags
            if (!this.searchTerm) {
                return tags
            }

            return tags.filter(tag => {
                return !! (
                    tag.name && tag.name.includes(this.searchTerm) ||
                    tag.originalName && tag.originalName.includes(this.searchTerm) ||
                    tag.description && tag.description.includes(this.searchTerm) ||
                    tag.eventCategory && tag.eventCategory.includes(this.searchTerm) ||
                    tag.eventAction && tag.eventAction.includes(this.searchTerm) ||
                    tag.eventLabel && tag.eventLabel.includes(this.searchTerm)
                )
            })
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

<style lang="scss" scoped>
    .search {
        border-radius: 0;
    }
</style>
