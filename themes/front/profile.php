<?php $v->layout(VIEWS_THEME_FRONT_FILE); ?>
<?php include('header.php'); ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Perfil</h4>
                        <div class="breadcrumb__links">
                            <a href="<?= url(); ?>">Início</a>
                            <span>Perfil</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="cart__discount">
                        <h6>Atualize seus dados de cadastro</h6>
                        <?= flash(); ?>
                        <?php if (!$user_session): ?>
                            <h3>Você precisa efetuar login para editar seus dados</h3>
                            <p></p>
                            <a href="<?= url('/login'); ?>" class="primary-btn">Efetuar Login</a>
                        <?php else: ?>
                            <form id="registerUser" action="<?= url("/api/updateUser"); ?>" method="post">
                                <?= csrf_input(); ?>
                                <div class="form-group">
                                    <label for="">Nome Completo</label>
                                    <input name="name" type="text" placeholder="Digite seu nome completo"
                                           class="form-control" value="<?= $user_session->name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input name="email" type="text" placeholder="Digite seu e-mail"
                                           class="form-control" value="<?= $user_session->email; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Senha (preencha somente caso queira alterar)</label>
                                    <input name="password" type="password" placeholder="Digite sua senha"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <div>
                                        <label for="document_type">Tipo de Documento</label>
                                    </div>
                                    <div>
                                        <select id="selTypeDocument" name="document_type" class="nice-select">
                                            <option value="">Selecione</option>
                                            <option <?= ($user_data ? ($user_data->document_type == 'cpf' ? 'selected' : '') : ''); ?> value="cpf">CPF</option>
                                            <option <?= ($user_data ? ($user_data->document_type == 'cnpj' ? 'selected' : '') : ''); ?> value="cnpj">CNPJ</option>
                                        </select>
                                        <input data-inputdocument name="document" type="number"
                                               placeholder="Digite somente os números"
                                               class="form-control numero" value="<?= ($user_data ? $user_data->document : ''); ?>">
                                    </div>
                                </div>
                                <div class="loadResult"></div>
                                <div class="form-group" style="margin-top: 20px">
                                    <input id="btn_clicked" type="submit" class="primary-btn" value="ATUALIZAR DADOS">
                                </div>
                            </form>
                        <?php endif; ?>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

<?php include('footer.php'); ?>

<?php include('search.php'); ?>