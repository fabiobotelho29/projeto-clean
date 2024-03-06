<?php $v->layout(VIEWS_THEME_FRONT_FILE); ?>
<?php include('header.php'); ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Cadastro</h4>
                        <div class="breadcrumb__links">
                            <a href="<?= url(); ?>">Início</a>
                            <span>Cadastro</span>
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
                        <h6>Ainda não tenho conta (CADASTRO)</h6>
                        <?= flash(); ?>
                        <form id="registerUser" action="<?= url("/api/registerUser"); ?>" method="post">
                            <?= csrf_input(); ?>
                            <div class="form-group">
                                <label for="">Nome Completo</label>
                                <input name="name" type="text" placeholder="Digite seu nome completo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">E-mail</label>
                                <input name="email" type="text" placeholder="Digite seu e-mail" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Senha (8 a 40 caracteres)</label>
                                <input name="password" type="password" placeholder="Digite sua senha" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Repita sua Senha</label>
                                <input name="re_password" type="password" placeholder="Digite sua senha novamente"
                                       class="form-control">
                            </div>
                            <div class="loadResult"></div>
                            <div class="form-group" style="margin-top: 20px">
                                <input id="btn_clicked" type="submit" class="primary-btn" value="CADASTRAR">
                            </div>
                        </form>
                        <a href="<?= url('/login'); ?>" class="primary-btn">Já tenho conta</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

<?php include('footer.php'); ?>

<?php include('search.php'); ?>