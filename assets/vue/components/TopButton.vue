<template>
    <b-button
        class="c-top-button"
        variant="primary"
        size="lg"
        title="To Top"
        pill
        v-show="isVisible"
        :href="target"
    >⇧</b-button>
</template>

<script>
export default {
    data () {
        return {
            isVisible: false,
            target: '#top',
        }
    },

    computed: {
        windowIsScrollingToTop () {
            return this.$store.state.windowIsScrollingToTop
        },
    },

    watch: {
        windowIsScrollingToTop (newVal, oldVal) {
            if (!newVal && oldVal) {
                // when window scrolling to top has finished -> update the hash for further keyboard navigation
                window.location.hash = this.target
            }
        },
    },

    mounted () {
        window.addEventListener('scroll', this.handleScroll)
    },

    destroyed () {
        window.removeEventListener('scroll', this.handleScroll)
    },

    methods: {
        handleScroll () {
            const scrollPositionToShow = 100
            this.isVisible = (window.pageYOffset > scrollPositionToShow)
        },
    },
}
</script>

<style lang="scss" scoped>
    $position: 24px;

    .c-top-button {
        position: fixed;
        right: $position;
        bottom: $position;
    }
</style>
