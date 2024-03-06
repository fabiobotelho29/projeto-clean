<?php $v->layout(VIEWS_WEB_THEME_FRONT_FILE); ?>

<!-- TOP BAR -->
<div class="container" id="product_top_bar">
    <div class="row">
        <div class="col-12">
            <p class="product_close">
                <a href="#" onclick="javascript:history.back();"
                   class="btn btn-dark"> <?= icon("times"); ?> </a>
            </p>
        </div>
    </div>
</div>
<!-- /TOP BAR -->

<!-- BANNER -->
<div class="container" id="product_banner">
    <div class="row">
        <div class="col-12">
            <span class="banner_checkout_title">FINALIZAR PEDIDO </span>
        </div>
    </div>
</div>
<!-- /BANNER -->

<form action="<?= url("/sendPedido"); ?>" method="post">
    <?= csrf_input(); ?>
    <input type="hidden" name="code" value="<?= $empresa->code; ?>">

    <div class="container product_option">
        <div class="row">
            <div class="col-12 category">
                <div class="title">
                    RECEBEDOR <span class="badge badge-danger">OBRIGATÓRIO</span>
                </div>
                <div class="option">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="nome" class="form-control" placeholder="Digite seu nome"
                                   value="<?= $cliente['nome'] ?? ""; ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="whatsapp" class="form-control mask_celular"
                                   placeholder="DDD + Whatsapp"
                                   value="<?= $cliente['whatsapp'] ?? ""; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container product_option">
        <div class="row">
            <div class="col-12 category">
                <div class="title">
                    ENDEREÇO para Entrega <span class="badge badge-danger">OBRIGATÓRIO</span>
                </div>
                <div class="option">
                    <div class="row">
                        <div class="col-12">
                            <input name="cep" type="text" class="form-control mask_cep" id="cep"
                                   placeholder="Digite o cep" value="<?= $cliente['cep'] ?? ""; ?>">
                            <small>Caso não saiba o CEP basta deixar em branco</small>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <input name="logradouro" type="text" class="form-control" id="logradouro"
                                   placeholder="Logradouro *" value="<?= $cliente['logradouro'] ?? ""; ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-5">
                            <input name="numero" type="text" class="form-control" id="numero" placeholder="Número *"
                                   value="<?= $cliente['numero'] ?? ""; ?>">
                        </div>
                        <div class="col-7">
                            <input name="complemento" type="text" class="form-control" id="complemento"
                                   placeholder="Complemento" value="<?= $cliente['complemento'] ?? ""; ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <select name="bairro" class="form-control" id="bairro_taxa">
                                <option value="">...BAIRRO</option>
                                <?php if (!empty($taxas)): ?>
                                    <?php foreach ($taxas as $taxa): ?>
                                        <option <?= ( (!empty($cliente['bairro']) AND $cliente['bairro'] == $taxa->slug) ? "selected" : "" ) ;?> value="<?= $taxa->slug; ?>"><?= $taxa->bairro; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?php if (1===0): ?>
                            <input name="bairro" type="text" class="form-control" placeholder="Bairro *"
                                   value="<?= $cliente['bairro'] ?? ""; ?>">
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <input name="municipio" type="text" class="form-control" id="municipio"
                                   placeholder="Cidade *" value="<?= $cliente['municipio'] ?? ""; ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <input name="ponto_referencia" type="text" class="form-control" id="ponto_referencia"
                                   placeholder="Ponto de Referência" value="<?= $cliente['ponto_referencia'] ?? ""; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container product_option">
        <div class="row">
            <div class="col-12 category">
                <div class="title">
                    FORMA DE ENVIO <span class="badge badge-danger">OBRIGATÓRIO</span>
                </div>
                <div class="option">
                    <div class="row">
                        <div class="col-12">
                            <select name="forma_envio" id="forma_envio" class="form-control">
                                <option value="local">Vou retirar no local</option>
                                <option value="entrega" selected>Entrega</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container product_option">
        <div class="row">
            <div class="col-12 category">
                <div class="title">
                    FORMA DE PAGAMENTO <span class="badge badge-danger">OBRIGATÓRIO</span>
                </div>
                <div class="option">
                    <div class="row">
                        <div class="col-12">
                            <select name="forma_pagamento" id="forma_pagamento" class="form-control">
                                <?php if (!empty($cliente['forma_pagamento'])): ?>
                                    <option <?= ($cliente['forma_pagamento'] == 'debito' ? "selected" : ""); ?>
                                            value="debito">Cartão de Débito
                                    </option>
                                    <option <?= ($cliente['forma_pagamento'] == 'credito' ? "selected" : ""); ?>
                                            value="credito">Cartão de Crédito
                                    </option>
                                    <option <?= ($cliente['forma_pagamento'] == 'dinheiro' ? "selected" : ""); ?>
                                            value="dinheiro">Dinheiro
                                    </option>
                                <?php else: ?>
                                    <option value="debito">Cartão de Débito</option>
                                    <option value="credito">Cartão de Crédito</option>
                                    <option value="dinheiro" selected>Dinheiro</option>
                                <?php endif; ?>

                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <input name="troco" class="form-control input_troco" type="number"
                                   placeholder="Troco para quanto?">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="<?= url("/{$empresa->slug}"); ?>"
                   class="btn btn-block btn-info"><?= icon("shopping-cart fa-fw"); ?>CONTINUAR COMPRANDO</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="<?= url("/{$empresa->slug}/cart"); ?>"
                   class="btn btn-block btn-info"><?= icon("check fa-fw"); ?>RESUMO DO PEDIDO</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 total">
                <div class="text_total">TOTAL DO PEDIDO</div>
                <div class="value_total">
                    <?= currency($valor_pedido); ?>
                </div>
                <?php if (1 === 0): ?>
                    <span class="taxa_entrega product_price"><?= (!empty($empresa->taxa_entrega) ? "Taxa de entrega: " . currency($empresa->taxa_entrega) : "Taxa de entrega: " . currency(0)); ?></span>
                    <br>
                <?php endif; ?>
                <?php if (!empty($empresa->taxa_entrega)): ?>
                <span class="badge" style="margin: 10px 0; background: #999; font-size: 0.9em; color: #FFF">Entrega grátis para pedidos acima de <?= currency($empresa->taxa_entrega); ?></span>
                    <br>
                <?php endif; ?>
                Taxa de Entrega: <span class="taxa_entrega product_price loadTaxaEntrega"></span>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <button style="height: 80px;" type="submit" class="btn btn-block btn-success"><?= icon("send fa-fw"); ?>
                    ENVIAR PEDIDO
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="<?= url("/cleanPedido/{$empresa->code}"); ?>" type="submit"
                   class="btn btn-block btn-default"><?= icon("trash fa-fw"); ?>LIMPAR CARRINHO</a>
            </div>
        </div>
    </div>
    <br>
</form>

<?php $v->start("components"); ?>
<script>
    /* checking bairro */
    function checkBairro() {

        bairro = $("#bairro_taxa");
        if (bairro.val() != "") {
            /* calculando a taxa de entrega */
            console.log(bairro.val());
            url = "<?= url("/loadTaxaEntrega"); ?>"
            dataset = {code: "<?= $empresa->code; ?>", bairro: bairro.val(), valorPedido: <?= $valor_pedido ?? "0.00"; ?>};

            $.ajax({
                url: url,
                data: dataset,
                type: 'POST',
                dataType: 'json',
                beforeSend: function () {
                    /* exibir classe loading */
                    $(".loading").fadeIn(400).css("display", "flex");
                },
                success: function (response) {
                    if (response.assincronus) {
                        $(".loadTaxaEntrega").html(response.assincronus);
                    }
                },
                complete: function (response) {
                    $(".loading").fadeOut(400).css("display", "none");
                    //console.clear();
                }
            });

        }
    }

    checkBairro()

    /* Rodando a busca da taxa caso digite cep */
    /*
    $(document).on("blur", "#cep", function (e) {
        e.preventDefault();

        setTimeout("checkBairro()", 2000);
    })
    */

    $(document).on("change", "#bairro_taxa", function (e) {
        e.preventDefault();
        setTimeout("checkBairro()", 2000);
    })
</script>
<?php $v->end(); ?>
