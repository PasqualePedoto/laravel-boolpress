<template>
    <div class="block-spinner">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppLoader",
};
</script>

<style lang="scss" scoped>
.block-spinner {
    position: fixed;

    top: 0;
    bottom: 0;
    right: 0;
    left: 0;

    background-color: transparent;
    filter: opacity(0.2);

    display: flex;
    align-items: center;
    justify-content: center;

    .spinner-border {
        width: 300px;
        height: 300px;
    }
}
</style>
