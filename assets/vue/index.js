import Vue from "vue";
import App from "./App";
import router from "./router";
import store from "./store/index";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

new Vue({
    components: { App },
    template: "<App/>",
    router,
    store,
    beforeCreate () {
        this.$store.dispatch('initialiseStore')
    },
}).$mount("#app");
