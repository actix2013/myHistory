<template>
    <p class="text-red"> @user: {{ lineObject.user }} > {{ lineObject.textLine }}</p>
</template>

<script>

    export default {
        props: {
            lineObject: {
                type: Object,
            },
        },
    };
</script>

<style>
    .text-red {
        color: red;
    }
</style>
