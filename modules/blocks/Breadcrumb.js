// Breadcrumb Module
import { SYSTEM_URL, SITE_NAME } from "../CONFIG.js";
import { BreadcrumbArrow } from "../components/BreadcrumbArrow.js";


export const Breadcrumb = (page_title, links) => {

    let response = `
<!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                            <a href="../dist/index.html" class="text-gray-500">
                                                <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                        
                                       
                                        
                                        <!--end::Item-->
                                        `
                             for (let i = 0; i < links.length; i++) {

                                 response += `
                                  ${BreadcrumbArrow()}
                                  <!--begin::Item-->
                                      <li class="breadcrumb-item text-gray-700">${links[i]}</li>
                                  <!--end::Item-->
                                  
                                 `
                             }

                            response += `                                
                                        
                                    </ul>
                                    <!--end::Breadcrumb-->
                                    
                                     <!--begin::Title-->
                                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                                        ${page_title}</h1>
                                    <!--end::Title-->
`

    return response;
}
