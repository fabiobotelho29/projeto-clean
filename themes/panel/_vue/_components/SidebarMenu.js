import BreadcrumbArrow from './BreadcrumbArrow.js';

const Breadcrumb = Vue.component('Breadcrumb', {

    //propriedades vindas do elemento pai
    props: ['pagetitle', 'links'],

    // informações de retorno para o componente
    data: function () {

        return {}
    },

    components: {
        BreadcrumbArrow: BreadcrumbArrow
    },

    // renderização
    template: `   
<div>
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                            <a href="../dist/index.html" class="text-gray-500">
                                                <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                   
                                  <!--begin::Item-->                                  
                                      <li v-for="link in links" class="breadcrumb-item text-gray-700"> 
                                            <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i> &nbsp;
                                            {{ link }}
                                       </li>
                                  <!--end::Item-->      
                                        
                                    </ul>
                                    <!--end::Breadcrumb-->
                                    
                                     <!--begin::Title-->
                                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                                       {{ pagetitle }}
                                        </h1>
</div>


     `

})

export default Breadcrumb