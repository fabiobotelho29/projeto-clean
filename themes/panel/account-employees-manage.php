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
                                    <?php if (true): ?>
                                        <!--begin::Actions-->
                                        <a href="#" class="btn btn-sm btn-success ms-3 px-4 py-3" data-bs-toggle="modal"
                                           data-bs-target="#kt_modal_create_employee"><?= icon("user"); ?> Cadastrar Funcionário</a>
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

                                <!--begin::Table widget 13-->
                                <div class="card card-flush mb-5 mb-xl-8">
                                    <!--begin::Header-->
                                    <div class="card-header pt-7">
                                        <!--begin::Title-->
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-gray-800">Lista de Funcionários</span>
                                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Total <?= rand(10,50); ?></span>
                                        </h3>
                                        <!--end::Title-->

                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-3 pb-4">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 min-w-200px">Nome</th>
                                                    <th class="p-0 min-w-150px">Cargo</th>
                                                    <th class="p-0 min-w-125px">Login</th>
                                                    <th class="p-0 min-w-125px">Telefone</th>
                                                    <th class="p-0 min-w-125px">Nível</th>
                                                    <th class="p-0 w-100px">Acessar</th>
                                                </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol- symbol-40px me-3">
                                                                <img src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/media/avatars/300-<?= rand(1,10); ?>.jpg" class="" alt="" />
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="../dist/account/overview.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Brooklyn Simmons</a>
                                                                <span class="text-gray-400 fw-semibold d-block fs-7">Zuid Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 d-block mb-1 fs-6">Cooperador</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 d-block mb-1 fs-6">fabiobotelho29</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="text-gray-800 d-block mb-1 fs-6">
                                                            <i class="ki-duotone ki-whatsapp fs-3">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i> (21) 97568-7833</a>
                                                    </td>
                                                    <td class="border-0">
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-duotone ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-duotone ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-duotone ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-duotone ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-duotone ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                        <span class="text-gray-400 fw-semibold d-block fs-7 mt-1">Admin</span>
                                                    </td>
                                                    <td>
                                                        <a href="<?= url("/panel/account/employees/employee-data/".cript_code("ABC102030")); ?>" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-25px h-25px">
                                                            <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end: Card Body-->
                                </div>
                                <!--end::Table widget 13-->

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

<?php include "includes/modals/modal-create-employee.php"; ?>

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
    <script src="<?= url("/modules/PanelAccountEmployeesManage.js"); ?>" type="module"></script>
    <!--end::Modules Javascript-->

<?php $v->stop(); ?>