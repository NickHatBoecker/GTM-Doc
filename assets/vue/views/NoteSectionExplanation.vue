<template>
    <b-container class="bg-white p-4">
        <h2 class="mb-4">How to fill the note section properly?</h2>
        <h3 class="mt-5">Description</h3>
        <p>Just fill in the note section for one tag. Do <strong>not</strong> use any line breaks. Otherwise the text before the first line break will count as title. See next section for details.</p>
        <p class="font-weight-bold">Example:</p>
        <blockquote class="bg-primary text-white p-3">This is a description block. This tag tracks all clicks on links.</blockquote>

        <h3 class="mt-5">Description with Title</h3>
        <p>Fill in the note section for one tag. Put the title in the first line, following a blank line. After this put your description. You can also use line breaks for the description.</p>
        <p class="font-weight-bold">Example:</p>
        <blockquote class="bg-primary text-white p-3">External Links<br><br>This is a description block. This tag tracks all clicks on links.</blockquote>
    </b-container>
</template>

<script>
export default {
}
</script>

<style lang="scss" scoped>
</style>
