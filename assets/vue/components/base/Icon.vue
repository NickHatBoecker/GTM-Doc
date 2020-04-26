<template>
    <span :class="`typcn typcn-${name}`"></span>
</template>

<script>
export default {
    props: {
        name: { type: String, required: true },
    },
}
</script>

<style lang="scss" scoped>
</style>
