import PlusMinus from './components/PlusMinus.vue';
Vue.component('PlusMinus', PlusMinus);
import { BadgePlugin } from 'bootstrap-vue';
Vue.use(BadgePlugin);
import { ButtonPlugin } from 'bootstrap-vue';
Vue.use(ButtonPlugin);
import { ButtonToolbarPlugin } from 'bootstrap-vue';
Vue.use(ButtonToolbarPlugin);

new Vue({
    el: '#ideas',
    data() {
        return {
          'category': null
        };
    },
    methods: {
        setCategory(category) {
            this.category = category;
        }
    }
});
