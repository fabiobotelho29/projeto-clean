// MenuBar Module
import { SYSTEM_URL, SITE_NAME } from "../CONFIG.js";
import { MenuLink } from "../components/MenuLink.js";


export const SidebarMenu = () => {

    return `
<!--begin:Dashboard item-->
    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
        <!--begin:Menu link-->
        <span class="menu-link">
			<span class="menu-icon">
				<i class="ki-duotone ki-element-11 fs-1">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
				</i>
			</span>
			<span class="menu-title">Visão Geral</span>
			<span class="menu-arrow"></span>
		</span>
        <!--end:Menu link-->

        
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                ${MenuLink(SYSTEM_URL()+'/panel/dashboard', 'Início')}
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->    
    
    <!--begin:Account item-->
    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
        <!--begin:Menu link-->
        <span class="menu-link">
			<span class="menu-icon">
				<i class="ki-duotone ki-user fs-1">
                 <span class="path1"></span>
                 <span class="path2"></span>
                </i>
			</span>
			<span class="menu-title">Sua Conta</span>
			<span class="menu-arrow"></span>
		</span>
        <!--end:Menu link-->
       <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Module item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">Perfil</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/user-data', 'Seus Dados')}
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/change-password', 'Alterar Senha')}
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
					<span class="menu-title">Empresa</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        ${MenuLink(SYSTEM_URL()+'/panel/account/company/data', "Dados")}
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
					<span class="menu-title">Funcionários</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/user-data', 'Gerenciar')}
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
					<span class="menu-title">Financeiro</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/user-data', 'Gerenciar')}
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
        <!--begin:Menu link-->
        <span class="menu-link">
			<span class="menu-icon">
				<i class="ki-duotone ki-gear fs-1">
                 <span class="path1"></span>
                 <span class="path2"></span>
                </i>
			</span>
			<span class="menu-title">Módulos</span>
			<span class="menu-arrow"></span>
		</span>
        <!--end:Menu link-->
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
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/user-data', 'Seus Dados')}
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/change-password', 'Alterar Senha')}
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
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/user-data', 'Seus Dados')}
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/change-password', 'Alterar Senha')}
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
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/user-data', 'Seus Dados')}
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/change-password', 'Alterar Senha')}
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
        <!--begin:Menu link-->
        <span class="menu-link">
			<span class="menu-icon">
				<i class="ki-duotone ki-filter-tablet fs-1">
                 <span class="path1"></span>
                 <span class="path2"></span>
                </i>
			</span>
			<span class="menu-title">Relatórios</span>
			<span class="menu-arrow"></span>
		</span>
        <!--end:Menu link-->
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
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/user-data', 'Seus Dados')}
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/change-password', 'Alterar Senha')}
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
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/user-data', 'Seus Dados')}
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/change-password', 'Alterar Senha')}
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
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/user-data', 'Seus Dados')}
                    </div>
                    <!--end:Menu item-->

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        ${MenuLink(SYSTEM_URL()+'/panel/account/profile/change-password', 'Alterar Senha')}
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
        <!--begin:Menu link-->
        <span class="menu-link">
			<span class="menu-icon">
				<i class="ki-duotone ki-youtube fs-1">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
				</i>
			</span>
			<span class="menu-title">Treinamentos</span>
			<span class="menu-arrow"></span>
		</span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
               ${MenuLink(SYSTEM_URL()+'/panel/training/videos', 'Vídeos')}
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->

    <!--begin:Support item-->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
        <!--begin:Menu link-->
        <span class="menu-link">
			<span class="menu-icon">
				<i class="ki-duotone ki-rescue fs-1">
					<span class="path1"></span>
					<span class="path2"></span>
				</i>
			</span>
			<span class="menu-title">Suporte</span>
			<span class="menu-arrow"></span>
		</span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                ${MenuLink(SYSTEM_URL()+'/panel/support/problems', 'Relatar Problemas')}
            </div>
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div class="menu-item">
                ${MenuLink(SYSTEM_URL()+'/panel/support/faq', 'F.A.Q')}
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->
    
    
`
}
