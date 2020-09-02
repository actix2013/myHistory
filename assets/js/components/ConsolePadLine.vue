<template>
    <p class="text-red">{{ textLine }}</p>
</template>

<script>

    export default {
        props: ['user','textLine'],
        data() {
            return {
                balance: true,
            };
        },
        mounted() {
            let start = '>';
            this.textLine = start + this.textLine;
            let el = document.querySelector("div[data-textLine]");

        },
    };
</script>

<style>
    .text-red {
        color: red;
    }
</style>
