<template>
    <div class="d-flex list-unstyled">
        <ol>
            <li>
                <p>
                    un element de liste
                </p>
            </li>
        </ol>
        <h1> Hello {{ person[0] }} {{ person[1] }} de {{ from }} ! </h1>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                lines: [],
                user: '',
                time: '',
            }
        },
        mounted() {
            let el = document.querySelector("div[data-person]");
            let myPerson = el.dataset.person.split(",");
            this.person.push.apply(this.person, myPerson);
        },

    }
</script>

<style lang="scss">
 .console {
     width: 100px;
     height: 200px;
     background-color: black;
 }
</style>
