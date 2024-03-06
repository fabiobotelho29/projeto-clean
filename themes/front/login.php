<?php $v->layout(VIEWS_THEME_FRONT_FILE); ?>
<?php include('header.php'); ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Login</h4>
                        <div class="breadcrumb__links">
                            <a href="<?= url(); ?>">Início</a>
                            <span>Login</span>
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
                        <h6>Já tenho conta (LOGIN)</h6>
                        <?= flash(); ?>
                        <form action="<?= url("/api/loginUser"); ?>" method="post">
                            <?= csrf_input(); ?>
                            <div class="form-group">
                                <label for="">E-mail</label>
                                <input name="email" type="text" placeholder="Digite seu e-mail" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Senha</label>
                                <input name="password" type="password" placeholder="Digite sua senha" class="form-control">
                            </div>
                            <div class="loadResult"></div>
                            <div class="form-group" style="margin-top: 20px">
                                <input type="submit" class="primary-btn" value="ENTRAR">
                            </div>
                        </form>
                        <a href="<?= url("/forgot-password"); ?>" class="primary-btn">Esqueci a senha</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

<?php include('footer.php'); ?>

<?php include('search.php'); ?>