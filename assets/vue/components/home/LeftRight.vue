<template>
    <div class="mt-6">
        <div class="row mb-6" data-aos="fade-right" data-aos-duration="1500">
            <div class="col-12 col-md-6">
                <h2 class="text-white u-size-md mb-4"><icon name="lock-closed" class="u-size-lg" /> Privacy First</h2>
                <p class="text-white u-size-xs mb-4">GTM Doc does not save any personal data. The access token, to access your Tag Manager data from Google, is saved in your browser via LocalStorage.</p>
                <router-link :to="{ name: 'data-privacy' }" class="text-carrot u-strong u-size-xs d-block mb-5">
                    <icon name="arrow-right-thick" />
                    Check out the privacy policy
                </router-link>
            </div>
            <div class="col-12 col-md-6 text-center text-white">
                <img src="/img/security.png" width="70%" height="auto" alt="" title="">
                <p class="font-italic u-size-xxs u-opacity-50 mt-2">&copy; Design vector created by freepik - <a href="https://www.freepik.com/free-photos-vectors/design" target="_blank" class="text-white u-underlined">www.freepik.com</a></p>
            </div>
        </div>

        <div class="row mb-6" data-aos="fade-left" data-aos-duration="1500">
            <div class="col-12 col-md-6 order-md-7">
                <h2 class="text-white u-size-md mb-4"><icon name="social-github" class="u-size-lg" /> Open Source</h2>
                <p class="text-white u-size-xs mb-4">You like open software? I do! If you have any trouble, if you find a bug or want to contribute – feel free to get in touch on GitHub.</p>
                <a href="https://github.com/NickHatBoecker/GTM-Doc" target="_blank" class="text-carrot u-strong u-size-xs d-block mb-5">
                    <icon name="arrow-right-thick" />
                    Check out the GitHub Repository
                </a>
            </div>
            <div class="col-12 col-md-6 order-md-1 text-white">
                <img src="/img/opensource.png" width="90%" height="auto" alt="" title="">
                <p class="font-italic u-size-xxs u-opacity-50 mt-2">&copy; Design vector created by freepik - <a href="https://www.freepik.com/free-photos-vectors/design" target="_blank" class="text-white u-underlined">www.freepik.com</a></p>
            </div>
        </div>
    </div>
</template>

<script>
import Icon from "~/components/base/Icon";


export default {
    components: { Icon },
}
</script>

<style lang="scss" scoped>
    .u-opacity-50 {
        opacity: 50%;
    }

    .u-underlined {
        text-decoration: underline;
    }
</style>
