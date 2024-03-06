<?php $v->layout(VIEWS_THEME_DASH_FILE); ?>


<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">

<?php $v->insert("header.php"); ?>

<div class="app-body">

    <?php $v->insert("sidebar.php"); ?>

    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb"></ol>

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3 clearfix">
                                <i class="fa fa-dashboard bg-primary p-3 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mt-2 mb-0"><?= $empresas; ?></div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">EMPRESAS</div>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->

                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3 clearfix">
                                <i class="fa fa-dollar bg-primary p-3 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mt-2 mb-0"><?= (!is_null($comissoes_previsao) ? currency($comissoes_previsao) : currency(0)); ?></div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">PREVISÃO COMISSÃO (Mês)</div>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->

                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3 clearfix">
                                <i class="fa fa-dollar bg-primary p-3 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mt-2 mb-0"><?= (!is_null($comissoes_previsao) ? currency($comissoes_previsao) : currency(0)); ?></div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">COMISSÃO RECEBIDA (Mês)</div>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->
                </div>
                <!--/.row-->

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="card-title mb-0">Consultor: <?= $consultor->nome; ?></h4>
                                <br>
                                <?= flash(); ?>
                                <form action="" method="post">
                                    <?= csrf_input(); ?>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Nome Completo <?= required(); ?></label>
                                                <input style="text-transform: capitalize" class="form-control"
                                                       name="nome" placeholder="" value="<?= $consultor->nome; ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">E-mail <?= required(); ?></label>
                                                <input class="form-control"
                                                       name="email" placeholder="" value="<?= $consultor->email; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">CPF <?= required(); ?></label>
                                                <input class="form-control mask_cpf" name="cpf"
                                                       placeholder="Somente números" value="<?= $consultor->cpf; ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Whatsapp <?= required(); ?></label>
                                                <input class="form-control mask_celular" name="whatsapp"
                                                       placeholder="Digite somente os números com DDD."
                                                       value="<?= $consultor->whatsapp; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Banco</label>
                                                <select name="banco" id="" class="form-control">
                                                    <option value="001" <?= ($consultor->banco =="001" ? "selected" : ""); ?>>001 - Banco do Brasil</option>
                                                    <option value="003" <?= ($consultor->banco =="003" ? "selected" : ""); ?>>003 - Banco da Amazônia</option>
                                                    <option value="004" <?= ($consultor->banco =="004" ? "selected" : ""); ?>>004 - Banco do Nordeste</option>
                                                    <option value="021" <?= ($consultor->banco =="021" ? "selected" : ""); ?>>021 - Banestes</option>
                                                    <option value="025" <?= ($consultor->banco =="025" ? "selected" : ""); ?>>025 - Banco Alfa</option>
                                                    <option value="027" <?= ($consultor->banco =="027" ? "selected" : ""); ?>>027 - Besc</option>
                                                    <option value="029" <?= ($consultor->banco =="029" ? "selected" : ""); ?>>029 - Banerj</option>
                                                    <option value="031" <?= ($consultor->banco =="031" ? "selected" : ""); ?>>031 - Banco Beg</option>
                                                    <option value="033" <?= ($consultor->banco =="033" ? "selected" : ""); ?>>033 - Banco Santander Banespa</option>
                                                    <option value="036" <?= ($consultor->banco =="036" ? "selected" : ""); ?>>036 - Banco Bem</option>
                                                    <option value="037" <?= ($consultor->banco =="037" ? "selected" : ""); ?>>037 - Banpará</option>
                                                    <option value="038" <?= ($consultor->banco =="038" ? "selected" : ""); ?>>038 - Banestado</option>
                                                    <option value="039" <?= ($consultor->banco =="039" ? "selected" : ""); ?>>039 - BEP</option>
                                                    <option value="040" <?= ($consultor->banco =="040" ? "selected" : ""); ?>>040 - Banco Cargill</option>
                                                    <option value="041" <?= ($consultor->banco =="041" ? "selected" : ""); ?>>041 - Banrisul</option>
                                                    <option value="044" <?= ($consultor->banco =="044" ? "selected" : ""); ?>>044 - BVA</option>
                                                    <option value="045" <?= ($consultor->banco =="045" ? "selected" : ""); ?>>045 - Banco Opportunity</option>
                                                    <option value="047" <?= ($consultor->banco =="047" ? "selected" : ""); ?>>047 - Banese</option>
                                                    <option value="062" <?= ($consultor->banco =="062" ? "selected" : ""); ?>>062 - Hipercard</option>
                                                    <option value="063" <?= ($consultor->banco =="063" ? "selected" : ""); ?>>063 - Ibibank</option>
                                                    <option value="065" <?= ($consultor->banco =="065" ? "selected" : ""); ?>>065 - Lemon Bank</option>
                                                    <option value="066" <?= ($consultor->banco =="066" ? "selected" : ""); ?>>066 - Banco Morgan Stanley Dean Witter</option>
                                                    <option value="069" <?= ($consultor->banco =="069" ? "selected" : ""); ?>>069 - BPN Brasil</option>
                                                    <option value="070" <?= ($consultor->banco =="070" ? "selected" : ""); ?>>070 - Banco de Brasília – BRB</option>
                                                    <option value="072" <?= ($consultor->banco =="072" ? "selected" : ""); ?>>072 - Banco Rural</option>
                                                    <option value="073" <?= ($consultor->banco =="073" ? "selected" : ""); ?>>073 - Banco Popular</option>
                                                    <option value="074" <?= ($consultor->banco =="074" ? "selected" : ""); ?>>074 - Banco J. Safra</option>
                                                    <option value="075" <?= ($consultor->banco =="075" ? "selected" : ""); ?>>075 - Banco CR2</option>
                                                    <option value="076" <?= ($consultor->banco =="076" ? "selected" : ""); ?>>076 - Banco KDB</option>
                                                    <option value="077" <?= ($consultor->banco =="077" ? "selected" : ""); ?>>077 - Banco Inter S.A</option>
                                                    <option value="096" <?= ($consultor->banco =="096" ? "selected" : ""); ?>>096 - Banco BMF</option>
                                                    <option value="104" <?= ($consultor->banco =="104" ? "selected" : ""); ?>>104 - Caixa Econômica Federal</option>
                                                    <option value="107" <?= ($consultor->banco =="107" ? "selected" : ""); ?>>107 - Banco BBM</option>
                                                    <option value="116" <?= ($consultor->banco =="116" ? "selected" : ""); ?>>116 - Banco Único</option>
                                                    <option value="121" <?= ($consultor->banco =="121" ? "selected" : ""); ?>>121 - Banco Agibank S.A</option>
                                                    <option value="151" <?= ($consultor->banco =="151" ? "selected" : ""); ?>>151 - Nossa Caixa</option>
                                                    <option value="175" <?= ($consultor->banco =="175" ? "selected" : ""); ?>>175 - Banco Finasa</option>
                                                    <option value="184" <?= ($consultor->banco =="184" ? "selected" : ""); ?>>184 - Banco Itaú BBA</option>
                                                    <option value="204" <?= ($consultor->banco =="204" ? "selected" : ""); ?>>204 - American Express Bank</option>
                                                    <option value="208" <?= ($consultor->banco =="208" ? "selected" : ""); ?>>208 - Banco Pactual</option>
                                                    <option value="212" <?= ($consultor->banco =="212" ? "selected" : ""); ?>>212 - Banco Original S.A</option>
                                                    <option value="213" <?= ($consultor->banco =="213" ? "selected" : ""); ?>>213 - Banco Arbi</option>
                                                    <option value="214" <?= ($consultor->banco =="214" ? "selected" : ""); ?>>214 - Banco Dibens</option>
                                                    <option value="217" <?= ($consultor->banco =="217" ? "selected" : ""); ?>>217 - Banco Joh Deere</option>
                                                    <option value="218" <?= ($consultor->banco =="218" ? "selected" : ""); ?>>218 - Banco Digital BS2</option>
                                                    <option value="222" <?= ($consultor->banco =="222" ? "selected" : ""); ?>>222 - Banco Calyon Brasil</option>
                                                    <option value="224" <?= ($consultor->banco =="224" ? "selected" : ""); ?>>224 - Banco Fibra</option>
                                                    <option value="225" <?= ($consultor->banco =="225" ? "selected" : ""); ?>>225 - Banco Brascan</option>
                                                    <option value="229" <?= ($consultor->banco =="229" ? "selected" : ""); ?>>229 - Banco Cruzeiro</option>
                                                    <option value="230" <?= ($consultor->banco =="230" ? "selected" : ""); ?>>230 - Unicard</option>
                                                    <option value="233" <?= ($consultor->banco =="233" ? "selected" : ""); ?>>233 - Banco GE Capital</option>
                                                    <option value="237" <?= ($consultor->banco =="237" ? "selected" : ""); ?>>237 - Bradesco</option>
                                                    <option value="241" <?= ($consultor->banco =="241" ? "selected" : ""); ?>>241 - Banco Clássico</option>
                                                    <option value="243" <?= ($consultor->banco =="243" ? "selected" : ""); ?>>243 - Banco Stock Máxima</option>
                                                    <option value="246" <?= ($consultor->banco =="246" ? "selected" : ""); ?>>246 - Banco ABC Brasil</option>
                                                    <option value="248" <?= ($consultor->banco =="248" ? "selected" : ""); ?>>248 - Banco Boavista Interatlântico</option>
                                                    <option value="249" <?= ($consultor->banco =="249" ? "selected" : ""); ?>>249 - Investcred Unibanco</option>
                                                    <option value="250" <?= ($consultor->banco =="250" ? "selected" : ""); ?>>250 - Banco Schahin</option>
                                                    <option value="252" <?= ($consultor->banco =="252" ? "selected" : ""); ?>>252 - Fininvest</option>
                                                    <option value="254" <?= ($consultor->banco =="254" ? "selected" : ""); ?>>254 - Paraná Banco</option>
                                                    <option value="260" <?= ($consultor->banco =="260" ? "selected" : ""); ?>>260 - Nu Pagamentos S.A (Nubank)</option>
                                                    <option value="263" <?= ($consultor->banco =="263" ? "selected" : ""); ?>>263 - Banco Cacique</option>
                                                    <option value="265" <?= ($consultor->banco =="265" ? "selected" : ""); ?>>265 - Banco Fator</option>
                                                    <option value="266" <?= ($consultor->banco =="266" ? "selected" : ""); ?>>266 - Banco Cédula</option>
                                                    <option value="290" <?= ($consultor->banco =="290" ? "selected" : ""); ?>>290 - PagSeguro Internet S.A.</option>
                                                    <option value="300" <?= ($consultor->banco =="300" ? "selected" : ""); ?>>300 - Banco de la Nación Argentina</option>
                                                    <option value="318" <?= ($consultor->banco =="318" ? "selected" : ""); ?>>318 - Banco BMG</option>
                                                    <option value="320" <?= ($consultor->banco =="320" ? "selected" : ""); ?>>320 - Banco Industrial e Comercial</option>
                                                    <option value="323" <?= ($consultor->banco =="323" ? "selected" : ""); ?>>323 - Mercado Pago</option>
                                                    <option value="336" <?= ($consultor->banco =="336" ? "selected" : ""); ?>>336 - Banco Digital C6</option>
                                                    <option value="356" <?= ($consultor->banco =="356" ? "selected" : ""); ?>>356 - ABN Amro Real</option>
                                                    <option value="341" <?= ($consultor->banco =="341" ? "selected" : ""); ?>>341 - Itau</option>
                                                    <option value="347" <?= ($consultor->banco =="347" ? "selected" : ""); ?>>347 - Sudameris</option>
                                                    <option value="351" <?= ($consultor->banco =="351" ? "selected" : ""); ?>>351 - Banco Santander</option>
                                                    <option value="353" <?= ($consultor->banco =="353" ? "selected" : ""); ?>>353 - Banco Santander Brasil</option>
                                                    <option value="355" <?= ($consultor->banco =="355" ? "selected" : ""); ?>>355 - Banco Digio S.A</option>
                                                    <option value="366" <?= ($consultor->banco =="366" ? "selected" : ""); ?>>366 - Banco Societe Generale Brasil</option>
                                                    <option value="370" <?= ($consultor->banco =="370" ? "selected" : ""); ?>>370 - Banco WestLB</option>
                                                    <option value="376" <?= ($consultor->banco =="376" ? "selected" : ""); ?>>376 - JP Morgan</option>
                                                    <option value="389" <?= ($consultor->banco =="389" ? "selected" : ""); ?>>389 - Banco Mercantil do Brasil</option>
                                                    <option value="394" <?= ($consultor->banco =="394" ? "selected" : ""); ?>>394 - Banco Mercantil de Crédito</option>
                                                    <option value="399" <?= ($consultor->banco =="399" ? "selected" : ""); ?>>399 - HSBC</option>
                                                    <option value="409" <?= ($consultor->banco =="409" ? "selected" : ""); ?>>409 - Unibanco</option>
                                                    <option value="412" <?= ($consultor->banco =="412" ? "selected" : ""); ?>>412 - Banco Capital</option>
                                                    <option value="422" <?= ($consultor->banco =="422" ? "selected" : ""); ?>>422 - Banco Safra</option>
                                                    <option value="453" <?= ($consultor->banco =="453" ? "selected" : ""); ?>>453 - Banco Rural</option>
                                                    <option value="456" <?= ($consultor->banco =="456" ? "selected" : ""); ?>>456 - Banco Tokyo Mitsubishi UFJ</option>
                                                    <option value="464" <?= ($consultor->banco =="464" ? "selected" : ""); ?>>464 - Banco Sumitomo Mitsui Brasileiro</option>
                                                    <option value="477" <?= ($consultor->banco =="477" ? "selected" : ""); ?>>477 - Citibank</option>
                                                    <option value="479" <?= ($consultor->banco =="479" ? "selected" : ""); ?>>479 - Itaubank (antigo Bank Boston)</option>
                                                    <option value="487" <?= ($consultor->banco =="487" ? "selected" : ""); ?>>487 - Deutsche Bank</option>
                                                    <option value="488" <?= ($consultor->banco =="488" ? "selected" : ""); ?>>488 - Banco Morgan Guaranty</option>
                                                    <option value="492" <?= ($consultor->banco =="492" ? "selected" : ""); ?>>492 - Banco NMB Postbank</option>
                                                    <option value="494" <?= ($consultor->banco =="494" ? "selected" : ""); ?>>494 - Banco la República Oriental del Uruguay</option>
                                                    <option value="495" <?= ($consultor->banco =="495" ? "selected" : ""); ?>>495 - Banco La Provincia de Buenos Aires</option>
                                                    <option value="505" <?= ($consultor->banco =="505" ? "selected" : ""); ?>>505 - Banco Credit Suisse</option>
                                                    <option value="600" <?= ($consultor->banco =="600" ? "selected" : ""); ?>>600 - Banco Luso Brasileiro</option>
                                                    <option value="604" <?= ($consultor->banco =="604" ? "selected" : ""); ?>>604 - Banco Industrial</option>
                                                    <option value="610" <?= ($consultor->banco =="610" ? "selected" : ""); ?>>610 - Banco VR</option>
                                                    <option value="611" <?= ($consultor->banco =="611" ? "selected" : ""); ?>>611 - Banco Paulista</option>
                                                    <option value="612" <?= ($consultor->banco =="612" ? "selected" : ""); ?>>612 - Banco Guanabara</option>
                                                    <option value="613" <?= ($consultor->banco =="613" ? "selected" : ""); ?>>613 - Banco Pecunia</option>
                                                    <option value="623" <?= ($consultor->banco =="623" ? "selected" : ""); ?>>623 - Banco Pan Digital</option>
                                                    <option value="626" <?= ($consultor->banco =="626" ? "selected" : ""); ?>>626 - Banco Ficsa</option>
                                                    <option value="630" <?= ($consultor->banco =="630" ? "selected" : ""); ?>>630 - Banco Intercap</option>
                                                    <option value="633" <?= ($consultor->banco =="633" ? "selected" : ""); ?>>633 - Banco Rendimento</option>
                                                    <option value="634" <?= ($consultor->banco =="634" ? "selected" : ""); ?>>634 - Banco Triângulo</option>
                                                    <option value="637" <?= ($consultor->banco =="637" ? "selected" : ""); ?>>637 - Banco Sofisa</option>
                                                    <option value="638" <?= ($consultor->banco =="638" ? "selected" : ""); ?>>638 - Banco Prosper</option>
                                                    <option value="643" <?= ($consultor->banco =="643" ? "selected" : ""); ?>>643 - Banco Pine</option>
                                                    <option value="652" <?= ($consultor->banco =="652" ? "selected" : ""); ?>>652 - Itaú Holding Financeira</option>
                                                    <option value="653" <?= ($consultor->banco =="653" ? "selected" : ""); ?>>653 - Banco Indusval</option>
                                                    <option value="654" <?= ($consultor->banco =="654" ? "selected" : ""); ?>>654 - Banco A.J. Renner</option>
                                                    <option value="655" <?= ($consultor->banco =="655" ? "selected" : ""); ?>>655 - Banco Votorantim</option>
                                                    <option value="707" <?= ($consultor->banco =="707" ? "selected" : ""); ?>>707 - Banco Daycoval</option>
                                                    <option value="719" <?= ($consultor->banco =="719" ? "selected" : ""); ?>>719 - Banif</option>
                                                    <option value="721" <?= ($consultor->banco =="721" ? "selected" : ""); ?>>721 - Banco Credibel</option>
                                                    <option value="734" <?= ($consultor->banco =="734" ? "selected" : ""); ?>>734 - Banco Gerdau</option>
                                                    <option value="735" <?= ($consultor->banco =="735" ? "selected" : ""); ?>>735 - Banco Neon</option>
                                                    <option value="738" <?= ($consultor->banco =="738" ? "selected" : ""); ?>>738 - Banco Morada</option>
                                                    <option value="739" <?= ($consultor->banco =="739" ? "selected" : ""); ?>>739 - Banco Galvão de Negócios</option>
                                                    <option value="740" <?= ($consultor->banco =="740" ? "selected" : ""); ?>>740 - Banco Barclays</option>
                                                    <option value="741" <?= ($consultor->banco =="741" ? "selected" : ""); ?>>741 - BRP</option>
                                                    <option value="743" <?= ($consultor->banco =="743" ? "selected" : ""); ?>>743 - Banco Semear</option>
                                                    <option value="745" <?= ($consultor->banco =="745" ? "selected" : ""); ?>>745 - Banco Citibank</option>
                                                    <option value="746" <?= ($consultor->banco =="746" ? "selected" : ""); ?>>746 - Banco Modal</option>
                                                    <option value="747" <?= ($consultor->banco =="747" ? "selected" : ""); ?>>747 - Banco Rabobank International</option>
                                                    <option value="748" <?= ($consultor->banco =="748" ? "selected" : ""); ?>>748 - Banco Cooperativo Sicredi</option>
                                                    <option value="749" <?= ($consultor->banco =="749" ? "selected" : ""); ?>>749 - Banco Simples</option>
                                                    <option value="751" <?= ($consultor->banco =="751" ? "selected" : ""); ?>>751 - Dresdner Bank</option>
                                                    <option value="752" <?= ($consultor->banco =="752" ? "selected" : ""); ?>>752 - BNP Paribas</option>
                                                    <option value="753" <?= ($consultor->banco =="753" ? "selected" : ""); ?>>753 - Banco Comercial Uruguai</option>
                                                    <option value="755" <?= ($consultor->banco =="755" ? "selected" : ""); ?>>755 - Banco Merrill Lynch</option>
                                                    <option value="756" <?= ($consultor->banco =="756" ? "selected" : ""); ?>>756 - Banco Cooperativo do Brasil</option>
                                                    <option value="757" <?= ($consultor->banco =="757" ? "selected" : ""); ?>>757 - KEB</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Agência (Com Dígito) </label>
                                                <input type="text" name="agencia" class="form-control" value="<?= $consultor->agencia; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Tipo de Conta</label>
                                                <select name="tipo_conta" class="form-control" id="">
                                                    <option <?= ($consultor->tipo_conta == "corrente" ? "selected" : ""); ?> value="corrente">CORRENTE</option>
                                                    <option <?= ($consultor->tipo_conta == "poupanca" ? "selected" : ""); ?> value="poupanca">POUPANÇA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Conta (Com Dígito) </label>
                                                <input type="text" name="conta" class="form-control" value="<?= $consultor->conta; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary"><?= icon("refresh"); ?>Editar Meus Dados
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
                <!--/.card-->
            </div>

        </div>
        <!-- /.conainer-fluid -->
    </main>

</div>