<div id="app">
    {{ message }}
</div>

<div id="app-2">
  <span v-bind:title="message">
    Pare o mouse sobre mim e veja a dica interligada dinamicamente!
  </span>
</div>

<div id="app-3">
    <p v-if="seen">Agora você me viu</p>
</div>

<div id="app-4">
    <ol>
        <li v-for="todo in todos">
            {{ todo.text }}
        </li>
    </ol>
</div>

<div id="app-5">
    <p>{{ message }}</p>
    <button v-on:click="reverseMessage">Inverter Mensagem</button>
</div>

<div id="app-6">
    <p>{{ message }}</p>
    <p>{{ name }}</p>
    <input title="message" v-model="message"> <br>
    <input title='name' v-model="name"> <br>
</div>

<div id="app-7">

    <input type="text" v-model="myname">
    <input type="text" v-model="nickname">
    <p>{{ myname }}</p>
    <buttoncounter v-bind:name="myname" v-bind:nickname="nickname" />

</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script type="module">

    import buttoncounter from '<?= views_theme(VIEWS_PANEL_THEME); ?>/_components/test.js'
    //import test from '<?//= views_theme(VIEWS_PANEL_THEME); ?>///_components/test.vue'

    new Vue({
        el: '#app',
        data: {
            message: 'Olá Vue!'
        }
    })

    new Vue({
        el: '#app-2',
        data: {
            message: 'Você carregou esta página em ' + new Date().toLocaleString()
        }
    })

    new Vue({
        el: '#app-3',
        data: {
            seen: true
        }
    })

    new Vue({
        el: '#app-4',
        data: {
            todos: [
                {text: 'Aprender JavaScript'},
                {text: 'Aprender Vue'},
                {text: 'Criar algo incrível'},
                {text: 'Minha nova mensagem'},
            ]
        }
    })

    new Vue({
        el: '#app-5',
        data: {
            message: 'Olá Vue!'
        },
        methods: {
            reverseMessage: function () {
                this.message = this.message.split('').reverse().join('')
            }
        }
    })

    new Vue({
        el: '#app-6',
        data: {
            message: 'Olá Vue!',
            name: 'Fabio Botelho',
        }
    })

    new Vue({
        // elemento a ser acessado
        el: '#app-7',

        // propriedades reativas
        data: {
            message: 'Olá Vue!',
            myname: 'Fabio Botelho',
            nickname: 'fabiobotelho29',
        },

        // componentes usados neste elemento
        components: {
            buttoncounter
        }
    })


</script>
