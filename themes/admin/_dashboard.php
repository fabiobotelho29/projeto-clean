<!DOCTYPE html>
<html lang="en">
<head>
    <?= $seo; ?>

    <!-- Icons -->
    <link href="<?= views_theme("admin", "vendors/css/flag-icon.min.css"); ?>" rel="stylesheet">
    <link href="<?= views_theme("admin", "vendors/css/font-awesome.min.css"); ?>" rel="stylesheet">
    <link href="<?= views_theme("admin", "vendors/css/simple-line-icons.min.css"); ?>" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="<?= views_theme("admin", "css/style.css"); ?>" rel="stylesheet">

    <!-- Styles required by this views -->
    <link href="<?= views_theme("admin", "vendors/css/daterangepicker.min.css"); ?>" rel="stylesheet">
    <link href="<?= views_theme("admin", "vendors/css/gauge.min.css"); ?>" rel="stylesheet">
    <link href="<?= views_theme("admin", "vendors/css/toastr.min.css"); ?>" rel="stylesheet">

    <?= $v->section("css"); ?>

    <!-- jquery alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <!-- own CSS -->
    <link href="<?= url("assets/css/styles.css"); ?>" rel="stylesheet">

</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Brand options
1. '.brand-minimized'       - Minimized brand (Only symbol)

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-minimized'			- Minimized Sidebar (Only icons)
5. '.sidebar-compact'			  - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Breadcrumb options
1. '.breadcrumb-fixed'			- Fixed Breadcrumb

// Footer options
1. '.footer-fixed'					- Fixed footer

-->
<?= $v->section("content"); ?>

<div class="loading">
    <p><i class="fa fa-cog fa-spin fa-4x"></i> <br><br>Aguarde, Carregando...</p>
</div>

<footer class="app-footer">
    <span><?= SEO_SITE_NAME;?> <?= SEO_SITE_SUBTITLE; ?> - <?= SEO_SITE_DESCRIPTION; ?></span>
    <span class="ml-auto">&copy; 2019 - <?= date("Y"); ?> - All Rights Reserved</span>
</footer>

<!-- Bootstrap and necessary plugins -->
<script src="<?= views_theme("admin", "vendors/components/jquery.min.components"); ?>"></script>
<script src="<?= views_theme("admin", "vendors/components/popper.min.components"); ?>"></script>
<script src="<?= views_theme("admin", "vendors/components/bootstrap.min.components"); ?>"></script>
<script src="<?= views_theme("admin", "vendors/components/pace.min.components"); ?>"></script>

<!-- Plugins and scripts required by all views -->
<script src="<?= views_theme("admin", "vendors/components/Chart.min.components"); ?>"></script>

<!-- CoreUI Pro main scripts -->

<script src="<?= views_theme("admin", "components/app.components"); ?>"></script>

<!-- Plugins and scripts required by this views -->
<script src="<?= views_theme("admin", "vendors/components/toastr.min.components"); ?>"></script>
<script src="<?= views_theme("admin", "vendors/components/gauge.min.components"); ?>"></script>
<script src="<?= views_theme("admin", "vendors/components/moment.min.components"); ?>"></script>
<script src="<?= views_theme("admin", "vendors/components/daterangepicker.min.components"); ?>"></script>

<!-- Custom scripts required by this view -->
<script src="<?= views_theme("admin", "components/views/main.components"); ?>"></script>

<?= $v->section("components"); ?>

<!-- jquery alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- own JS -->
<script src="<?= url("assets/components/own_scripts.components"); ?>"></script>

</body>
</html>