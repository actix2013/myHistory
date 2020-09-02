<template>

    <div class="d-flex flex-fill flex-column m-2 cust-shadow cust-backgroud-motif">
        <div class="d-inline-flex ml-5 mt-2 border-bottom cust-radius-top">
            <h2>  Console@{{ user }} </h2>
        </div>
        <div class="d-inline-flex console cust-radius-buttom">
            <ul class="ml-1 ml-lg-1 mt-1 list-unstyled">
                <li class="ml-1 ml-lg-1" :key="line.id" v-for="line in lines">
                    <console-pad-line :text-line="line"></console-pad-line>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import ConsolePadLine from './ConsolePadLine';
    export default {
        data() {
            return {
                lines: [],
                user: 'test',
                time: '00:00',
            }
        },
        mounted() {
            let el = document.querySelector("div[data-lines]");
            let myLines = el.dataset.lines.split(",");
            this.lines.push.apply(this.lines, myLines);
        },
        components: {
            ConsolePadLine,
        },

    }
</script>

<style lang="scss">
 .console {
     width: auto;
     height: 200px;
     background-color: black;
     opacity: 80%;
 }
 .cust-radius-buttom {
     border-radius: 0px 0px 5px 5px;
 }
    .text-red {
        color: red;
    }
</style>
