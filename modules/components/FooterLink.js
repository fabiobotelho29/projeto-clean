

export const FooterLink = (url, title, target = '_self') => {

    let response =  `
    <li class="menu-item">
        <a href="${url}" target="${target}" class="menu-link px-2">${title}</a>
    </li>
    `

    return response
}