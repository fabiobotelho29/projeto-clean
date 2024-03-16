// Register Vue
// imports
import {SYSTEM_URL, SITE_NAME, VIEWS_THEME} from "./CONFIG.js";
import FormLogin from './_components/FormLogin.js'


// VUE ELEMENT
new Vue({
    // elemento a ser acessado
    el: '#kt_app_root',

    // propriedades reativas
    data: {},

    // componentes usados neste elemento
    components: {
        FormLogin
    }
})




