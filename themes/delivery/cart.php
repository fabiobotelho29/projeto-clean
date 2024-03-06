<?php $v->layout(VIEWS_WEB_THEME_FRONT_FILE); ?>

<!-- TOP BAR -->
<div class="container" id="product_top_bar">
    <div class="row">
        <div class="col-12">
            <p class="product_close"><a href="#" onclick="javascript:history.back();"
                                        class="btn btn-dark"> <?= icon("times"); ?> </a></p>
        </div>
    </div>
</div>
<!-- /TOP BAR -->

<!-- BANNER -->
<div class="container" id="product_banner">
    <div class="row">
        <div class="col-12">
            <span class="banner_checkout_title">RESUMO DO PEDIDO </span>
        </div>
    </div>
</div>
<!-- /BANNER -->

<div class="container product_option">
    <div class="row">
        <div class="col-12 category">
            <div class="title">
                RESUMO DO PEDIDO
            </div>
            <?php if (!empty($cart)): ?>
                <?php foreach ($cart as $key => $item): ?>
                    <div class="option">
                        <div class="row">
                            <div class="col-9">
                                <div class="product_title">
                                    (<?= $item['quantidade']; ?>) <?= $item['nome']; ?><br>
                                    <?php if (!empty($item['opcionais'])): ?>
                                        <?php
                                        $explode = explode("|", $item['opcionais']);
                                        foreach ($explode as $opcao):
                                            ?>
                                            <span class="product_price"><?= $opcao; ?></span> <br>
                                        <?php
                                        endforeach;
                                        ?>
                                    <?php endif; ?>
                                    <?php if (!empty($item['observacoes'])): ?>
                                    <span class="product_price">Observações: <?= $item['observacoes']; ?></span>
                                    <br>
                                    <?php endif; ?>

                                    <span class="product_price">Opcionais: <?= $item['quantidade']; ?>x <?= currency($item['valor_opcionais']); ?></span>
                                </div>
                            </div>
                            <div class="col-3" style="text-align: center">
                                <span class="checkout_price"><?= currency_p($item['valor']); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="#"
                                   data-url="<?= url("/removeProduct/{$empresa->code}"); ?>"
                                   data-indice="<?= $key; ?>"
                                   data-removeproduct="true"
                                >
                                    <span class="badge badge-info"><?= icon("times"); ?> REMOVER PRODUTO </span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<div class="container-fluid" id="cart_continue">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-info btn-block" href="<?= url("/{$empresa->slug}"); ?>"><?= icon("plus fa-fw"); ?>
                    CONTINUAR COMPRANDO</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" id="product_footer">
    <div class="container">
        <div class="row">
            <div class="col-12 product_price_footer">
                TOTAL: <?= currency($valor_pedido); ?>
            </div>
            <div class="col-12 product_footer_button">
                <a href="<?= url("/{$empresa->slug}/checkout"); ?>"
                   class="btn btn-info btn-block btn-add"><?= icon("check fa-fw"); ?>FINALIZAR PEDIDO </a>
            </div>
        </div>
    </div>

</div>


