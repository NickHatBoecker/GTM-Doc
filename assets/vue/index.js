import Vue from "vue";
import App from "./App";
import router from "./router";
import store from "./store/index";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import Aos from 'aos/dist/aos';

Aos.init();

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
