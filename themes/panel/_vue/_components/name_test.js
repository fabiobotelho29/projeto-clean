const buttoncounter = Vue.component('button-counter', {

    //propriedades vindas do elemento pai
    props: ['name', 'nickname'],

    // informações de retorno para o componente
    data: function () {
        return {
            count: 0
        }
    },

    // renderização
    template: '<button v-on:click="count++">{{ name }} ({{ nickname }}), você clicou em mim {{ count }} vezes.</button>'
})

export default buttoncounter