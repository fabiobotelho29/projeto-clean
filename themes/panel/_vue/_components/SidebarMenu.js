import {SYSTEM_URL, SITE_NAME, VIEWS_THEME} from '../CONFIG.js'
import SidebarTitle from './SidebarTitle.js';
import SidebarLink from './SidebarLink.js';

const SidebarMenu = Vue.component('sidebarmenu', {

    //propriedades vindas do elemento pai
    props: [],

    // informações de retorno para o componente
    data: function () {
        return {}
    },
    components: {
        SidebarTitle: SidebarTitle
    },

    // renderização
    template: `   
   <div>

<!--begin:Dashboard item-->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
        
        <SidebarTitle icon="ki-duotone ki-element-11 fs-1" text="Dashboard" />
        
        <!--begin:Menu sub-->
		<div class="menu-sub menu-sub-accordion">
		    <SidebarLink link="${SYSTEM_URL()}/panel/dashboard" text="Visão Geral" />										
		</div>
		<!--end:Menu sub-->
		
    </div>
    <!--end:Menu item-->    
    
    <!--begin:Account item-->
    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
        
        <SidebarTitle icon="ki-duotone ki-user fs-1" text="Sua Conta" />
       
       <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
        
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            
            <SidebarTitle icon="ki-duotone ki-to-right fs-1" text="Perfil" />
            
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                
                    <SidebarLink link="${SYSTEM_URL()}/panel/account/profile/user-data" text="Seus Dados" />
                    <SidebarLink link="${SYSTEM_URL()}/panel/account/profile/change-password" text="Sua Senha" />

                </div>
                <!--end:Menu sub-->                
            </div>
            <!--end:Menu item-->
            
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            
               <SidebarTitle icon="ki-duotone ki-to-right fs-1" text="Empresa" />
               
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    
                    <SidebarLink link="${SYSTEM_URL()}/panel/account/company/data" text="Dados" />
                    
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->           
            
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            
                <SidebarTitle icon="ki-duotone ki-to-right fs-1" text="Funcionários" />

                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <SidebarLink link="${SYSTEM_URL()}/panel/account/employees/manage" text="Gerenciar" />                    
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
        
        <SidebarTitle icon="ki-duotone ki-gear fs-1" text="Módulos" />
        
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
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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
        
        
        <SidebarTitle icon="ki-duotone ki-filter-tablet fs-1" text="Relatórios" />
        
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
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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
        
        <SidebarTitle icon="ki-duotone ki-youtube fs-1" text="Treinamentos" />
        
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                        <a class="menu-link" link="https://google.com">
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
        
        <SidebarTitle icon="ki-duotone ki-question fs-1" text="Suporte" />
        
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                 <!--begin:Menu link-->
                        <a class="menu-link" link="https://google.com">
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
                        <a class="menu-link" link="https://google.com">
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