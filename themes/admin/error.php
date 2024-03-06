<?php $v->layout(VIEWS_THEME_FRONT_FILE); ?>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 style="text-align: center">&bull; <?= $error->code; ?> &bull;</h1>
            <div style="background-color: #FFF; border: 1px solid #CCC; padding: 20px">
                <h2><?= $error->title; ?></h2>
                <p><?= $error->message; ?></p>
                <p><a href="<?= $error->link; ?>" class="btn btn-primary"><?= $error->linkTitle; ?></a></p>
            </div>
        </div>
    </div>
</div>
