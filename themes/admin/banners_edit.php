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
                        <h1>Editar Banners</h1>
                    </div>
                </div>
                <!--/.row-->

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="card-title mb-0">Edição de Banners</h4>
                                <br>
                                <div class="row">
                                    <div class="col-sm-8 col-lg-8">
                                        <?= flash(); ?>
                                        <form class="upload" action="<?= url("/api/bannersUpdate"); ?>" method="post"
                                              enctype="multipart/form-data">
                                            <input type="hidden" name="code" value="<?= $banner->code; ?>">
                                            <?= csrf_input(); ?>
                                            <div class="form-group">
                                                <label for="">Título (Máx. 30 caracteres)</label>
                                                <input value="<?= $banner->title; ?>" type="text" name="title" class="form-control" maxlength="30">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Subtítulo (Máx. 30 caracteres)</label>
                                                <input value="<?= $banner->subtitle; ?>" type="text" name="subtitle" class="form-control" maxlength="30">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Descrição</label>
                                                <textarea id="bannerDescription" name="description" rows="5" class="form-control"><?= $banner->description; ?></textarea><br>
                                                <input type="text" id="cont" value="Restantes: 150" readonly="readonly" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Link</label>
                                                <input type="text" name="link" class="form-control" value="<?= $banner->link; ?>">
                                            </div>

                                            <div class="form-group">
                                                <img style="max-width: 200px;" src="<?= views_theme("front", "/img/hero/{$banner->img}"); ?>" alt="">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Imagem (1920px x 800px)</label>
                                                <input type="file" name="arquivo" class="form-control">
                                            </div>
                                            <div class="loadResult"></div>
                                            <button class="btn" style="background: #0b3162; color: #FFF;">Atualizar Banner</button>
                                        </form>
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