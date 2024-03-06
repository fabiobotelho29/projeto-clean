<?php
$v->layout(MAIL_THEME_FILE, ["title" => "Recupere sua senha para acessar o " . SEO_SITE_NAME]);
?>


<h3>ALTERAÇÃO DE SENHA</h3>
<p>Olá, <?= $user->login; ?>.</p>
<p>Você está recebendo este e-mail pois sua senha foi alterada na <?= SEO_SITE_NAME; ?>.</p>
<p><b>IMPORTANTE:</b> Caso tenha sido você mesmo quem alterou, apenas ignore este e-mail.</p>

<p>Mas caso NÃO tenha sido você, nos informe imediatamente através do e-mail <?= CONF_MAIL_SUPPORT_ADDRESS; ?>.</p>

