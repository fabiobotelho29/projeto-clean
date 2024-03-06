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
        <div class="col-8">
            <span class="banner_product_title">:: <?= $categoria->nome; ?> <br> <?= $produto->nome; ?></span> <br>
            <span class="banner_product_description">
                <?= $produto->descricao; ?> <br> <?= currency($produto->valor); ?>
            </span>
        </div>
        <div class="col-4" style="margin: auto  0">
            <img src="<?= url("/images/produtos/{$produto->imagem}"); ?>" alt="">
        </div>
    </div>
</div>
<!-- /BANNER -->
<form class="addProduct" action="<?= url("/addProduct"); ?>" method="post">
    <input type="hidden" name="product" value="<?= $produto->code; ?>">
    <input type="hidden" name="empresa" value="<?= $empresa->code; ?>">
    <?php if (!is_null($produto->opcionais)): ?>
        <?php if (strpos($produto->opcionais, ",")): ?>

            <?php
            /* Explodindo o array */
            $array_opcionais = explode(",", $produto->opcionais);

            foreach ($array_opcionais as $opcional) {
                $opcional = (new \Source\Models\Opcionais())->findById("{$opcional}");

                if ($opcional->disponivel == 'sim') {

                    ?>

                    <div class="container product_option">
                        <div class="row">
                            <div class="col-12 category">
                                <div class="title">
                                    <?= $opcional->categoria; ?>
                                    <span class="badge badge-<?= ($opcional->obrigatorio == 'sim' ? "danger" : "info"); ?>"><?= ($opcional->obrigatorio == 'sim' ? "OBRIGATÓRIO" : "OPCIONAL"); ?></span>
                                    <br>
                                    <span class="quant"><?= $opcional->qtde_permitida; ?> opção(ões)</span>
                                </div>

                                <?php
                                /* Girando as opções de cada opcional */
                                $opcoes = (new \Source\Models\Opcoes())->findByCategoriaId($opcional->id);

                                if (!empty($opcoes)) {
                                    foreach ($opcoes as $opcao) {
                                        if ($opcao->disponivel == 'sim') {
                                            ?>
                                            <div class="option">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="product_title">
                                                            <?= $opcao->opcional; ?> <br>
                                                            <span class="product_price">+ <?= currency($opcao->valor); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-4" style="text-align: center">
                                                        <input id="teste_<?= $opcao->id; ?>"
                                                               name="<?= $opcional->slug_categoria; ?><?= ($opcional->qtde_permitida > 1 ? "[]" : ""); ?>"
                                                               data-checkoptprice="<?= $opcao->valor; ?>"
                                                               data-allowqtde="<?= $opcional->qtde_permitida; ?>"
                                                               value="<?= $opcao->id; ?>"
                                                               type="checkbox">
                                                        <label for="teste_<?= $opcao->id; ?>"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } // if disponivel == sim

            }
            ?>

        <?php else: // não tem "," nos opcionais ?>
            <?php
            /* selecionando a categoria opcional */
            $opcional = (new \Source\Models\Opcionais())->findById($produto->opcionais);

            if ($opcional->disponivel == "sim") {
                ?>
                <div class="container product_option">
                    <div class="row">
                        <div class="col-12 category">
                            <div class="title">
                                <?= $opcional->categoria; ?>
                                <span class="badge badge-<?= ($opcional->obrigatorio == 'sim' ? "danger" : "info"); ?>"><?= ($opcional->obrigatorio == 'sim' ? "OBRIGATÓRIO" : "OPCIONAL"); ?></span>
                                <br>
                                <span class="quant"><?= $opcional->qtde_permitida; ?> opção(ões)</span>
                            </div>

                            <?php
                            /* Girando as opções de cada opcional */
                            $opcoes = (new \Source\Models\Opcoes())->findByCategoriaId($opcional->id);

                            if (!empty($opcoes)) {
                                foreach ($opcoes as $opcao) {
                                    if ($opcao->disponivel == 'sim') {
                                        ?>
                                        <div class="option">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="product_title">
                                                        <?= $opcao->opcional; ?> <br>
                                                        <span class="product_price">+ <?= currency($opcao->valor); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-4" style="text-align: center">
                                                    <input id="teste_<?= $opcao->id; ?>"
                                                           name="<?= $opcional->slug_categoria; ?><?= ($opcional->qtde_permitida > 1 ? "[]" : ""); ?>"
                                                           data-checkoptprice="<?= $opcao->valor; ?>"
                                                           data-allowqtde="<?= $opcional->qtde_permitida; ?>"
                                                           value="<?= $opcao->id; ?>"
                                                           type="checkbox">
                                                    <label for="teste_<?= $opcao->id; ?>"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        <?php endif; ?>
    <?php endif; ?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <span class="text_quant">OBSERVAÇÕES</span> <br>
                <textarea name="observacoes" rows="2" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <br>

    <div class="container-fluid" id="product_quant">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="text_quant">QUANTIDADE</span> <br>
                    <select name="prod_qtde" id="prod_qtde" class="form-control">
                        <?php for ($a = 1; $a <= 5; $a++): ?>
                            <option <?= ($a == 1 ? "selected" : ""); ?> value="<?= $a; ?>"><?= $a; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="product_footer">
        <div class="container">
            <div class="row">
                <?php if ($empresa->situacao == "open"): ?>
                    <div class="col-12 product_price_footer">
                        <table style="width: 100%">
                            <tr>
                                <td><span style="font-size: 0.85em; color: #CCC">CADA: <span
                                                class="total_product_price"><?= currency($produto->valor); ?></span> </span>
                                </td>
                                <td>SUBTOTAL: <span class="total_price"><?= currency($produto->valor); ?></span></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-12 product_footer_button">
                        <button class="btn btn-info btn-block btn-add"><?= icon("plus fa-fw"); ?>ADICIONAR AO PEDIDO
                        </button>
                    </div>
                <?php else: ?>
                    <div class="col-12 product_price_footer">
                        <table style="width: 100%">
                            <tr>
                                <td><span style="font-size: 0.85em; color: #CCC">CADA: <span
                                                class="total_product_price"><?= currency($produto->valor); ?></span> </span>
                                </td>
                                <td>SUBTOTAL: <span class="total_price"><?= currency($produto->valor); ?></span></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-12 product_footer_button">
                        <div
                                class="btn btn-danger btn-block btn-continue"><?= icon("times-circle-o fa-fw"); ?>LOJA
                            FECHADA
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</form>

