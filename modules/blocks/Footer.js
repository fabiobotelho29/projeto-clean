// Footer Module
import { SYSTEM_URL, SITE_NAME } from "../CONFIG.js";
import { FooterLink } from "../components/FooterLink.js";

export const Footer = () => {
    const Today = new Date()
    const Year = Today.getFullYear();
    let response =  `
<!--begin::Copyright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2023 &copy; ${Year}</span>
                        <a href="${SYSTEM_URL()}/panel/dashboard" class="text-gray-800 text-hover-primary">${SITE_NAME()} </a> - 
                        Todos os direitos reservados
                    </div>
                    <!--end::Copyright-->
                    <!--begin::Menu-->
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        
                        ${FooterLink('https://google.com', 'Google', '_blank')}
                        
                        ${FooterLink('https://google.com', 'Google', '_blank')}
                        
                        ${FooterLink('https://google.com', 'Google')}
                        
                    </ul>
                    <!--end::Menu-->
`

    return response
}
