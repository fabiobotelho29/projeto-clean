<?php
$v->layout(MAIL_THEME_FILE, ["title" => $subject]);
?>

<h3>CONFIRMAÇÃO DE CADASTRO</h3>
<p>Olá, <?= $empresa->nome_fantasia; ?>.</p>
<p>É muito bom ter vocês conosco e este é nosso primeiro contato.</p>
<p>Esperamos que tenham uma ótima experiência com o uso dos nossos sistemas e que ele auxilie muito
no seu fluxo de trabalho nos tornando verdadeiros parceiros.</p>
<p>Por ser um e-mail automático, não é necessário que seja respondido, mas
    ele serve para confirmar seu cadastro no <?= SEO_SITE_NAME; ?> seu <?= SEO_SITE_DESCRIPTION; ?>.</p>
<p>Nosso sistema de cobrança de mensalidade é bem simples:
    <ul>
    <li>No primeiro dia de cada mês, vocês receberão neste mesmo e-mail uma mensagem que conterá
    o link para pagamento no valor de <b><?= currency($empresa->mensalidade); ?></b>.</li>
    <li>Este pagamento deverá ser afetuado até o dia 05 do mês corrente.</li>
    <li>Caso esta data seja um fim de semana, o pagamento pode ser feito no próximo dia útil, sem problemas.</li>
    <li>Assim que confirmarmos o pagamento, sua mensalidade é computada e seu acesso ao <?= SEO_SITE_NAME; ?>
    permanece normal por aquele mês.</li>
    <li>No dia 10 o nosso sistema verifica as condições de todos os usuários (empresas) e caso note alguma
    irregularidade, ou seja, a não quitação da mensalidade do mês corrente, ele bloqueará o acesso.</li>
    <li>Caso isto ocorra, a própria mensagem enviada no dia 1º serve de auxílio para que possa efetuar o
    pagamento e tão logo ele seja confirmado, seu acesso será liberado novamente.</li>
</ul>
</p>
<hr>
<p>Para acessar nosso Sistema, use o seguinte usuário:
<ul>
    <li><b>Link de Acesso: </b> <a href="<?= url(); ?>" target="_blank"> <?= mb_strtoupper(SEO_SITE_NAME); ?></a></li>
    <li><b>Usuário: </b> <?= $login; ?></li>
    <li><b>Senha: </b> <?= $user_passwd; ?></li>
</ul>
</p>

<p>Por questões óbvias de segurança, este é um processo completamente automatizado, não sofrendo intervenção
humana.</p>
<p>É um prazer tê-los conosco.</p>



