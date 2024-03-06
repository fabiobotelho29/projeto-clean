<?php $v->layout(VIEWS_WEB_THEME_FRONT_FILE); ?>

<!-- TOP BAR -->
<div class="container" id="delivery_top_bar">
    <div class="row">
        <div class="col-12">
            <p class="top_address"><?= icon("map-marker"); ?>
                <a href="<?= str_maps($empresa->logradouro . "+" . $empresa->numero . "+" . $empresa->bairro . "+" . $empresa->municipio); ?>"
                   target="_blank" class="top_link">
                    <?= $empresa->nome_fantasia; ?>
                </a>

            </p>
        </div>
    </div>
</div>
<!-- /TOP BAR -->

<!-- BANNER -->
<div class="container" id="delivery_banner">
    <div class="row">
        <div class="col-5">
            <?php if (!empty($empresa->logomarca)): ?>
                <img src="<?= url("/images/logos/{$empresa->logomarca}"); ?>" class="img_logo">
            <?php else: ?>
                <img src="<?= url("/images/logos/logo-white.png"); ?>" class="img_logo">
            <?php endif; ?>
        </div>
        <div class="col-7">
            <div class="banner_whatsapp">
                <?= icon("whatsapp"); ?> <?= $empresa->whatsapp; ?>
            </div>
            <div class="banner_schedule">
                <span class="text_schedule"><?= icon("clock-o"); ?>HORÁRIO</span><br>
                Das <?= $empresa->horario_abertura; ?> às <?= $empresa->horario_fechamento; ?>
            </div>
        </div>
    </div>
</div>
<!-- /BANNER -->

<!-- CATEGORIES -->
<div class="container" id="delivery_categories">
    <div class="row">
        <div class="col-12">
            <select id="" class="form-control categories" data-scroll="true">
                <option value="">:: CATEGORIAS ::</option>
                <?php if (!empty($categorias)): ?>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria->slug; ?>"><?= $categoria->nome; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
    </div>
</div>
<!-- /CATEGORIES -->

<div class="filtro-fixo">
    <select id="" class="form-control categories" data-scroll="true">
        <option value="">:: CATEGORIAS ::</option>
        <?php if (!empty($categorias)): ?>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria->slug; ?>"><?= $categoria->nome; ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
</div>

<?php if ($empresa->situacao == "open"): ?>
    <?php if (!empty($categorias)): ?>
        <?php foreach ($categorias as $categoria): ?>

            <div class="container <?= $categoria->slug; ?> delivery_category">
                <div class="row">
                    <div class="col-12 category">
                        <div class="title">
                            :: <?= $categoria->nome; ?>
                        </div>

                        <?php
                        /* Girando os produtos dentro de cada categoria */
                        $produtos = (new \Source\Models\Produtos())->
                        find("empresa_id = :emp_id AND categoria_id = :cat_id AND disponivel = :d",
                            "emp_id={$empresa->id}&cat_id={$categoria->id}&d=sim")->
                        order('nome')->
                        fetch(true);
                        ?>
                        <?php if (!empty($produtos)): ?>
                            <?php foreach ($produtos as $produto): ?>
                                <div class="product" data-url="<?= url("/{$empresa->slug}/{$produto->code}"); ?>">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="product_title">
                                                <?= $produto->nome; ?>
                                            </div>
                                            <div class="product_description">
                                                <?= $produto->descricao; ?> <br><br>
                                                <?php if (!empty($produto->valor)): ?>
                                                <span class="product_price"><?= currency($produto->valor); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        <div class="col-4">
                                            <img src="<?= url("/images/produtos/{$produto->imagem}"); ?>"
                                                 class="product_image">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>

<div class="container-fluid" id="delivery_site_name">
    <div class="container">
        <div class="row-fluid">
            <div class="col-12 footer_site_name">
                <div class="row">
                    <div class="col-4">
                        <img style="margin: 0 auto; width: 70%; max-width: 70%" src="<?= url("/images/logo_delivery.png"); ?>" alt="">
                    </div>
                    <div class="col-8">
                        <?= SEO_SITE_NAME; ?> <br>
                        <a class="btn btn-sm btn-delivery" target="_blank" href="https://wa.me/5521976492587">CLIQUE E PEÇA O SEU</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


<div class="container-fluid" id="delivery_footer">
    <div class="container">
        <div class="row">
            <?php if ($empresa->situacao == "open"): ?>
                <div class="col-5 delivery_footer_left">
                    <span class="footer_price"><?= currency($valor_pedido); ?></span>
                </div>
                <div class="col-7 delivery_footer_right">
                    <a href="<?= url("/{$empresa->slug}/cart"); ?>"
                       class="btn btn-info btn-block btn-continue"><?= icon("shopping-cart fa-fw"); ?>MEU
                        PEDIDO </a>
                </div>
            <?php else: ?>
                <div class="col-12 delivery_footer_right">
                    <button
                            class="btn btn-danger btn-block btn-continue"><?= icon("times-circle-o fa-fw"); ?>LOJA FECHADA
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

