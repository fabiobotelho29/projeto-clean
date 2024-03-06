<!DOCTYPE html>
<html lang="zxx">

<head>

    <?= $seo; ?>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= views_theme("front", "/css/bootstrap.min.css"); ?>" type="text/css">
    <link rel="stylesheet" href="<?= views_theme("front", "css/font-awesome.min.css"); ?>" type="text/css">
    <link rel="stylesheet" href="<?= views_theme("front", "css/elegant-icons.css"); ?>" type="text/css">
    <link rel="stylesheet" href="<?= views_theme("front", "css/magnific-popup.css"); ?>" type="text/css">
    <link rel="stylesheet" href="<?= views_theme("front", "css/nice-select.css"); ?>" type="text/css">
    <link rel="stylesheet" href="<?= views_theme("front", "css/owl.carousel.min.css"); ?>" type="text/css">
    <link rel="stylesheet" href="<?= views_theme("front", "css/slicknav.min.css"); ?>" type="text/css">
    <link rel="stylesheet" href="<?= views_theme("front", "css/style.css"); ?>" type="text/css">

    <link rel="base" href="<?= url(); ?>">
</head>
<body>

<?= $v->section('content'); ?>

<!-- Js Plugins -->
<!-- <script src="<?= views_theme("front", "components/jquery-3.3.1.min.components"); ?>"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="<?= views_theme("front", "components/bootstrap.min.components"); ?>"></script>
<script src="<?= views_theme("front", "components/jquery.nice-select.min.components"); ?>"></script>
<script src="<?= views_theme("front", "components/jquery.nicescroll.min.components"); ?>"></script>
<script src="<?= views_theme("front", "components/jquery.magnific-popup.min.components"); ?>"></script>
<script src="<?= views_theme("front", "components/jquery.countdown.min.components"); ?>"></script>
<script src="<?= views_theme("front", "components/jquery.slicknav.components"); ?>"></script>
<script src="<?= views_theme("front", "components/mixitup.min.components"); ?>"></script>
<script src="<?= views_theme("front", "components/owl.carousel.min.components"); ?>"></script>
<script src="<?= views_theme("front", "components/main.components"); ?>"></script>
<script src="<?= url("assets/components/own_scripts.components"); ?>"></script>

<script>

    $(document).ready(function(){

        let activePage = $("#active-page").attr('title');
        $("li.menu").removeClass("active");
        $("li#menu-"+activePage).addClass('active');
       
    })
</script>

</body>

</html>