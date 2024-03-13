// Dashboard Vue
// imports
import {SYSTEM_URL, SITE_NAME, VIEWS_THEME} from "./CONFIG.js";
// import nametest from './_components/name_test.js';
import Breadcrumb from './_components/Breadcrumb.js';
import SidebarMenu from "./_components/SidebarMenu.js";
import PanelLogo from "./_components/PanelLogo.js";
import BavBar from "./_components/NavBar.js";


// TEST
// new Vue({
//     // elemento a ser acessado
//     el: '#nametest',
//
//     // propriedades reativas
//     data: {
//         message: 'Olá Vue!',
//         myname: 'Fabio Botelho',
//         nickname: 'fabiobotelho29',
//     },
//
//     // componentes usados neste elemento
//     components: {
//         nametest,
//     }
// })


// VUE ELEMENT
new Vue({
    // elemento a ser acessado
    el: '#kt_app_root',

    // propriedades reativas
    data: {
        pagetitle: 'Visão Geral',
        links: ["Dashboard", "Visão Geral"],
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




