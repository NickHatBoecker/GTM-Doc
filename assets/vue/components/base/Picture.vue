<template>
    <picture>
        <source :srcset="webpSrc" type="image/webp">
        <source :srcset="fallbackSrc" :type="fallbackMime">
        <img :src="fallbackSrc" :height="height" :width="width" :alt="altText" title="">
    </picture>
</template>

<script>
export default {
    props: {
        webpSrc: { type: String, required: true },
        fallbackSrc: { type: String, required: true },
        fallbackMime: { type: String, default: 'image/png' },
        altText: { type: String, default: '' },
        height: { type: String, default: 'auto' },
        width: { type: String, default: 'auto' },
    },
}
</script>
