const nametest = Vue.component('nametet', {

    //propriedades vindas do elemento pai
    props: [],

    // informações de retorno para o componente
    data: function () {
        return {
            name: 'Fabio C. Botelho'
        }
    },

    // renderização
    template: `
    <p>Meu nome é {{ name }} </p>
    `
})

export default nametest