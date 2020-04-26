<template>
    <b-container class="text-center">
        <div>
            <b-jumbotron>
                <template v-slot:header>
                    <h1 class="display-4 u-uppercase">GTM DOC</h1>
                </template>
                <template v-slot:lead>
                    <p class="mt-4">GTM Doc is a utility created for Google's Tag Manager.<br>This tool is designed, created, tested, managed, and owned by Nick Böcker.</p>
                    <p class="mt-4">With GTM Doc you can view all your Google Tag Manager Tags in one page. Use the note section of each tag to put down a description and a title. With the generated overview, non-techies will know which tags are implemented right now.</p>
                    <p><router-link to="/note-section-explanation">➞ Learn how to fill the note section properly</router-link></p>

                    <img src="/img/screenshot.jpg" alt="Screenshot of GTM Doc" title="" width="80%" height="auto" />

                    <p class="mt-4 meta">
                        Please take the time to read the <router-link to="/data-privacy">Privacy Policy and Terms of Service</router-link>.<br>
                        Don't forget to take a look at the <a href="https://github.com/NickHatBoecker/GTM-Doc">GitHub Repository</a> if you run into problems.
                    </p>

                    <template v-if="!$store.getters.isAuthenticated">
                        <hr class="my-4">
                        <p class="meta">Once you click <strong>Proceed</strong>, you will be asked to authorize GTM Doc to use your Google Tag Manager data.</p>
                        <a class="btn btn-primary btn-lg u-uppercase mt-2" href="/api/connect/google" role="button">PROCEED</a>
                    </template>
                </template>
            </b-jumbotron>
        </div>
    </b-container>
</template>

<script>
export default {
    created () {
        if (this.$route.query.accessToken) {
            this.$router.push({ name: 'authorize', params: { accessToken: this.$route.query.accessToken }})
        }

        this.$store.dispatch('loadAccounts')
    },
}
</script>

<style lang="scss" scoped>
    .meta {
        font-size: 1rem;
        font-weight: 400;
    }
</style>
