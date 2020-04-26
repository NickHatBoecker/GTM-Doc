<template>
    <b-container>
        <div class="bg-primary text-white p-3 mb-5">
            <router-link :to="{ name: 'home' }" class="text-white">Home</router-link> ➤
            {{ currentAccount.name }} ➤
            {{ currentContainer.name }}
        </div>

        <b-card
            v-for="(tag, index) in tags"
            :key="`tag-${index}`"
            class="mb-5 u-borderless"
            :header="tag.name"
            header-class="font-weight-bold bg-primary text-white"
            :footer="tag.originalName"
            footer-class="text-muted font-italic"
        >
            <b-card-text>
                <p class="mb-4 font-italic" v-html="tag.description" />

                <table v-if="tag.type === 'TRACK_EVENT'" class="table table-striped table-bordered table-sm">
                    <tbody>
                    <tr>
                        <th class="w-25">Eventcategory:</th>
                        <td>{{ tag.eventCategory }}</td>
                    </tr>
                    <tr>
                        <th class="w-25">Eventaction:</th>
                        <td>{{ tag.eventAction }}</td>
                    </tr>
                    <tr>
                        <th class="w-25">Eventlabel:</th>
                        <td>{{ tag.eventLabel }}</td>
                    </tr>
                    </tbody>
                </table>
            </b-card-text>
        </b-card>
    </b-container>
</template>

<script>
export default {
    props: {
        accountId: { type: String, required: true },
        containerId: { type: String, required: true },
    },

    computed: {
        tags () {
            return this.$store.getters.tags
        },


        currentAccount () {
            if (typeof this.$store.getters.accounts === 'undefined') {
                return ''
            }

            const that = this

            return this.$store.getters.accounts.find(x => x.id = that.accountId)
        },

        currentContainer () {
            if (typeof this.currentAccount.containers === 'undefined') {
                return ''
            }

            const that = this

            return this.currentAccount.containers.find(x => x.id = that.containerId)
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
    .breadcrumb-item, .breadcrumb-item a {
        color: #fff;
    }

    .card, .card-header {
        border-radius: 0;
    }
</style>
