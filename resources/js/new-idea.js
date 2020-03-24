import FormWizard from './components/FormWizard.vue';
import Tab from './components/Tab.vue';
import { Validator } from 'vee-validate';
import VeeValidate from 'vee-validate';

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
});
