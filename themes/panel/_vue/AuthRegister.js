// Register Vue
// imports
import {SYSTEM_URL, SITE_NAME, VIEWS_THEME} from "./CONFIG.js";
// import nametest from './_components/name_test.js';
import FormRegister from './_components/FormRegister.js'


// VUE ELEMENT
new Vue({
    // elemento a ser acessado
    el: '#kt_app_root',

    // propriedades reativas
    data: {},

    // componentes usados neste elemento
    components: {
        FormRegister
    }
})




