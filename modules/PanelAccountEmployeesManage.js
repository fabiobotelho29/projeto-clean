import { SidebarMenu } from "./blocks/SidebarMenu.js";
import { Breadcrumb } from "./blocks/Breadcrumb.js";
import { Footer } from "./blocks/Footer.js";
import {PanelLogo} from "./blocks/PanelLogo.js";
import {Navbar} from "./blocks/Navbar.js";

// Panel Logo
document.querySelector(".js-panel-logo").innerHTML = PanelLogo();

// Navbar
document.querySelector(".js-navbar").innerHTML = Navbar();

// Sidebar
document.querySelector(".js-sidebar-menu").innerHTML = SidebarMenu();

// Breadcrumb
const BreadcrumbLinks = [
    "Sua Conta", "Funcionários", "Gerenciar"
]

document.querySelector(".js-breadcrumb").innerHTML = Breadcrumb('Funcionaríos', BreadcrumbLinks);

// Footer
document.querySelector(".js-footer").innerHTML = Footer();