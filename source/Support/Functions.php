<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 09/10/2019
 * Time: 13:06
 */

/*****************
 ***   PAGES   ***
 *****************/


/**
 * PROTEGER PÁGINAS DO PANEL ADM
 */
function protect_admin_pages()
{
    if (!\Source\Core\LoginAdmin::user()) {
        session()->destroy();
        redirect(url());
    }
}

/**
 * @return string
 */
function required()
{
    return "<span style=\"font-variant: small-caps;color:#ccc; \"> * </span>";
}

/**
 * @param string $login
 * @return bool
 */
function check_login(string $login): bool
{
    /**
     * ^- inicia a expressão
     * $ - finaliza a expressão
     * [A-Z] - Letras de A a Z
     * [a-z] - letras de a a z
     * [0-9] - Numeros
     * {} - Ocorrências - ? {0,1} *{0,} +{1,}
     */
    /* padrão que contem letras min ou num ou underline */
    $pattern = "/^[a-z0-9_]+$/";

    if (preg_match($pattern, $login)) {
        return true;
    }
    return false;
}


/**
 * FUNÇÃO PARA CONVERTER VALORES EM REAIS PARA CENTAVOS
 * @param $valor
 * @return int
 */
function cents_convert($valor): int
{
    $centavos = $valor * 100;
    return $centavos;
}

/**
 * @return string
 */
function generic_code(): string
{
    // rand -> numero aleatório
    // uniqid -> retorna um identificador único prefixado baseado no tempo atual em microsegundos
    // md5 -> criptograda a sequencia
    // substr -> corta a string gerada em uma certa quantidade de caracteres
    $codigo = substr(md5(uniqid(rand(), true)), rand(1, 10), 10);
    return $codigo;
}

/**
 * @return string
 */
function password_generate(): string
{
    $codigo = substr(md5(uniqid(rand(), true)), rand(1, 10), 16);
    return $codigo;
}

function recover_generate(): string
{
    $codigo = substr(md5(uniqid(rand(), true)), rand(1, 10), 6);
    return $codigo;
}

function webhook_register($product, $event, $email, $payload){

// saving data into webhook
    $Conn = \Source\Core\Connect::getInstance()->query("
    insert into webhook (product, event, user_email, code) values (\"{$product}\", \"{$event}\", \"{$email}\", '$payload')
    ");

}

/**
 * @param $code
 * @return string
 */
function cript_code($code): string
{
    return base64_encode(KEY_CRIPT . $code);
}
/**
 * @param $code
 * @return string
 */
function decript_code($code): string
{
    return substr(base64_decode($code), -10);
}
