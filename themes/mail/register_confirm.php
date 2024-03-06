<?php
$v->layout(MAIL_THEME_FILE, ["title" => $subject]);
?>

<h3>CONFIRMAÇÃO DE CADASTRO</h3>
<p>Olá, <?= $empresa->nome_fantasia; ?>.</p>
<p>É muito bom ter vocês conosco e este é nosso primeiro contato.</p>
<p>Esperamos que tenham uma ótima experiência com o uso do nosso sistema e que ele auxilie muito
    no seu fluxo de trabalho nos tornando verdadeiros parceiros.</p>
<p>Por ser um e-mail automático, não é necessário que seja respondido, mas
    ele serve para confirmar seu cadastro no <?= SEO_SITE_NAME; ?>.</p>

<p>Nosso sistema de cobrança de mensalidade é bem simples:
<ul>
    <li>Você deve receber hoje ou amanhã um novo e-mail com o link de pagamento de sua primeira mensalidade no valor de
        sua mensalidade. Devemos lembrar que todos os boletos são acrescidos de sua taxa
        padrão de <?= currency(TAXA_BOLETO); ?>
    </li>
    <li>Sua próxima mensalidade terá vencimento <b>30 dias</b> após sua data de cadastro (<?= date_fmt_br($empresa->created_at); ?>) .</li>
    <li>Caso esta data seja um fim de semana, o pagamento pode ser feito no próximo dia útil, sem problemas.</li>
    <li>Assim que confirmarmos o pagamento, sua mensalidade é computada e seu acesso ao <?= SEO_SITE_NAME; ?>
        será renovado por um período de mais 30 dias.
    </li>
</ul>
</p>
<hr>
<p>Para acessar nosso Sistema, use o seguinte usuário:
<ul>
    <li><b>Link de Acesso: </b> <a href="<?= url("/{$empresa->slug}/panel"); ?>" target="_blank"> <?= mb_strtoupper(SEO_SITE_NAME); ?></a></li>
    <li><b>E-mail: </b> <?= $empresa->email; ?></li>
    <li><b>Senha: </b> <?= $senha; ?></li>
</ul>
</p>

<p>Neste link está uma cópia de nossos <a href="<?= url("/termo-de-uso.pdf"); ?>">TERMOS DE USO</a> e ao efetuar o pagamento da primeira mensalidade, você declara
que aceita todos os termos.</p>

<p>Por questões óbvias de segurança, este é um processo completamente automatizado, não sofrendo intervenção
    humana.</p>
<p>É um prazer tê-los conosco.</p>



