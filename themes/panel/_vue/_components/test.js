const buttoncounter = Vue.component('button-counter', {

 cc c
 bg
 bg0ggggg//0p1opriedades vindas do elemento pai
    props: ['name', 'nickname'],

    // informações de retorno para o componente
    data: function () {
        return {
            count: 0
        }
    },

    // renderização
    template: '<button v-on:click="count++" title="{{ name }}">{{ name }} ({{ nickname }}), você clicou em mim {{ count }} vezes.</button>'
})

export default buttoncounter