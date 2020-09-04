<template>

    <div class="d-flex flex-fill flex-column m-2 cust-shadow cust-backgroud-motif">
        <div class="d-inline-flex ml-5 mt-2 border-bottom cust-radius-top">
            <h2 >  Global actions {{ idAdded }}</h2>
        </div>
        <div class="d-inline-flex console cust-radius-buttom">
            <ul class="ml-1 ml-lg-1 mt-1 list-unstyled">
                <li class="ml-1 ml-lg-1" :key="lineObject.id" v-for="lineObject in lines">
                    <console-pad-line :line-object="lineObject"></console-pad-line>
                </li>
            </ul>
        </div>
        <button @click="clickDetected">test</button>
    </div>
</template>

<script>
    import ConsolePadLine from './ConsolePadLine';
    export default {
        name: 'parsedLines',
        data: function () {
            return {
                idAdded: 0,
                lines: [],
            }
        },
        mounted() {
            let el = document.querySelector("div[data-lines]");
            this.lines = JSON.parse(el.dataset.lines);
        },
        methods: {
            clickDetected: function (event) {
                console.log("clickDetected")
                this.idAdded = this.idAdded + 1;
                const newLine = {
                    id: this.idAdded,
                    userName: "clicker",
                    description : "manual add numbrer" + this.idAdded,
                };
                // this.parsedLines.splice(Object.keys(this.lines).length,1,newLine);
                // this.parsedLines.splice(Object.keys(this.lines).length);
                if (Object.keys(this.lines).length > 7 )
                {
                    this.lines.splice(0, 1);
                }

                this.lines.push(newLine);
                // this.lines[Object.keys(this.lines).length] = newLine;
                // this.parsedLines[Object.keys(this.lines).length] = newLine;
                // console.log(this.lines[2].id);
                // this.$nextTick();

            }

        },
        components: {
            ConsolePadLine,
        },

    };
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
