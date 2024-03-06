<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>E-mail <?= SEO_SITE_NAME; ?></title>

</head>

<body style="background-color: #f6f6f6; padding: 20px">
<table>
    <tr>
        <td>
            <?= $v->section("content"); ?>
            <p>Atenciosamente, <?= SEO_SITE_NAME; ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <hr>
            <p>A <?= SEO_SITE_NAME; ?> jamais envia e-mails solicitando suas informações de cadastro. Caso você receba
                alguma mensagem desta natureza, descarte automaticamente.</p>
            <p><?= SEO_SITE_NAME; ?> &copy; 2019-<?= date("Y"); ?> Todos os direitos reservados.</p>
        </td>
    </tr>
</table>
</body>
</html>
