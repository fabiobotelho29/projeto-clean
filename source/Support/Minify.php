<?php
/**
 * SUPPORT MINIFY FILE
 */
/* minificaremos os arquivos somente em ambiente de testes */
if (strpos(url(), "localhost")) {

    /**
     * JS
     */
    $minJS = new MatthiasMullie\Minify\JS();

    /* add components files */
//    $minJS->add(__DIR__ . "/../../shared/components/jquery.mask.components");
//    $minJS->add(__DIR__ . "/../../shared/components/MaskMoney.components.components");

    $minJS->add(__DIR__ . "/../../shared/js/jquery.mask.js");
    $minJS->add(__DIR__ . "/../../shared/js/MaskMoney.js");
    $minJS->add(__DIR__ . "/../../shared/js/scripts.js");

    // Minify JS
    $minJS->minify(__DIR__ . "/../../assets/js/own_scripts.js");// dir onde será minificado o arquivo

    /**
     * CSS
     */
    $minCSS = new MatthiasMullie\Minify\CSS();

    /* add css file */
    $minCSS->add(__DIR__ . "/../../shared/css/fonts.css");
    $minCSS->add(__DIR__ . "/../../shared/css/styles.css");


    /* minify CSS */
    $minCSS->minify(__DIR__ . "/../../assets/css/styles.css");


}