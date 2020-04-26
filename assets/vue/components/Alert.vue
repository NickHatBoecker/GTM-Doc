<template>
    <b-alert :show="showAlert" variant="warning" dismissible @dismissed="onHide">
        <span v-html="message" />
    </b-alert>
</template>

<script>
export default {
    computed: {
        message () {
            return this.$store.getters.error
        },

        showAlert () {
            return !! this.message
        },
    },

    methods: {
        onHide () {
            this.$store.commit('setError', '')
        },
    },
}
</script>

<style lang="scss" scoped>
    .alert { border-radius: 0; }
</style>
