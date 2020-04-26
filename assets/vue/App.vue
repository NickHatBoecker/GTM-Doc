<template>
    <div>
        <Header />
        <Alert />
        <div class="mt-5">
            <LoadingSpinner />
            <router-view class="mb-5" />
        </div>
    </div>
</template>

<script>
import Alert from './components/Alert'
import Header from './components/Header'
import LoadingSpinner from './components/LoadingSpinner'


export default {
    name: 'App',

    components: { Alert, Header, LoadingSpinner },
}
</script>

<style lang="scss">
    .text-decoration-underline {
        text-decoration: underline;
    }

    .u-borderless {
        border: none;
    }
</style>
