<?php $v->layout(VIEWS_THEME_FRONT_FILE); ?>

<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2><?= SEO_SITE_NAME; ?> - <?= SEO_SITE_SUBTITLE; ?></h2>
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1>Administração</h1>
                        <p class="text-muted">Acesse sua conta administrativa</p>
                        <form action="<?= url("/api/loginAdmin"); ?>" method="post">
                            <?= csrf_input(); ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </div>
                                <input type="text" autofocus name="email" class="form-control" placeholder="E-mail">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Senha Admin">
                            </div>
                            <div class="loadResult"></div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alert px-4" style="background: #0b3162; color: #FFF">Login</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white py-5 d-md-down-none" style="width:44%; background: #0b3162">
                    <div class="card-body text-center">
                        <div>
                            <?= image("/images/logo_inicio.png", 200); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
