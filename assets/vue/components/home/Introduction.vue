<template>
    <div class="row">
        <div class="col-12 col-lg-6">
            <h1 class="text-white">All Your Tags On One Page</h1>
            <h2 class="text-white mb-4">Google Tag Manager Documentation</h2>

            <ul class="list-unstyled u-size-xs text-white">
                <li v-for="(feature, index) in features" :key="index" class="mb-3" data-aos="fade-right" data-aos-duration="1500" :data-aos-delay="300*index">
                    <icon class="text-success u-size-sm-md mr-2" name="tick" /> {{ feature }}
                </li>
            </ul>

            <b-button size="lg" variant="primary" block class="mt-5" href="#start">START</b-button>

            <div class="text-white u-size-default my-5 text-center text-left@lg">
                <p>GTM Doc is a utility created for Google's Tag Manager.<br>This tool is designed, created, managed, and owned by <a href="https://nick-hat-boecker.de/" target="_blank" class="text-carrot">Nick Böcker</a>.</p>
            </div>
        </div>
        <div class="col-12 col-lg-6 text-center text-right@lg" data-aos="zoom-in" data-aos-duration="1500">
            <img src="/img/mockup.png" height="auto" width="80%" alt="" title="" />
        </div>
    </div>
</template>

<script>
import Icon from "../base/Icon"

export default {
    components: { Icon },

    data () {
        return {
            features: [
                'Simple and clean view of all your tags',
                'Define custom titles and descriptions',
                'Simply login with your Google account',
                'Open Source & free',
            ],
        }
    },
}
</script>

<style lang="scss" scoped>
    h2 {
        font-weight: 300;
    }
</style>
