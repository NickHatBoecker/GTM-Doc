<template>
    <b-card
        class="u-borderless"
        :header="name"
        header-class="font-weight-bold bg-primary text-white"
        :footer="originalName"
        footer-class="text-muted font-italic"
    >
        <b-card-text>
            <p class="mb-4 font-italic" v-html="description" />

            <table v-if="type === 'TRACK_EVENT'" class="table table-striped table-bordered table-sm">
                <tbody>
                <tr>
                    <th class="w-25">Eventcategory:</th>
                    <td>{{ eventCategory }}</td>
                </tr>
                <tr>
                    <th class="w-25">Eventaction:</th>
                    <td>{{ eventAction }}</td>
                </tr>
                <tr>
                    <th class="w-25">Eventlabel:</th>
                    <td>{{ eventLabel }}</td>
                </tr>
                </tbody>
            </table>
        </b-card-text>
    </b-card>
</template>

<script>
export default {
    props: {
        name: { type: String, required: true },
        originalName: { type: String, required: true },
        description: { type: String, required: true },
        type: { type: String, required: true },
        eventCategory: { type: String, default: '' },
        eventAction: { type: String, default: '' },
        eventLabel: { type: String, default: '' },
    },
}
</script>

<style lang="scss" scoped>
    .card, .card-header {
        border-radius: 0;
    }
</style>
