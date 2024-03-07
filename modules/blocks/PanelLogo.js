// Panel Logo Module
import { SYSTEM_URL, SITE_NAME, VIEWS_THEME } from "../CONFIG.js";



export const PanelLogo = () => {

    let response = `
<!--begin::Sidebar mobile toggle-->
                    <div class="btn btn-icon btn-active-color-primary w-35px h-35px ms-3 me-2 d-flex d-lg-none"
                         id="kt_app_sidebar_mobile_toggle">
                        <i class="ki-duotone ki-abstract-14 fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Sidebar mobile toggle-->

                    <!--begin::Logo-->
                    <a href="../dist/index.html" class="app-sidebar-logo">
                        <img alt="Logo" src="${VIEWS_THEME('panel')}/assets/media/logos/default.svg"
                             class="h-30px theme-light-show"/>
                        <img alt="Logo" src="${VIEWS_THEME('panel')}/assets/media/logos/default-dark.svg"
                             class="h-30px theme-dark-show"/>
                    </a>
                    <!--end::Logo-->

                    <!--begin::Sidebar toggle-->
                    <div id="kt_app_sidebar_toggle"
                         class="app-sidebar-toggle btn btn-sm btn-icon btn-color-warning me-n2 d-none d-lg-flex"
                         data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                         data-kt-toggle-name="app-sidebar-minimize">
                        <i class="ki-duotone ki-exit-left fs-1 rotate-180">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Sidebar toggle-->
`

    return response;
}
