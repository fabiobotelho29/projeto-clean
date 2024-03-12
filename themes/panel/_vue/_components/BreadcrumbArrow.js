const BreadcrumbArrow = Vue.component('BreadcrumbArrow', {

    //propriedades vindas do elemento pai
    props: [],

    // informações de retorno para o componente
    data: function () {
        return {}
    },

    // renderização
    template: `   
            <!--begin::Item-->
                <li class="breadcrumb-item">
                    <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                </li>
                <!--end::Item-->
     `
})

export default BreadcrumbArrow