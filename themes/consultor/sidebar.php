<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li style="text-align: center; padding: 10px 0">CONSULTOR</li>
            <li class="nav-item">
                <a class="nav-link" href="<?= url("/consultor/dashboard"); ?>"><?= icon("dashboard"); ?> Dashboard </a>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><?= icon("home"); ?> Empresas</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("/consultor/empresa/cadastro"); ?>">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("/consultor/empresa/lista"); ?>">Lista</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= url("/consultor/comissoes/lista"); ?>"><?= icon("dollar"); ?> Comissões </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= url("/consultor/alterar-senha"); ?>"><?= icon("lock"); ?> Alterar Senha </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= url("/consultor/sair"); ?>"><?= icon("sign-out"); ?> Sair </a>
            </li>


        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>