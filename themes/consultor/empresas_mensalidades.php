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
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">
                                        <?= icon("plus"); ?> GERAR MENSALIDADE
                                    </button>
                                </div>
                                <br>
                                <div class="alert alert-danger">
                                    <?= icon("exclamation-triangle"); ?>GERAR A MENSALIDADE SOMENTE A PARTIR DO DIA <b>1º
                                        DO MÊS VIGENTE</b>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatable">
                                        <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>VENCIMENTO</th>
                                            <th>PAGAMENTO</th>
                                            <th>ENVIO</th>
                                            <th>LINK</th>
                                            <th>BOLETO</th>
                                            <th>TRANSAÇÃO</th>
                                            <th>STATUS</th>
                                            <th>BAIXAR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($mensalidades)): ?>
                                            <?php $contador = 1; ?>
                                            <?php foreach ($mensalidades as $mensalidade): ?>
                                                <tr>
                                                    <td><?= $contador; ?></td>
                                                    <td><?= date_fmt_br($mensalidade->data_vencimento); ?></td>
                                                    <td><?= (!is_null($mensalidade->data_pagamento) ? date_fmt_br($mensalidade->data_pagamento) : ""); ?></td>
                                                    <td><?= date_fmt_br($mensalidade->created_at); ?></td>
                                                    <td><a href="<?= $mensalidade->url_boleto; ?>" target="_blank" class="btn btn-sm btn-success"><?= icon("send"); ?></a></td>
                                                    <td><?= $mensalidade->numero_pedido; ?></td>
                                                    <td><?= $mensalidade->numero_transacao; ?></td>
                                                    <td><?= status_mensalidade($mensalidade->data_vencimento, $mensalidade->data_pagamento); ?></td>
                                                    <td>
                                                        <button
                                                                data-url="<?= url("/baixaMensalidade"); ?>"
                                                                data-transacao="<?= $mensalidade->numero_transacao; ?>"
                                                                data-mensalidade="true"
                                                                class="btn btn-info"><?= icon("check"); ?>BAIXAR</button>
                                                    </td>
                                                </tr>
                                                <?php $contador += 1; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </table>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cadastro de
                                                    Mensalidade</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $day = date("d");
                                                if ($day < DIA_VENCIMENTO_MENSALIDADES):
                                                    $prox_vencimento = date("Y-m-" . DIA_VENCIMENTO_MENSALIDADES);
                                                    $enviar_boleto = date("Y-m-d", strtotime("-5 days", strtotime(date($prox_vencimento))));
                                                else:
                                                    $prox_vencimento = date("Y-m-" . DIA_VENCIMENTO_MENSALIDADES, strtotime("+1 month", strtotime(date("Y-m-" . DIA_VENCIMENTO_MENSALIDADES))));
                                                    $enviar_boleto = date("Y-m-d", strtotime("-5 days", strtotime(date($prox_vencimento))));
                                                endif;
                                                ?>
                                                <form action="" method="post">
                                                    <?= csrf_input(); ?>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for=""><b>DATA DE VENCIMENTO</b></label>
                                                                <input type="date"
                                                                       value="<?= $prox_vencimento; ?>"
                                                                       name="data_vencimento" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for=""><b>VALOR</b></label>
                                                                <input type="text"
                                                                       value="<?= calcula_mensalidade(); ?>"
                                                                       name="valor" class="form-control maskMoney">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary"
                                                            type="submit"><?= icon("database"); ?>CADASTRAR MENSALIDADE
                                                    </button>
                                                </form>
                                                <div class="loadResult"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    <?= icon("close"); ?> Fechar
                                                </button>
                                            </div>
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
<?php $v->start("components"); ?>
<!-- Plugins and scripts required by this views -->
<script src="<?= views_theme("vendors/components/jquery.dataTables.min.components"); ?>"></script>
<script src="<?= views_theme("vendors/components/dataTables.bootstrap4.min.components"); ?>"></script>

<!-- Custom scripts required by this view -->
<script src="<?= views_theme("components/views/datatables.components"); ?>"></script>
<?php $v->end(); ?>

