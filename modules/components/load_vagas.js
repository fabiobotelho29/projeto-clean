import SYSTEM_URL from '../CONFIG.js';

// API ROUTES
const ENDPOINT = SYSTEM_URL + "/modules/load_vagas.php";

$.get(ENDPOINT, function (data, status) {
    if (status == 'success') {

        let lista = '';
        console.log('início da busca de vagas')
        lista = data
        $('[data-vagas]').html(lista)
        console.log('Fim da execução')
    }
});





