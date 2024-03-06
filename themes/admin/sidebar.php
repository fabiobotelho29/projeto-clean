<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li style="text-align: center; padding: 10px 0">ADMINISTRAÇÃO</li>
            <li class="nav-item">
                <a class="nav-link" href="<?= url("/admin/dashboard"); ?>"><?= icon("dashboard"); ?> Dashboard </a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><?= icon("image"); ?> Banners</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("/admin/banners"); ?>">Gestão</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><?= icon("child"); ?> Produtos</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("/manager/planos/cadastro"); ?>">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("/manager/planos/lista"); ?>">Lista</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><?= icon("user"); ?> Pedidos</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("/manager/consultor/cadastro"); ?>">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("/manager/consultor/lista"); ?>">Lista</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= url("/admin/sair"); ?>"><?= icon("sign-out"); ?> Sair </a>
            </li>


        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>