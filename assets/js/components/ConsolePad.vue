<template>

    <div class="d-flex flex-fill flex-column m-2 cust-shadow cust-backgroud-motif">
        <div class="d-inline-flex ml-2 mt-2 border-bottom cust-radius-top">
            <h2><strong>{{ console_ }}</strong></h2>
        </div>
        <div class="d-inline-flex console cust-radius-buttom">
            <ul class="ml-1 ml-lg-1 mt-1 list-unstyled">
                <li class="ml-1 ml-lg-1" :key="lineObject.id" v-for="lineObject in lines">
                    <console-pad-line :line-object="lineObject"></console-pad-line>
                </li>
            </ul>
        </div>
<!--        <button @click="clickDetected">test</button>-->
    </div>
</template>

<script>
    import ConsolePadLine from './ConsolePadLine';
    import axios from "axios";
    export default {
        components: {
            ConsolePadLine,
        },
        name: 'parsedLines',
        data() {
            return {
                idAdded: 0,
                lines: [],
                lastLine: null,
                console_: "Console"
            }
        },
        mounted() {
            let el = document.querySelector("div[data-lines]");
            this.lines = JSON.parse(el.dataset.lines);
            this.interval = setInterval(() => this.getLastEvents(), 1000);
        },
        methods: {
            clickDetected(event) {
               console.log("clickDetected")
               if(this.getLastEvents()) {
                   console.log('last line:',this.lastLine);
                   // this.lines[Object.keys(this.lines).length] = newLine;
                   // this.parsedLines[Object.keys(this.lines).length] = newLine;
               }
            },
            getLastEvents() {
                this.switchCaret();
                axios.get('/api/history')
                    .then((response) => {
                        if(!this.lastLine) {
                            this.lastLine = JSON.parse(response.data.data);
                            this.lines.push(this.lastLine);
                            if (this.lines.length > 7) {
                                this.lines.splice(0, 1);
                            }
                            return true;
                        }
                        let line = JSON.parse(response.data.data);
                        if(this.lastLine.id !== line.id) {
                            this.lastLine = JSON.parse(response.data.data);
                            this.lines.push(this.lastLine);
                            if (this.lines.length > 7) {
                                this.lines.splice(0, 1);
                            }
                            return true;
                        }
                        return false;
                    })
                    .catch((error) => {
                        console.log(error.message);
                        return null;
                    });
            },
            switchCaret() {
                this.console_ = this.console_ === 'Console▮' ? 'Console▯' : 'Console▮';
            }
        },

    };
</script>

<style lang="scss">
 .console {
     width: auto;
     height: 200px;
     background-color: black;
     opacity: 80%;
     overflow-y: hidden;
 }
 .cust-radius-buttom {
     border-radius: 0px 0px 5px 5px;
 }
.text-red {
    color: red;
}

</style>
