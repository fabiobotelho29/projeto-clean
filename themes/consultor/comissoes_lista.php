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
                                <div class="col">
                                    <ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                               href="#emaberto" role="tab" aria-controls="pills-home"
                                               aria-selected="true">EM ABERTO</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                               href="#recebidas" role="tab" aria-controls="pills-profile"
                                               aria-selected="false">RECEBIDAS</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="emaberto" role="tabpanel"
                                             aria-labelledby="pills-home-tab">

                                            <div class="table-responsive">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered datatable">
                                                        <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>EMPRESA</th>
                                                            <th>MENSALIDADE ID</th>
                                                            <th>DT. VENCTO.</th>
                                                            <th>VALOR DA MENS.</th>
                                                            <th>VALOR DA COMSS.</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $soma = 0; ?>
                                                        <?php if (!empty($comissoes_aberto)): ?>
                                                            <?php foreach ($comissoes_aberto as $comissao): ?>
                                                                <?php
                                                                /* SOMANDO AS COMISSÕES */
                                                                $soma += $comissao->valor_comissao;
                                                                ?>
                                                                <tr>
                                                                    <td><?= $comissao->id; ?></td>
                                                                    <td><?= $comissao->empresa()->nome_fantasia; ?></td>
                                                                    <td><?= $comissao->mensalidade_id; ?></td>
                                                                    <td><?= date_fmt_br($comissao->mensalidade_data_vencimento); ?></td>
                                                                    <td><?= currency($comissao->valor_mensalidade); ?></td>
                                                                    <td><?= currency($comissao->valor_comissao); ?></td>

                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade show" id="recebidas" role="tabpanel"
                                             aria-labelledby="pills-profile-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered datatable">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>EMPRESA</th>
                                                        <th>MENSALIDADE ID</th>
                                                        <th>DT. VENCTO.</th>
                                                        <th>DT. PGMENTO.</th>
                                                        <th>VALOR DA MENS.</th>
                                                        <th>VALOR DA COMSS.</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $soma = 0; ?>
                                                    <?php if (!empty($comissoes_pagas)): ?>
                                                        <?php foreach ($comissoes_pagas as $comissao): ?>
                                                            <?php
                                                            /* SOMANDO AS COMISSÕES */
                                                            $soma += $comissao->valor_comissao;
                                                            ?>
                                                            <tr>
                                                                <td><?= $comissao->id; ?></td>
                                                                <td><?= $comissao->empresa()->nome_fantasia; ?></td>
                                                                <td><?= $comissao->mensalidade_id; ?></td>
                                                                <td><?= date_fmt_br($comissao->mensalidade_data_vencimento); ?></td>
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
                                    </div>
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