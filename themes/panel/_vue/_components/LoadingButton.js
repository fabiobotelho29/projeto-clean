import { VIEWS_THEME, SITE_NAME, SYSTEM_URL } from './../CONFIG.js'

const LoadingButton = Vue.component('loadingbutton', {

    // propriedades vindas do elemento pai
    props: ["display"],

    // informações de retorno para o componente
    data: function () {

        return {

        }
    },

    // componentes
    components: {},

    // renderização
    template: `   
   <span class="indicator-progress" :style="display">Por favor, espere...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
								</span>
     `

})

export default LoadingButton