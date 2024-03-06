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

                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatable">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>CONSULTOR</th>
                                            <th>EMPRESA</th>
                                            <th>MENSALIDADE ID</th>
                                            <th>DT. PAGAMENTO</th>
                                            <th>VALOR DA MENS.</th>
                                            <th>VALOR DA COMSS.</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $soma = 0; ?>
                                        <?php if (!empty($comissoes)): ?>
                                            <?php foreach ($comissoes as $comissao): ?>
                                                <?php
                                                /* SOMANDO AS COMISSÕES */
                                                $soma += $comissao->valor_comissao;
                                                ?>
                                                <tr>
                                                    <td><?= $comissao->id; ?></td>
                                                    <td><?= $comissao->consultor()->nome; ?></td>
                                                    <td><?= $comissao->empresa()->nome_fantasia; ?></td>
                                                    <td><?= $comissao->mensalidade_id; ?></td>
                                                    <td><?= date_fmt_br($comissao->data_pagamento); ?></td>
                                                    <td><?= currency($comissao->valor_mensalidade); ?></td>
                                                    <td><?= currency($comissao->valor_comissao); ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                        <hr>

                        <div class="row">
                            <div class="col-sm-12">
                                <div style="padding: 5px; text-transform: uppercase; font-size: 1em" class="badge badge-primary">Total Pago: <?= currency($soma); ?></div>
                            </div>
                        </div>
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

