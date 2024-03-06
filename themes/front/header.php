<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            <a href="<?= url("/login"); ?>"><i class="icon_folder-open"></i> Entrar</a>
            <a href="<?= url("/cadastro"); ?>"><i class="icon_lock"></i> Cadastrar</a>
            <!--            <a href="#">FAQs</a>-->
        </div>
        <?php if (1 == 0): ?>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <div class="offcanvas__nav__option">
        <a href="#" class="search-switch"><img src="<?= views_theme("front", "img/icon/search.png"); ?>" alt=""></a>
        <a href="#"><img src="<?= views_theme("front", "img/icon/heart.png"); ?>" alt=""></a>
        <a href="#"><img src="<?= views_theme("front", "img/icon/cart.png"); ?>" alt=""> <span>0</span></a>
        <div class="price">$10.00</div>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__text">
        <p><?= SEO_SITE_DESCRIPTION; ?>.</p>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p><?= SEO_SITE_DESCRIPTION; ?>.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                                <?php
                                if (session()->has('user')) {
                                    echo "<a href='".url('/perfil')."'><i class=\"icon_cart\"></i> " . session()->user->name . "</a>";
                                }
                                ?>
                            <a href="<?= url("/login"); ?>"><i class="icon_folder-open"></i> Entrar</a>
                            <a href="<?= url("/cadastro"); ?>"><i class="icon_lock"></i> Cadastrar</a>
                            <!--                            <a href="#">FAQs</a>-->
                        </div>
                        <?php if (1 == 0): ?>
                            <div class="header__top__hover">
                                <span>Usd <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li>USD</li>
                                    <li>EUR</li>
                                    <li>USD</li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="<?= url(); ?>"><img src="<?= url("images/logo_transparent_mini.png"); ?>" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li id="menu-home" class="menu active"><a href="<?= url(); ?>">Início</a></li>
                        <li id="menu-store" class="menu"><a href="<?= url("/loja"); ?>">Loja</a></li>
                        <?php if (1 == 0): ?>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./about.html">About Us</a></li>
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li class="menu"><a href="./blog.html">Blog</a></li>
                        <?php endif; ?>
                        <li id="menu-contact"><a href="<?= url("/contato"); ?>">Contato</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">

                    <!--                        <a href="#"><img src="-->
                    <? //= views_theme("front", "img/icon/heart.png"); ?><!--" alt=""></a>-->
                    <a href="#"><img src="<?= views_theme("front", "img/icon/cart.png"); ?>" alt=""> <span>0</span></a>
                    <div class="price">$0.00</div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
    <!-- /Menu -->
</header>
<!-- Header Section End -->