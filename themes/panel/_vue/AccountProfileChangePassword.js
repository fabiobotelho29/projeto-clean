// Dashboard Vue
// imports
import {SYSTEM_URL, SITE_NAME, VIEWS_THEME} from "./CONFIG.js";
import Breadcrumb from './_components/Breadcrumb.js';
import SidebarMenu from "./_components/SidebarMenu.js";
import PanelLogo from "./_components/PanelLogo.js";
import BavBar from "./_components/NavBar.js";


// VUE ELEMENT
new Vue({
    // elemento a ser acessado
    el: '#kt_app_root',

    // propriedades reativas
    data: {
        pagetitle: 'Alteração de Senha',
        links: ["Sua Conta", "Perfil", "Sua Senha"],
        user: {
            name: 'Fabio C. Botelho',
            email: 'fabio@gmail.com',
        }
    },

    // componentes usados neste elemento
    components: {
        PanelLogo:PanelLogo,
        SidebarMenu:SidebarMenu,
        Breadcrumb: Breadcrumb,
        NavBar: BavBar
    }
})




