<template>
    <div>
        <Header />
        <alert />
        <div class="mt-5">
            <loading-spinner />
            <router-view :key="$route.fullPath" />

            <p class="pt-5 text-center text-white"><small>Nick Hat Böcker &copy; 2020</small></p>
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
