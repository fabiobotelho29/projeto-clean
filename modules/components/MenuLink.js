import { SYSTEM_URL } from "../CONFIG.js";

export const MenuLink = (url, title) => {

    return `
    <!--begin:Menu link-->
                        <a class="menu-link" href="${url}">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">${title}</span>
                        </a>
                        <!--end:Menu link-->
    `
}