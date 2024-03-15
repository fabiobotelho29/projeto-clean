export const SYSTEM_URL = () => {
    const HOST = window.location.href;
    let URL;
    if (HOST.indexOf('localhost')) {

        URL = 'http://localhost/projeto-clean'
    } else {

        URL = 'URL deploy'
    }
    return URL;
}

export const SITE_NAME = () => {
    return 'Projeto Clean'
}

export const VIEWS_THEME = (theme) => {

    const URL = SYSTEM_URL();
    return `${URL}/themes/${theme}`
}

export const API_URL = () => {

    return SYSTEM_URL()+'/api';
}

export const PASSWORD_LIMIT = (limit = 'min') => {

    if (limit === 'min') {
        return `8`
    } else {
        return `40`
    }
}







