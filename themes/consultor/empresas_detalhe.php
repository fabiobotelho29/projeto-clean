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
                                            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#dados"
                                               role="tab" aria-controls="pills-home" aria-selected="true">DADOS</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill"
                                               href="#mensalidades" role="tab" aria-controls="pills-profile"
                                               aria-selected="false">MENSALIDADES</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade" id="dados" role="tabpanel"
                                             aria-labelledby="pills-home-tab">
                                            <?= flash(); ?>
                                            <p><b>Data de Cadastro: </b><?= date_fmt_br($empresa->created_at); ?></p>
                                            <form action="" method="post" id="cad-empresa" class="reset">
                                                <?= csrf_input(); ?>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="">Tipo de Pessoa <?= required(); ?></label>
                                                            <select data-tipopessoa="true" name="tipo_pessoa" id=""
                                                                    class="form-control">
                                                                <option value="">SELECIONE...</option>
                                                                <option <?= ($empresa->tipo_pessoa == "pf" ? "selected" : ""); ?>
                                                                        value="pf">Física
                                                                </option>
                                                                <option <?= ($empresa->tipo_pessoa == "pj" ? "selected" : ""); ?>
                                                                        value="pj">Jurídica
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="">Razão Social <?= required(); ?></label>
                                                            <input style="text-transform: capitalize"
                                                                   class="form-control"
                                                                   name="razao_social" placeholder=""
                                                                   value="<?= $empresa->razao_social; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="">Nome Fantasia <?= required(); ?></label>
                                                            <input style="text-transform: capitalize"
                                                                   class="form-control"
                                                                   name="nome_fantasia" placeholder=""
                                                                   value="<?= $empresa->nome_fantasia; ?>">
                                                        </div>
                                                    </div>
                                                    <?php if ($empresa->tipo_pessoa == "pj"): ?>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for=""
                                                                       class="label-pessoa">CNPJ <?= required(); ?></label>
                                                                <input class="form-control numero-pessoa mask_cnpj"
                                                                       name="documento"
                                                                       placeholder="Digite somente os números"
                                                                       value="<?= $empresa->documento; ?>">
                                                            </div>
                                                        </div>
                                                    <?php elseif ($empresa->tipo_pessoa == "pf"): ?>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for=""
                                                                       class="label-pessoa">CPF <?= required(); ?></label>
                                                                <input class="form-control numero-pessoa mask_cpf"
                                                                       name="documento"
                                                                       placeholder="Digite somente os números"
                                                                       value="<?= $empresa->documento; ?>">
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="">CEP <?= required(); ?></label>
                                                            <input id="cep" class="form-control mask_cep" name="cep"
                                                                   placeholder="Somente números"
                                                                   value="<?= $empresa->cep; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="">Logradouro <?= required(); ?></label>
                                                            <input id="logradouro" class="form-control"
                                                                   name="logradouro"
                                                                   placeholder="" value="<?= $empresa->logradouro; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="">Número <?= required(); ?></label>
                                                            <input id="numero" class="form-control" name="numero"
                                                                   placeholder=""
                                                                   value="<?= $empresa->numero; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="">Bairro <?= required(); ?></label>
                                                            <input id="bairro" class="form-control" name="bairro"
                                                                   placeholder=""
                                                                   value="<?= $empresa->bairro; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">Município <?= required(); ?></label>
                                                            <input id="municipio" class="form-control" name="municipio"
                                                                   placeholder="" value="<?= $empresa->municipio; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label for="">UF <?= required(); ?></label>
                                                            <input id="uf" class="form-control" name="uf" placeholder=""
                                                                   value="<?= $empresa->uf; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="">Telefone <?= required(); ?></label>
                                                            <input class="form-control mask_telefone" name="telefone"
                                                                   placeholder="Digite somente os números com DDD"
                                                                   value="<?= $empresa->telefone; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="">Whatsapp <?= required(); ?></label>
                                                            <input class="form-control mask_celular" name="whatsapp"
                                                                   placeholder="Digite somente os números com DDD."
                                                                   value="<?= $empresa->whatsapp; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="">Responsável <?= required(); ?></label>
                                                            <input class="form-control" name="responsavel"
                                                                   placeholder="Nome da pessoa responsável"
                                                                   value="<?= $empresa->responsavel; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="">E-mail <?= required(); ?></label>
                                                            <input class="form-control" name="email" placeholder=""
                                                                   value="<?= $empresa->email; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-primary"><?= icon("refresh"); ?>Atualizar
                                                        dados da
                                                        Empresa
                                                    </button>
                                                </div>
                                            </form>
                                        </div>


                                        <div class="tab-pane fade show active" id="mensalidades" role="tabpanel"
                                             aria-labelledby="pills-profile-tab">
                                            <?= flash(); ?>
                                            <p><b>Data de Cadastro: </b><?= date_fmt_br($empresa->created_at); ?></p>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered datatable">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>DATA VENCIMENTO</th>
                                                        <th>DATA PAGAMENTO</th>
                                                        <th>ORDER ID</th>
                                                        <th>TRANSAÇÃO</th>
                                                        <th>BOLETO</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if (!empty($mensalidades)): ?>
                                                        <?php foreach ($mensalidades as $mensalidade): ?>

                                                            <tr>
                                                                <td><?= $mensalidade->id; ?></td>
                                                                <td><?= date_fmt_br($mensalidade->data_vencimento); ?></td>
                                                                <td><?= (!empty($mensalidade->data_pagamento) ? date_fmt_br($mensalidade->data_pagamento) : ""); ?></td>
                                                                <td><?= $mensalidade->order_id; ?></td>
                                                                <td><?= $mensalidade->transaction_id; ?></td>

                                                                <td>
                                                                    <?php if (is_null($mensalidade->data_pagamento)): ?>
                                                                        <a class="btn-primary btn-sm"
                                                                           href="<?= $mensalidade->url_boleto; ?>"
                                                                           target="_blank"><?= icon("send"); ?></a>
                                                                    <?php else: ?>
                                                                        <?= icon("check"); ?>
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>

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