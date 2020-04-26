<template>
    <b-container>
        <introduction />
        <how-to />
        <left-right />
        <start />
    </b-container>
</template>

<script>
import HowTo from "../components/home/HowTo";
import Introduction from "../components/home/Introduction";
import LeftRight from "../components/home/LeftRight";
import Start from "../components/home/Start";


export default {
    components: { HowTo, Introduction, LeftRight, Start },

    created () {
        if (this.$route.query.accessToken) {
            this.$router.push({ name: 'authorize', params: { accessToken: this.$route.query.accessToken }})
        }
    },
}
</script>

<style lang="scss" scoped>
    .meta {
        font-size: 1rem;
        font-weight: 400;
    }
</style>
