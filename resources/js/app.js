window.Vue = require('vue');

import axios from 'axios';
import VueAxios from 'vue-axios';
Vue.use(VueAxios, axios);

import { VBModal } from 'bootstrap-vue';
Vue.directive('b-modal', VBModal);
import { BModal } from 'bootstrap-vue';
Vue.component('b-modal', BModal);

new Vue({
    el: '#header',
    components: {
        BModal: BModal
    }
});

import CookieLaw from 'vue-cookie-law';

new Vue({
    el: '#footer',
    components: {
        CookieLaw: CookieLaw
    }
});
