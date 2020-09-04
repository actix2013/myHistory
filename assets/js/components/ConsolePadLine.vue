<template>
    <p class="text-red mb-0"> @user: {{ lineObject.userName }} > {{ lineObject.description }}</p>
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
