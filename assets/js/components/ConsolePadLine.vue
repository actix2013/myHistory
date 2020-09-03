<template>
    <p class="text-red">{{ lineObject.user }}</p>
</template>

<script>

    export default {
        props: ['lineObject'],
        data() {
            return {
                textLine: lineObject.textLine,
                user: lineObject.user,
                balance: true,
            };
        },
        mounted() {
            let start = '>';
            let el = document.querySelector("div[data-line]");
            this.textLine = start + this.lineObject.textLine;

        },
    };
</script>

<style>
    .text-red {
        color: red;
    }
</style>
