<template>
    <div>
        <h2 class="center">My Application</h2>
        <div v-text="message"></div>
<!--        {{ message }}-->
        <ul>
            <li :key="word.id" v-for="word in words">{{ word }}
            </li>
        </ul>
        <HelloWorld></HelloWorld>
    </div>
</template>

<script>
    import HelloWorld from "./HelloWorld";

    export default {
        data() {
            return {
                message: "A list of words",
                words: []
            };
        },
        mounted() {

            let el = document.querySelector("div[data-words]");
            let mywords = el.dataset.words.split(",");
            this.words.push.apply(this.words, mywords);
        },
        components: {
            HelloWorld,
        },
    };
</script>

<style>
    .center {
        text-align: center;
    }
</style>
