<template>
    <div v-if="$store.getters.isLoading" class="c-loading">
        <div class="c-loading__spinner"><div></div><div></div><div></div><div></div></div>
    </div>
</template>

<style lang="scss" scoped>
    $loadingBackgroundColor: rgba(0, 0, 0, 0.5);
    $spinnerWidth: 120px;
    $spinnerColor: #fff;
    $spinnerThickness: 6px;

    .c-loading {
        z-index: 9999;
        position: fixed;
        top: 0;
        height: 100%;
        width: 100%;
        background-color: $loadingBackgroundColor;
    }

    .c-loading__spinner {
        display: inline-block;
        position: absolute;
        margin: auto;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        width: $spinnerWidth;
        height: $spinnerWidth;
    }

    .c-loading__spinner div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: $spinnerWidth - 13;
        height: $spinnerWidth - 13;
        border: $spinnerThickness solid $spinnerColor;
        border-radius: 50%;
        animation: c-loading__spinner 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: $spinnerColor transparent transparent transparent;
    }

    .c-loading__spinner div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .c-loading__spinner div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .c-loading__spinner div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes c-loading__spinner {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
