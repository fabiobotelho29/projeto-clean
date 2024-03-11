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







