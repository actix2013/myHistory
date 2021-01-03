<template>
    <p class="text-red text-small mb-0"> @user: {{ lineObject.userName }} > {{ lineObject.description }}</p>
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

    .text-small {
        font-size: xx-small;
    }
</style>
