<template>
    <b-container class="text-white text-center p-4">Authenticating...</b-container>
</template>

<script>
export default {
    props: {
        accessToken: { type: String, required: true },
    },

    mounted () {
        this.$store.dispatch('saveAccessToken', this.accessToken)
        this.$router.push({ name: 'accounts' })
    },
}
</script>
