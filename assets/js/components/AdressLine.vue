<template>
    <div>
        <h2 class="center">AdressLine component </h2>
        <div v-text="message"></div>
        <ul>
            <li :key="line.id" v-for="line in lines">{{ line }}
            </li>
        </ul>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                message: "Address",
                lines: []
            };
        },
        mounted() {
            let el = document.querySelector("div[data-lines]");
            let myLines = el.dataset.lines.split(",");
            this.lines.push.apply(this.lines, myLines);
        },
    };
</script>

<style>
    .center {
        text-align: center;
    }
</style>
