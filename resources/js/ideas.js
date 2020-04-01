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
            category: null,
            sorting: 'votes'
        };
    },
    methods: {
        setCategory(category) {
            this.category = category;
        },
        setSorting(sorting) {
            this.sorting = sorting;

            // TODO: Nicer way of doing DOM manipulation.
            let parent = this.$refs['ideas'];
            let ideas = Array.from(parent.childNodes);
            let result = ideas.slice();
            result = result.filter(x => x.constructor.name === 'HTMLDivElement');
            if (sorting === 'votes') {
                result.sort((a, b) => parseInt(b.getAttribute('data-votes')) - parseInt(a.getAttribute('data-votes')));
            } else if (sorting === 'dates') {
                result.sort((a, b) =>
                    parseInt(Date.parse(b.getAttribute('data-date'))) -
                    parseInt(Date.parse(a.getAttribute('data-date'))));
            }
            ideas.forEach(element => parent.removeChild(element));
            result.forEach(element => parent.appendChild(element));
        }
    }
});
