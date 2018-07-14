import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './components/UserCalculator.vue'


new Vue({
	el: "#mortgage_calculator",
	render: h => h(App)
})

console.log("User Show App rendered successfully")