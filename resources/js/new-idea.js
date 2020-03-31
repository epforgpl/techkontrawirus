import FormWizard from './components/FormWizard.vue';
import Tab from './components/Tab.vue';
import { Validator } from 'vee-validate';
import VeeValidate from 'vee-validate';
import { ButtonPlugin } from 'bootstrap-vue';
Vue.use(ButtonPlugin);
import { ButtonToolbarPlugin } from 'bootstrap-vue';
Vue.use(ButtonToolbarPlugin);

// Provide localized error messages for Polish.
const dictionary = {
    pl: {
        messages: {
            required: () => 'To pole jest wymagane.',
            max: (i, j) => 'To pole może mieć maksymalnie ' + j + ' znaków.'
        }
    }
};
Validator.localize(dictionary);
Vue.use(VeeValidate);

new Vue({
    el: '#new-idea',
    components: {
        FormWizard, Tab
    },
    data() {
        return {
            'categories': []
        };
    },
    watch: {
        categories: function (val) {
            this.$refs['categories'].value = val.join(',');
        }
    },
    methods: {
        toggleCategory(categoryId) {
            categoryId = String(categoryId);
            if (this.categories.includes(categoryId)) {
                this.categories = this.categories.filter(item => item !== categoryId);
            } else {
                this.categories.push(categoryId);
            }
        }
    }
});
