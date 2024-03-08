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
                                <!--begin::Navbar-->
                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-body pt-9 pb-0">
                                        <!--begin::Details-->
                                        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                                            <!--begin: Pic-->
                                            <div class="me-7 mb-4">
                                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                                    <img src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/media/avatars/300-3.jpg"
                                                         alt="image"/>
                                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                                </div>
                                            </div>
                                            <!--end::Pic-->
                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <!--begin::Title-->
                                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                                    <!--begin::User-->
                                                    <div class="d-flex flex-column">
                                                        <!--begin::Name-->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <a href="#"
                                                               class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">Fabio
                                                                C. Botelho</a>
                                                        </div>
                                                        <!--end::Name-->
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                                            <a href="#"
                                                               class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                                <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>Administrador</a>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Navs-->
                                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                                            <!--begin::Nav item-->
                                            <li class="nav-item mt-2">
                                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                                   data-bs-toggle="tab" data-bs-target="#kt_profile_details_view"
                                                   id="nav-home-tab"
                                                   href="../dist/account/overview.html">Dados Pessoais</a>
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item mt-2">
                                                <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                                   data-bs-toggle="tab" data-bs-target="#kt_logs_details_view"
                                                   id="nav-logs-tab"
                                                   href="#">Atividades</a>
                                            </li>
                                            <!--end::Nav item-->
                                        </ul>
                                        <!--begin::Navs-->
                                    </div>
                                </div>
                                <!--end::Navbar-->
                                <!--begin::details View-->
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="card mb-5 mb-xl-10 tab-pane fade show active"
                                         id="kt_profile_details_view" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <!--begin::Card header-->
                                        <div class="card-header cursor-pointer">
                                            <!--begin::Card title-->
                                            <div class="card-title m-0">
                                                <h3 class="fw-bold m-0">Dados Pessoais</h3>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <!--begin::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body p-9">
                                            <!--begin::Row-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Nome Completo</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800"><input type="text"
                                                                                                    name="fname"
                                                                                                    class="form-control form-control-lg  mb-3 mb-lg-0"
                                                                                                    placeholder="First name"
                                                                                                    value="Fabio C. Botelho"/></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->

                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Telefone de Contato
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                          title="Deve ser um número ativo">
													<i class="ki-duotone ki-information fs-7">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span></label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 d-flex align-items-center">
                                                    <span class="fw-bold fs-6 text-gray-800 me-2"><input
                                                                class="form-control" type="text"
                                                                value="94 987547855"></span>
                                                    <span class="badge badge-success">Verificado</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">E-mail</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 d-flex align-items-center">
                                                    <span class="fw-bold fs-6 text-gray-800 me-2"><input
                                                                class="form-control" type="text"
                                                                value="fabio@gmail.com"></span>
                                                    <span class="badge badge-success">Verificado</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">CPF</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800 me-2"><input
                                                                class="form-control" type="text" value=""
                                                                placeholder="Digite somente os números"></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted"></label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800 me-2"><button
                                                                class="btn btn-success"><?= icon("database"); ?> Salvar Dados</button></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                        </div>
                                        <!--end::Card body-->
                                    </div>

                                    <div class="card mb-5 mb-xl-10 tab-pane fade"
                                         id="kt_logs_details_view" role="tabpanel" aria-labelledby="nav-logs-tab">
                                        <!--begin::Card header-->
                                        <div class="card-header cursor-pointer">
                                            <!--begin::Card title-->
                                            <div class="card-title m-0">
                                                <h3 class="fw-bold m-0">Atividades do Usuário</h3>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <!--begin::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body p-9">
                                            <!--begin::Row-->
                                            <div class="row mb-7">
                                                <!--begin::Col-->
                                                <div class="col-xl-12">
                                                    <!--begin::Table Widget 5-->
                                                    <div class="card card-flush h-xl-100">
                                                        <!--begin::Card header-->
                                                        <div class="card-header pt-7">
                                                            <!--begin::Title-->
                                                            <h3 class="card-title align-items-start flex-column">
                                                                <span class="card-label fw-bold text-dark">Lista de Atividades</span>
                                                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Últimas 100 de um totao de 2.356 </span>
                                                            </h3>
                                                            <!--end::Title-->

                                                        </div>
                                                        <!--end::Card header-->
                                                        <!--begin::Card body-->
                                                        <div class="card-body">
                                                            <!--begin::Table-->
                                                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                                <!--begin::Table head-->
                                                                <thead>
                                                                <!--begin::Table row-->
                                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                                    <th class="min-w-150px">#ID</th>
                                                                    <th class="min-w-150px">Atividade</th>
                                                                    <th class="text-end pe-3 min-w-100px">Data</th>
                                                                </tr>
                                                                <!--end::Table row-->
                                                                </thead>
                                                                <!--end::Table head-->
                                                                <!--begin::Table body-->
                                                                <tbody class="fw-bold text-gray-600">
                                                                <tr>
                                                                    <!--begin::Product ID-->
                                                                    <td class="text">#35</td>
                                                                    <!--end::Product ID-->
                                                                    <!--begin::Product ID-->
                                                                    <td class="text">#XGY-356</td>
                                                                    <!--end::Product ID-->
                                                                    <!--begin::Date added-->
                                                                    <td class="text-end">02 Apr, 2023</td>
                                                                    <!--end::Date added-->
                                                                </tr>
                                                                </tbody>
                                                                <!--end::Table body-->
                                                            </table>
                                                            <!--end::Table-->
                                                        </div>
                                                        <!--end::Card body-->
                                                    </div>
                                                    <!--end::Table Widget 5-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->

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
    <script src="<?= url("/modules/panelAccountProfileUserdata.js"); ?>" type="module"></script>
    <!--end::Modules Javascript-->

<?php $v->stop(); ?>