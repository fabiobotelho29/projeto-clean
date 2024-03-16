<?php $v->layout(VIEWS_THEME_PANEL_FILE); ?>

<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px positon-xl-relative">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                <!--begin::Header-->
                <div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20">
                    <!--begin::Logo-->
                    <a href="../dist/index.html" class="py-2 py-lg-20">
                        <img alt="Logo" src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/media/logos/mail.svg" class="h-40px h-lg-50px"/>
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 pb-md-10">Bem-Vindo(a) ao <?= SEO_SITE_NAME; ?></h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <p class="d-none d-lg-block fw-semibold fs-2 text-white">Acesse sua conta para
                        <br/>controlar seus<br> processos de lavagens</p>
                    <!--end::Description-->
                </div>
                <!--end::Header-->
                <!--begin::Illustration-->
                <div class="d-none d-lg-block d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                     style="background-image: url(assets/media/illustrations/sketchy-1/17.png)"></div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                        <formresetpassword />
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                <!--begin::Links-->
                <div class="d-flex flex-center fw-semibold fs-6">
                    <a href="https://devs.keenthemes.com" class="text-muted text-hover-primary px-2" target="_blank">F.A.Q.</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->

<?php $v->start("JS"); ?>
<!--begin::Custom Javascript(used for this page only)-->
<script src="<?= views_theme(VIEWS_PANEL_THEME); ?>/assets/js/custom/authentication/sign-in/general.js"></script>
<script type="module" src="<?= views_theme(VIEWS_PANEL_THEME); ?>/_vue/AuthResetPassword.js"></script>
<!--end::Custom Javascript-->
<?php $v->stop(); ?>
</body>
<!--end::Body-->
</html>