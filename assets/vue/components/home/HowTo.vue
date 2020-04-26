<template>
    <div class="text-center mt-6">
        <h2 class="text-white u-size-md">How To Use The App</h2>
        <p class="mb-5 text-carrot u-strong u-size-xs">Ready In Three Easy Steps</p>

        <b-card-group deck class="mb-3">
            <b-card
                v-for="(item, index) in items"
                :key="index"
                class="card-w100 text-left bg-primary text-white"
                data-aos="zoom-in"
                data-aos-duration="1500"
                :data-aos-delay="300*index"
            >
                <b-card-text>
                    <p class="mb-0 u-strong c-dateline">
                        {{ item.dateline }}
                    </p>
                    <h3 class="mb-4 h4">{{ item.title }}</h3>
                    <span class="u-size-xs text-justify">{{ item.text }}</span>
                </b-card-text>
            </b-card>
        </b-card-group>

        <b-button href="#start" variant="primary" block size="lg" class="pt-3 pb-3 text-carrot">Try It Now</b-button>
    </div>
</template>

<script>
export default {
    data () {
        return {
            items: [
                { dateline: 'Step 1', title: 'Log in via Google', text: 'Authorize with your google account and accept the required permissions.' },
                { dateline: 'Step 2', title: 'Choose your container', text: 'From the accounts list, choose the container you want to inspect.' },
                { dateline: 'Step 3', title: 'Add information', text: 'Add custom titles and description to tags and view them in the app.' },
            ],
        }
    },
}
</script>

<style lang="scss" scoped>
    .u-strong {
        font-weight: 500;
    }

    .c-info {
        top: 0;
        right: 0;
    }

    .c-dateline {
        color: lighten(#293a80, 40%);
    }
</style>
