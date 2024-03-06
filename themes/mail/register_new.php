<?php
$v->layout(MAIL_THEME_FILE, ["title" => $subject]);
?>

<h3>NOVO CADASTRO</h3>

<table>
    <tr>
        <td>CLIENTE</td>
        <td><?= $empresa->nome_fantasia; ?></td>
    </tr>
    <tr>
        <td>DATA DE CADASTRO</td>
        <td><?= date_fmt_br(); ?></td>
    </tr>
    <tr>
        <td>CONSULTOR</td>
        <td><?= $consultor->nome; ?></td>
    </tr>
</table>



