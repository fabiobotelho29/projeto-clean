<?php
$v->layout(VIEWS_MAIL_FILE, ["title" => "Recupere sua senha para acessar o " . SEO_SITE_NAME]);
?>


<h3>RECUPERAÇÃO DE SENHA</h3>
<p>Olá, <?= $user->first_name; ?>.</p>
<p>Você está recebendo este e-mail pois uma recuperação de senha foi solicitada a partir deste e-mail
    na <?= SEO_SITE_NAME; ?>.</p>
<p><b>IMPORTANTE:</b> Caso não tenha sido você quem solicitou, apenas ignore este e-mail. Seus dados permanecem
    seguros conosco mas recomendamos que altere sua senha, pois é provável que tenha alguém querendo roubá-la.</p>

<p>Mas caso tenha sido você mesmo, clique no botão abaixo para continuar o procedimento.</p>
<p><a style='padding: 5px 10px;
                                background-color: #1ab394;
                                color: #FFF;
                                text-decoration: none;
                                text-align: center;
                                border-radius: 3px;'
      title="Recuperar Senha"
      href="<?= url(); ?>">
        CLIQUE AQUI PARA CRIAR UMA NOVA SENHA
    </a>
</p>
<p>Código de validação: <b>123</b></p>


