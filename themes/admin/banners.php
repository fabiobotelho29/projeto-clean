<?php $v->layout(VIEWS_THEME_ADMIN_DASH_FILE); ?>


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
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Banners</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body p-3 clearfix">
                                <i class="fa fa-image bg-primary p-3 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mt-2 mb-0"><?= rand(1,5); ?></div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">Banners</div>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->
                </div>
                <!--/.row-->

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="card-title mb-0">Cadastro de Banners</h4>
                                <br>
                                <div class="row">
                                    <div class="col-sm-8 col-lg-8">
                                        <form class="upload" action="<?= url("/api/bannersRegister"); ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_input(); ?>
                                            <div class="form-group">
                                                <label for="">Título</label>
                                                <input type="text" name="title" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Subtítulo</label>
                                                <input type="text" name="subtitle" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Descrição</label>
                                                <textarea name="description" rows="5" class="form-control"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Link</label>
                                                <input type="text" name="link" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Imagem (1920px x 800px)</label>
                                                <input type="file" name="arquivo" class="form-control">
                                            </div>
                                            <div class="loadResult"></div>
                                            <button class="btn" style="background: #0b3162; color: #FFF;">Cadastrar Banner</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="card-title mb-0">Lista de Banners Cadastrados</h4>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm">
                                                <thead>
                                                <tr>
                                                    <th>Título</th>
                                                    <th>Subtítulo</th>
                                                    <th>Status</th>
                                                    <th>Ações</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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