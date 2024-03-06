<?php $v->layout(VIEWS_THEME_DASH_FILE); ?>

<?php $v->start("css"); ?>
<!-- Styles required by this views -->
<link href="<?= views_theme("vendors/css/dataTables.bootstrap4.min.css"); ?>" rel="stylesheet">
<?php $v->end(); ?>


<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">

<?php $v->insert("header.php"); ?>

<div class="app-body">

    <?php $v->insert("sidebar.php"); ?>

    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb"></ol>

        <div class="container-fluid">
            <?= flash(); ?>
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
                                <div>
                                    <a href="<?= url("/consultor/empresa/cadastro"); ?>" type="button" class="btn btn-primary">
                                        <?= icon("plus"); ?> NOVA
                                    </a>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatable">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOME FANTASIA</th>
                                            <th>WHATSAPP</th>
                                            <th>$ PGTO.</th>
                                            <th>CADASTRO</th>
                                            <th>DADOS</th>
                                            <th>LOJA</th>
                                            <th>PAINEL</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($empresas)): ?>
                                            <?php foreach ($empresas as $empresa): ?>

                                                <tr>
                                                    <td><?= $empresa->id; ?></td>
                                                    <td><?= $empresa->nome_fantasia; ?></td>
                                                    <td><?= $empresa->whatsapp; ?></td>
                                                    <td><?= status_empresa($empresa->status); ?></td>
                                                    <td><?= date_fmt_br($empresa->created_at); ?></td>
                                                    <td><a class="btn-success btn-sm"
                                                           href="<?= url("/consultor/empresa/detalhe/{$empresa->code}"); ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a></td>
                                                    <td>
                                                        <a href="<?= url("/{$empresa->slug}"); ?>" target="_blank">
                                                            <?= status_loja($empresa->situacao); ?>
                                                        </a>

                                                    </td>
                                                    <td>
                                                        <a class="btn-primary btn-sm" href="<?= url("/internalCompanyAccess/{$empresa->code}"); ?>" target="_blank">
                                                            <?= icon("send"); ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </table>
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
<?php $v->start("components"); ?>
<!-- Plugins and scripts required by this views -->
<script src="<?= views_theme("vendors/components/jquery.dataTables.min.components"); ?>"></script>
<script src="<?= views_theme("vendors/components/dataTables.bootstrap4.min.components"); ?>"></script>

<!-- Custom scripts required by this view -->
<script src="<?= views_theme("components/views/datatables.components"); ?>"></script>
<?php $v->end(); ?>

