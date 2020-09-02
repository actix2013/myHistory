/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';
import Vue from 'vue';
import App from './components/App';
import HelloWorld from "./components/HelloWorld";
import AdressLine from "./components/AdressLine";
// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.


require('bootstrap');
const $ = require('jquery');

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

new Vue({
    el: '#app',
    components: { HelloWorld },
    render: h => h(App)
});


new Vue({
    el: '#adressLine',
    render: h => h(AdressLine)
});
