import {SYSTEM_URL, SITE_NAME, VIEWS_THEME} from '../CONFIG.js'
import SidebarTitle from './SidebarTitle.js';
import SidebarLink from './SidebarLink.js';

const SidebarMenu = Vue.component('sidebarmenu', {

    //propriedades vindas do elemento pai
    props: [],

    // informações de retorno para o componente
    data: function () {

        return {
            menu_dashboard: {
                icon: 'ki-duotone ki-element-11 fs-1',
                text: 'Dashboard',
            },
            menu_account: {
                icon: 'ki-duotone ki-user fs-1',
                text: 'Sua Conta',
            },
            sub_account_profile: {
                icon: 'ki-duotone ki-to-right fs-1',
                text: 'Perfil',
            },
            link_account_userdata: {
                href: `${SYSTEM_URL()}/panel/account/profile/user-data`,
                text: 'Dados Usuário'
            },
            link_account_changepassword: {
                href: `${SYSTEM_URL()}/panel/account/profile/change-password`,
                text: 'Alterar Senha'
            },
            sub_account_company: {
                icon: 'ki-duotone ki-to-right fs-1',
                text: 'Empresa',
            },
            link_account_companydata: {
                href: `${SYSTEM_URL()}/panel/account/company/data`,
                text: 'Dados'
            },
            sub_account_employees: {
                icon: 'ki-duotone ki-to-right fs-1',
                text: 'Funcionários',
            },
            link_account_manageemployees: {
                href: `${SYSTEM_URL()}/panel/account/employees/manage`,
                text: 'Gerenciar'
            },
            menu_modules: {
                icon: 'ki-duotone ki-gear fs-1',
                text: 'Módulos',
            },
            menu_reports: {
                icon: 'ki-duotone ki-filter-tablet fs-1',
                text: 'Relatórios',
            },
            menu_trainings: {
                icon: 'ki-duotone ki-youtube fs-1',
                text: 'Treinamentos',
            },
            menu_support: {
                icon: 'ki-duotone ki-rescue fs-1',
                text: 'Suporte',
            },
            link_dashboard_index: {
                href: `${SYSTEM_URL()}/panel/dashboard`,
                text: 'Visão Geral'
            }
        }
    },
    components: {
        SidebarTitle: SidebarTitle
    },

    // renderização
    template: `   
   <div>

<!--begin:Dashboard item-->
    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
        
        <SidebarTitle :content="menu_dashboard" />
        
        <!--begin:Menu sub-->
		<div class="menu-sub menu-sub-accordion">
		    <SidebarLink :content="link_dashboard_index" />										
		</div>
		<!--end:Menu sub-->
		
    </div>
    <!--end:Menu item-->    
    
    <!--begin:Account item-->
    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
        
        <SidebarTitle :content="menu_account" />
       
       <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
        
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            
            <SidebarTitle :content="sub_account_profile" />
            
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                
                    <SidebarLink :content="link_account_userdata" />
                    <SidebarLink :content="link_account_changepassword" />

                </div>
                <!--end:Menu sub-->                
            </div>
            <!--end:Menu item-->
            
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            
               <SidebarTitle :content="sub_account_company" />
               
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    
                    <SidebarLink :content="link_account_companydata" />
                    
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->           
            
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            
                <SidebarTitle :content="sub_account_employees" />

                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <SidebarLink :content="link_account_manageemployees" />
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
            
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">Financeiro</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                         <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
           

        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->
    
    <!--begin:Modules item-->
    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
        
        <SidebarTitle :content="menu_modules" />
        
       <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">Hotelaria</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                         <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
            
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">Residencial</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                         <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                         <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
           
            
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">Uniformes</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                         <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                         <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
           

        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->
    
    <!--begin:Reports item-->
    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
        
        
        <SidebarTitle :content="menu_reports" />
        
       <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">Hotelaria</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                         <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                         <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
            
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">Residencial</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                         <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
           
            
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">Uniformes</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                         <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
           

        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->    

    <!--begin:Training item-->
    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
        
        <SidebarTitle :content="menu_trainings" />
        
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->

    <!--begin:Support item-->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
        
        <SidebarTitle :content="menu_support" />
        
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                 <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div class="menu-item">
                 <!--begin:Menu link-->
                        <a class="menu-link" href="https://google.com">
						        <span class="menu-bullet">
						        	<span class="bullet bullet-dot"></span>
						        </span>
                            <span class="menu-title">Link</span>
                        </a>
                        <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->
    
    </div>
    
     `

})

export default {SidebarMenu}