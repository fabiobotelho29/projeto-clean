// Dashboard Vue
// imports
import {SYSTEM_URL, SITE_NAME, VIEWS_THEME} from "./CONFIG.js";
import nametest from './_components/name_test.js';
import Breadcrumb from './_components/Breadcrumb.js';
import SidebarMenu from "./_components/SidebarMenu.js";


// TEST
new Vue({
    // elemento a ser acessado
    el: '#nametest',

    // propriedades reativas
    data: {
        message: 'Olá Vue!',
        myname: 'Fabio Botelho',
        nickname: 'fabiobotelho29',
    },

    // componentes usados neste elemento
    components: {
        nametest,
    }
})


// SIDEBAR
new Vue({
    // elemento a ser acessado
    el: '.vue-sidebar-menu',

    // propriedades reativas
    data: {

    },

    // componentes usados neste elemento
    components: {
        SidebarMenu:SidebarMenu

    }
})


// BREADCRUMB
new Vue({
    // elemento a ser acessado
    el: '#vue-breadcrumb',

    // propriedades reativas
    data: {
        pagetitle: 'Visão Geral',
        links: ["Dashboard", "Visão Geral"]
    },

    // componentes usados neste elemento
    components: {
        Breadcrumb: Breadcrumb,
    }
})



