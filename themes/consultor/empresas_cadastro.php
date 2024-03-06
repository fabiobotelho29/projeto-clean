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
                                <form action="" method="post" id="cad-empresa" class="reset">
                                    <?= csrf_input(); ?>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Tipo de Pessoa <?= required(); ?></label>
                                                <select data-tipopessoa="true" name="tipo_pessoa" id=""
                                                        class="form-control">
                                                    <option value="">SELECIONE...</option>
                                                    <option value="pf">Física</option>
                                                    <option value="pj">Jurídica</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Plano <?= required(); ?></label>
                                                <select data-tipopessoa="true" name="plano_id" id=""
                                                        class="form-control">
                                                    <option value="">SELECIONE...</option>
                                                    <?php if (!empty($planos)): ?>
                                                        <?php foreach ($planos as $plano): ?>
                                                            <option value="<?= $plano->id; ?>">
                                                                <?= $plano->nome; ?> |
                                                                Mens.: <?= currency($plano->mensalidade); ?> |
                                                                Comss.: <?= currency($plano->comissao); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Consultor <?= required(); ?></label>
                                                <input type="hidden" name="consultor_id" value="<?= $consultor->id; ?>">
                                                <input type="text" value="<?= $consultor->nome; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Razão Social <?= required(); ?></label>
                                                <input style="text-transform: capitalize" class="form-control"
                                                       name="razao_social" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Nome Fantasia <?= required(); ?></label>
                                                <input style="text-transform: capitalize" class="form-control"
                                                       name="nome_fantasia" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="label-pessoa"></label>
                                                <input class="form-control numero-pessoa" name="documento"
                                                       placeholder="Digite somente os números">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="">CEP <?= required(); ?></label>
                                                <input id="cep" class="form-control mask_cep" name="cep"
                                                       placeholder="Somente números">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Logradouro <?= required(); ?></label>
                                                <input id="logradouro" class="form-control" name="logradouro"
                                                       placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="">Número <?= required(); ?></label>
                                                <input id="numero" class="form-control" name="numero" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Bairro <?= required(); ?></label>
                                                <input id="bairro" class="form-control" name="bairro" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Município <?= required(); ?></label>
                                                <input id="municipio" class="form-control" name="municipio"
                                                       placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for="">UF <?= required(); ?></label>
                                                <input id="uf" class="form-control" name="uf" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Telefone <?= required(); ?></label>
                                                <input class="form-control mask_telefone" name="telefone"
                                                       placeholder="Digite somente os números com DDD">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Whatsapp <?= required(); ?></label>
                                                <input class="form-control mask_celular" name="whatsapp"
                                                       placeholder="Digite somente os números com DDD.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Responsável <?= required(); ?></label>
                                                <input class="form-control" name="responsavel"
                                                       placeholder="Nome da pessoa responsável">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">E-mail <?= required(); ?></label>
                                                <input class="form-control" name="email" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary"><?= icon("database"); ?>Cadastrar Empresa
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