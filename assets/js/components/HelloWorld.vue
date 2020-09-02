<template>
   <div>
        <h1> Hello {{ person[0] }} {{ person[1] }} de {{ from }} ! </h1>
   </div>
</template>

<script>
    export default{
        data () {
            return {
                person: [],
                from: 'Lyon',
            }
        },
        mounted() {
            let el = document.querySelector("div[data-person]");
            let myPerson = el.dataset.person.split(",");
            this.person.push.apply(this.person,myPerson);
        },

    }
</script>

<style>

</style>
