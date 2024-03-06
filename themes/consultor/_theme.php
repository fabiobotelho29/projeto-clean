<!DOCTYPE html>
<html lang="en">
<head>

    <?= $seo; ?>

    <!-- Icons -->
    <link href="<?= views_theme("vendors/css/font-awesome.min.css"); ?>" rel="stylesheet">
    <link href="<?= views_theme("vendors/css/simple-line-icons.min.css"); ?>" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="<?= views_theme("css/style.css"); ?>" rel="stylesheet">

    <!-- Styles required by this views -->

    <!-- jquery alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <!-- own CSS -->
    <link href="<?= url("assets/css/styles.css"); ?>" rel="stylesheet">

</head>

<?= $v->section("content"); ?>

<div class="loading">
    <p><i class="fa fa-cog fa-spin fa-4x"></i> <br><br>Aguarde, Carregando...</p>
</div>
<!-- Bootstrap and necessary plugins -->
<script src="<?= views_theme("vendors/components/jquery.min.components"); ?>"></script>
<script src="<?= views_theme("vendors/components/popper.min.components"); ?>"></script>
<script src="<?= views_theme("vendors/components/bootstrap.min.components"); ?>"></script>

<!-- jquery alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- own JS -->
<script src="<?= url("assets/components/scripts.components"); ?>"></script>
</body>
</html>