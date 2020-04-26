<template>
    <div id="start" class="bg-primary p-5 text-center mt-6" data-aos="zoom-in" data-aos-duration="1500">
        <h2 class="text-white u-size-md mb-4">Let's start</h2>
        <p class="mb-5 text-white u-strong u-size-xs">Please take the time to read the <router-link :to="{ name: 'data-privacy' }" class="text-carrot">Privacy Policy and Terms of Service</router-link>.<br>Once you click Proceed, you will be asked to authorize GTM Doc to use your Google Tag Manager data.</p>

        <b-button variant="carrot" size="lg" href="/api/connect/google" block>PROCEED</b-button>
    </div>
</template>

<script>
export default {
}
</script>

<style lang="scss" scoped>
</style>
