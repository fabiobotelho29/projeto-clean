<!DOCTYPE html>
<html lang="pt_br">
<head>

    <?= $seo; ?>

    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- jquery alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <!-- own CSS -->
    <link href="<?= url("assets/css/styles.css"); ?>" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177312803-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-177312803-1');
    </script>


</head>

<?= $v->section("content"); ?>


<div class="loading">
    <p><i class="fa fa-cog fa-spin fa-4x"></i> <br><br>Aguarde, Carregando...</p>
</div>

<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script

<!-- bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<!-- font awesome -->
<script src="https://use.fontawesome.com/25da72bff4.js"></script>

<!-- jquery alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- own JS -->
<script src="<?= url("assets/components/scripts.components"); ?>"></script>

<?php if (!empty($cliente['forma_pagamento']) AND $cliente['forma_pagamento'] != 'dinheiro'  ): ?>
    <script>
        $(".input_troco").hide();
    </script>
<?php endif; ?>

<?= $v->section("components"); ?>


</body>
</html>