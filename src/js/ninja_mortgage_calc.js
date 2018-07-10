import Vue from 'vue'
import VueRouter from 'vue-router'
import ElementUI from 'element-ui';

import routes from './router.js';

import locale from 'element-ui/lib/locale';
import lang from 'element-ui/lib/locale/lang/en';

locale.use(lang);
Vue.use(VueRouter);

import { 
	Button, 
	Dialog, 
	Input, 
	Select, 
	Option,
	Table, 
	Icon,
	TableColumn,
	Notification } from 'element-ui';

import 'element-ui/lib/theme-chalk/index.css';
import 'element-ui/lib/theme-chalk/table.css';
import 'element-ui/lib/theme-chalk/table-column.css';
import 'element-ui/lib/theme-chalk/color-picker.css';
import 'element-ui/lib/theme-chalk/button-group.css';
import 'element-ui/lib/theme-chalk/button.css';
import 'element-ui/lib/theme-chalk/switch.css';
import 'element-ui/lib/theme-chalk/select-dropdown.css';
import 'element-ui/lib/theme-chalk/option.css';
import 'element-ui/lib/theme-chalk/select.css';
import 'element-ui/lib/theme-chalk/input.css';
import 'element-ui/lib/theme-chalk/dialog.css';
import 'element-ui/lib/theme-chalk/notification.css';
import 'element-ui/lib/theme-chalk/loading.css';
import 'element-ui/lib/theme-chalk/popover.css';
import 'element-ui/lib/theme-chalk/pagination.css';


Vue.use(Button)
Vue.use(Dialog)
Vue.use(Input)
Vue.use(Select)
Vue.use(Option)
Vue.use(Table)
Vue.use(Icon)
Vue.use(TableColumn)

Vue.prototype.$notify = Notification; 

const router = new VueRouter({
	routes
});

import App from './AdminApp';

new Vue({
    el:'#ninja_mortgage_calc',
    router,
    render: h => h(App)
});

console.log("JS rendered successfully");
