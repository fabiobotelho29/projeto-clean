<?php $v->layout(VIEWS_THEME_DASH_FILE); ?>


<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">

<?php $v->insert("header.php"); ?>

<div class="app-body">

    <?php $v->insert("sidebar.php"); ?>

    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb"></ol>

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <h4 class="card-title mb-0"><?= $page_title; ?></h4>
                                <div class="small text-muted"><?= $page_subtitle; ?></div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="" method="post">
                                    <?= csrf_input(); ?>
                                     <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Senha Atual <?= required(); ?></label>
                                                <input type="password" class="form-control"
                                                       name="senha_atual" placeholder="Digite a senha atual">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Nova Senha <?= required(); ?></label>
                                                <input type="password" class="form-control"
                                                       name="senha_nova" placeholder="Digite a nova senha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Repita Nova Senha <?= required(); ?></label>
                                                <input type="password" class="form-control"
                                                       name="senha_nova_repeat" placeholder="Repita a nova senha">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary"><?= icon("lock"); ?>Alterar a senha
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>
                </div>
                <!--/.card-->
            </div>

        </div>
        <!-- /.conainer-fluid -->
    </main>

</div>