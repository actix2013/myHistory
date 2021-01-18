import ConsolePad from "./components/ConsolePad";
import Vue from 'vue';

new Vue({
    el: '#consolePad',
    render: h => h(ConsolePad)
});

import appTitle from "./apps/title/components/title.vue";

const container = document.getElementById('app-title');
let message = container.getAttribute('data-title');
new Vue({
    el: '#title-app',
    render: createElement => createElement(appTitle, {
        props: {
            message,
        }
    }),
});

let container2 = document.getElementById('competence-app');
let message2 = container2.getAttribute('data-title');
new Vue({
    el: '#competence-app',
    render: createElement => createElement(appTitle, {
        props: {
            message: message2,
        }
    }),
});

