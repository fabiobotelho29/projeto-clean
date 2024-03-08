<?php $v->layout(VIEWS_THEME_PANEL_FILE); ?>

<?php $v->start("CSS"); ?>
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/plugins/custom/datatables/datatables.bundle.css"
          rel="stylesheet" type="text/css"/>
    <!--end::Vendor Stylesheets-->
<?php $v->stop(); ?>

    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header d-flex flex-column flex-stack">
                <!--begin::Header main-->
                <div class="d-flex align-items-center flex-stack flex-grow-1">

                    <!--begin::PanelLogo-->
                    <?php include('includes/panel-logo.php'); ?>
                    <!--end::panelLogo-->

                    <!--begin::Navbar-->
                    <?php include('includes/nav-bar.php'); ?>
                    <!--end::Navbar-->
                </div>
                <!--end::Header main-->
                <!--begin::Separator-->
                <div class="app-header-separator"></div>
                <!--end::Separator-->
            </div>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
                     data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
                     data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start"
                     data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                    <!--begin::Main-->
                    <div class="d-flex flex-column justify-content-between h-100 hover-scroll-overlay-y my-2 d-flex flex-column"
                         id="kt_app_sidebar_main" data-kt-scroll="true" data-kt-scroll-activate="true"
                         data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header"
                         data-kt-scroll-wrappers="#kt_app_main" data-kt-scroll-offset="5px">

                        <?php include 'includes/sidebar-menu.php'; ?>

                    </div>
                    <!--end::Main-->
                </div>
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar pt-5">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container"
                                 class="app-container container-fluid d-flex align-items-stretch">
                                <!--begin::Toolbar wrapper-->
                                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                                    <!--begin::Page title-->
                                    <?php include('includes/page-title.php'); ?>
                                    <!--end::Page title-->
                                    <?php if (false): ?>
                                        <!--begin::Actions-->
                                        <a href="#" class="btn btn-sm btn-success ms-3 px-4 py-3" data-bs-toggle="modal"
                                           data-bs-target="#kt_modal_create_app">Create Project</a>
                                        <!--end::Actions-->
                                    <?php endif; ?>
                                </div>
                                <!--end::Toolbar wrapper-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-fluid">

                                <!--begin::details View-->
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="card mb-5 mb-xl-10 tab-pane fade show active"
                                         id="kt_profile_details_view" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <!--begin::Card header-->
                                        <div class="card-header cursor-pointer">
                                            <!--begin::Card title-->
                                            <div class="card-title m-0">
                                                <h3 class="fw-bold m-0">Dados da Empresa</h3>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <!--begin::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body p-9">
                                            <!--begin::Row-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-3 fw-semibold text-muted">Nome Fantasia</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-9">
                                                    <span class="fw-bold fs-6 text-gray-800"><input type="text"
                                                                                                    name="fname"
                                                                                                    class="form-control form-control-lg  mb-3 mb-lg-0"
                                                                                                    placeholder="Nome Fantasia da Empresa"
                                                                                                    value=""/></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->

                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-3 fw-semibold text-muted">Razão Social</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-9">
                                                    <span class="fw-bold fs-8 text-gray-800 me-2"><input
                                                                class="form-control" type="text"
                                                                placeholder="Razão Social da Empresa"
                                                                value=""></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-3 fw-semibold text-muted">CNPJ</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-9">
                                                    <span class="fw-bold fs-8 text-gray-800 me-2"><input
                                                                class="form-control" type="text"
                                                                placeholder="Digite somente os números"
                                                                value=""></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-3 fw-semibold text-muted">CEP / Logradouro / Nº</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-3">
                                                    <span class="fw-bold fs-8 text-gray-800 me-2"><input
                                                                class="form-control" type="text"
                                                                placeholder="Digite o CEP"
                                                                value=""></span>
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-lg-4">
                                                    <span class="fw-bold fs-8 text-gray-800 me-2"><input
                                                                class="form-control" type="text"
                                                                placeholder="Logradouro"
                                                                value=""></span>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-lg-2">
                                                    <span class="fw-bold fs-8 text-gray-800 me-2"><input
                                                                class="form-control" type="text"
                                                                placeholder="Número"
                                                                value=""></span>
                                                </div>
                                                <!--end::Col-->

                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-3 fw-semibold text-muted">Bairro / Cidade / UF</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-3">
                                                    <span class="fw-bold fs-8 text-gray-800 me-2"><input
                                                                class="form-control" type="text"
                                                                placeholder="Bairro"
                                                                value=""></span>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-lg-3">
                                                    <span class="fw-bold fs-8 text-gray-800 me-2"><input
                                                                class="form-control" type="text"
                                                                placeholder="Cidade"
                                                                value=""></span>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-lg-3">
                                                    <span class="fw-bold fs-8 text-gray-800 me-2"><input
                                                                class="form-control" type="text"
                                                                placeholder="UF"
                                                                value=""></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-3 fw-semibold text-muted"></label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-9">
                                                    <span class="fw-bold fs-6 text-gray-800 me-2"><button
                                                                class="btn btn-success"><?= icon("database"); ?> Salvar Dados da Empresa</button></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                </div>
                                <!--end::details View-->

                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <div id="kt_app_footer"
                         class="app-footer align-items-center justify-content-center justify-content-md-between flex-column flex-md-row py-3 js-footer">

                    </div>
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
                <?php if (false): ?>
                    <!--begin::aside-->
                    <div id="kt_app_aside" class="app-aside flex-column" data-kt-drawer="true"
                         data-kt-drawer-name="app-aside" data-kt-drawer-activate="{default: true, lg: false}"
                         data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="end"
                         data-kt-drawer-toggle="#kt_app_aside_mobile_toggle">
                        <!--begin::Wrapper-->
                        <div id="kt_app_aside_wrapper"
                             class="d-flex flex-column align-items-center hover-scroll-y py-5 py-lg-0 gap-4"
                             data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                             data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header"
                             data-kt-scroll-wrappers="#kt_app_aside_wrapper" data-kt-scroll-offset="5px">
                            <a href="#"
                               class="btn btn-icon btn-color-primary bg-hover-body h-45px w-45px flex-shrink-0 mb-4"
                               data-bs-toggle="tooltip" title="Calendar" data-bs-custom-class="tooltip-inverse">
                                <i class="ki-duotone ki-calendar-add fs-2qx">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </a>
                            <a href="../dist/account/overview.html"
                               class="btn btn-icon btn-color-warning bg-hover-body h-45px w-45px flex-shrink-0 mb-4"
                               data-bs-toggle="tooltip" title="Profile" data-bs-custom-class="tooltip-inverse">
                                <i class="ki-duotone ki-message-add fs-2qx">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </a>
                            <a href="../dist/apps/ecommerce/catalog/products.html"
                               class="btn btn-icon btn-color-info bg-hover-body h-45px w-45px flex-shrink-0 mb-4"
                               data-bs-toggle="tooltip" title="Products" data-bs-custom-class="tooltip-inverse">
                                <i class="ki-duotone ki-devices-2 fs-2qx">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </a>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::aside-->
                <?php endif; ?>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

<?php $v->start("JS"); ?>
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/pages/user-profile/general.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/widgets.bundle.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/widgets.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/apps/chat/chat.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/utilities/modals/create-account.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/utilities/modals/offer-a-deal/type.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/utilities/modals/offer-a-deal/details.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/utilities/modals/offer-a-deal/finance.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/utilities/modals/offer-a-deal/complete.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/utilities/modals/offer-a-deal/main.js"></script>
    <script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Custom Javascript-->

    <!--begin::Modules Javascript-->
    <script src="<?= url("/modules/PanelAccountCompanyData.js"); ?>" type="module"></script>
    <!--end::Modules Javascript-->

<?php $v->stop(); ?>