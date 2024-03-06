<?php

/**
 * #################
 * ###   RETURNS ###
 * #################
 */


/**
 * ###################
 * ###   BUTTONS   ###
 * ##################
 */

function btn(string $class, string $text, string $type = "button", string $icon = null)
{
    return "<button class=\"btn btn-{$class}\" type=\"{$type}\"><i class=\"fa fa-{$icon}\" fa-fw'></i> {$text}</button>";
}


/**
 * ##################
 * ###   STATUS   ###
 * ##################
 */

function status_planos(int $status): string
{
    if ($status == 1) {
        return "<span class='badge badge-success'>Ativo</span>";
    }

    return "<span class='badge badge-danger'>Inativo</span>";
}

/**
 * #################
 * ###   MOEDA   ###
 * #################
 */
function currency(?float $value)
{
    if ($value == null) {
        $value = 0;
    }
    return "R$ " . number_format($value, 2, ",", ".");
}

/**
 * @param float|null $value
 * @return string
 */
function currency_p(?float $value)
{
    if ($value == null) {
        $value = 0;
    }
    return number_format($value, 2, ",", ".");
}

/**
 * #################
 * ###   ICONS   ###
 * #################
 */
function icon(string $icon)
{
    return "<i class=\"fa fa-{$icon}\"></i> ";
}

/**
 * #################
 * ###   IMAGE   ###
 * #################
 */
function image(string $src, string $title = null, string $alt = null, string $width = "100%", string $class = null): string
{
    $image = "<img title=\"{$title}\" alt=\"{$alt}\" src='" . url($src) . "' style='max-width:" . $width . "' class='" . $class . "'>";
    return $image;
}

/**
 * ####################
 * ###   VALIDATE   ###
 * ####################
 */

/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $email
 * @return bool
 */
function is_phone(int $phone): bool
{
    $size = strlen($phone);

    if ($size != 11) {
        return false;
    }

    return filter_var($phone, FILTER_VALIDATE_INT);
}

/**
 * @param string $password
 * @return bool
 */
function is_passwd(string $password): bool
{
    if (password_get_info($password)['algo']) {
        return true;
    }

    return (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN ? true : false);
}

/**
 * @param string $password
 * @return string
 */
function passwd(string $password): string
{
    return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * @param string $hash
 * @return bool
 */
function passwd_rehash(string $hash): bool
{
    return password_needs_rehash($hash, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * @return string
 */
function csrf_input(): string
{
    session()->csrf();
    return "<input type='hidden' name='csrf' value='" . (session()->csrf_token ?? "") . "'/>";
}

/**
 * @param $request
 * @return bool
 */
function csrf_verify($request): bool
{
    if (empty(session()->csrf_token) || empty($request['csrf']) || $request['csrf'] != session()->csrf_token) {
        return false;
    }
    return true;
}

/**
 * @return null|string
 */
function flash(): ?string
{
    $session = new \Source\Core\Session();
    if ($flash = $session->flash()) {
        return $flash;
    }
    return null;
}


/**
 * ##################
 * ###   STRING   ###
 * ##################
 */

/**
 * @param string $string
 * @return string
 */
function str_slug(string $string): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    $slug = str_replace(["-----", "----", "---", "--"], "-",
        str_replace(" ", "-",
            trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
        )
    );
    return $slug;
}

/**
 * @param string $string
 * @return string
 */
function str_maps(string $string): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    $slug = str_replace(["-----", "----", "---", "--"], "+",
        str_replace(" ", "+",
            trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
        )
    );
    return "https://www.google.com/maps/search/" . $slug;
}

/**
 * @param string $string
 * @return string
 */
function str_whatsapp(string $string): string
{
    $whatsapp = str_replace([" ", "-", "(", ")"], "", $string);
    return $whatsapp;
}


/**
 * @param string $string
 * @return string
 */
function str_studly_case(string $string): string
{
    $string = str_slug($string);
    $studlyCase = str_replace(" ", "",
        mb_convert_case(str_replace("-", " ", $string), MB_CASE_TITLE)
    );

    return $studlyCase;
}

/**
 * @param string $string
 * @return string
 */
function str_camel_case(string $string): string
{
    return lcfirst(str_studly_case($string));
}

/**
 * @param string $string
 * @return string
 */
function str_title(string $string): string
{
    return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_words(string $string, int $limit, string $pointer = "..."): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    $arrWords = explode(" ", $string);
    $numWords = count($arrWords);

    if ($numWords < $limit) {
        return $string;
    }

    $words = implode(" ", array_slice($arrWords, 0, $limit));
    return "{$words}{$pointer}";
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_chars(string $string, int $limit, string $pointer = "..."): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    if (mb_strlen($string) <= $limit) {
        return $string;
    }

    $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));
    return "{$chars}{$pointer}";
}

/**
 * ############
 * ### URLs ###
 * ############
 */

/**
 * Retorna a URL da aplicação
 * @param string|null $path
 * @return string
 */
function url(string $path = null): string
{
    if (strpos($_SERVER["HTTP_HOST"], "localhost") !== false) {

        if ($path) {

            return URL_LOCAL . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return URL_LOCAL;
    }

    if (strpos($_SERVER["HTTP_HOST"], "test") !== false) {

        if ($path) {

            return URL_TEST . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return URL_TEST;
    }

    if ($path) {
        return URL_DEPLOY . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return URL_DEPLOY;
}

/**
 * Função de redirecionamento
 * @param string $url
 */
function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}



/**
 * Retorna a URL do tema
 * @param string|null $path
 * @return string
 */
function views_theme(string $theme, string $path = null): string
{
    if (strpos($_SERVER["HTTP_HOST"], "localhost") !== false) {

        if ($path) {

            return URL_LOCAL . "/themes/" . $theme . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return URL_LOCAL . "/themes/" . $theme;
    }

    if ($path) {
        return URL_DEPLOY . "/themes/" . $theme . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return URL_DEPLOY . "/themes/" . $theme;
}

/**
 * Retorna a URL do tema
 * @param string|null $path
 * @return string
 */
function consultor_theme(string $path = null): string
{
    if (strpos($_SERVER["HTTP_HOST"], "localhost") !== false) {

        if ($path) {

            return URL_LOCAL . "/themes/" . VIEWS_CONSULTOR_THEME . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return URL_LOCAL . "/themes/" . VIEWS_CONSULTOR_THEME;
    }

    if ($path) {
        return URL_DEPLOY . "/themes/" . VIEWS_CONSULTOR_THEME . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return URL_DEPLOY . "/themes/" . VIEWS_CONSULTOR_THEME;
}


/**
 * @param string|null $path
 * @return string
 */
function panel_theme(string $path = null): string
{
    if (strpos($_SERVER["HTTP_HOST"], "localhost") !== false) {

        if ($path) {

            return URL_LOCAL . "/themes/" . VIEWS_PANEL_THEME . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return URL_LOCAL . "/themes/" . VIEWS_PANEL_THEME;
    }

    if ($path) {
        return URL_DEPLOY . "/themes/" . VIEWS_PANEL_THEME . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return URL_DEPLOY . "/themes/" . VIEWS_PANEL_THEME;
}


/**
 * @param string|null $path
 * @return string
 */
function web_theme(string $path = null): string
{
    if (strpos($_SERVER["HTTP_HOST"], "localhost") !== false) {

        if ($path) {

            return URL_LOCAL . "/themes/" . VIEWS_WEB_THEME . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return URL_LOCAL . "/themes/" . VIEWS_WEB_THEME;
    }

    if ($path) {
        return URL_DEPLOY . "/themes/" . VIEWS_WEB_THEME . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return URL_DEPLOY . "/themes/" . VIEWS_WEB_THEME;
}


/**
 * ################
 * ###   DATE   ###
 * ################
 */

/**
 * @param string $date
 * @param string $format
 * @return string
 */
function date_post_fmt(string $date = "now", string $format = "d/m/Y H\hi"): string
{
    return (new DateTime($date))->format($format);
}

/**
 * @param string $date
 * @return string
 */
function date_hour_fmt_br(string $date = "now"): ?string
{
    if ($date == null) {
        return null;
    }
    return (new DateTime($date))->format(CONF_DATE_HOUR_BR);
}


/**
 * @param string $date
 * @return null|string
 */
function date_pedido(string $date = "now"): ?string
{
    if ($date == null) {
        return null;
    }
    return (new DateTime($date))->format("d/m/y H\hm");
}


/**
 * @param string $date
 * @return string
 */
function date_fmt_br(?string $date = "now"): ?string
{
    if ($date == null) {
        return null;
    }
    return (new DateTime($date))->format(CONF_DATE_BR);
}

/**
 * @param string $date
 * @return string
 */
function date_fmt_app(string $date = "now"): ?string
{
    if ($date == null) {
        return null;
    }
    return (new DateTime($date))->format(CONF_DATE_APP);
}

/**
 * @param string $date
 * @return string
 */
function date_hour_fmt_app(string $date = "now"): ?string
{
    if ($date == null) {
        return null;
    }
    return (new DateTime($date))->format(CONF_DATE_HOUR_APP);
}

/**
 * ################
 * ###   CORE   ###
 * ################
 */

/**
 * @return PDO
 */
function db(): PDO
{
    return \Source\Core\Connect::getInstance();
}

/**
 * @return \Source\Support\Message
 */
function message(): \Source\Support\Message
{
    return new \Source\Support\Message();
}

/**
 * @return \Source\Core\Session
 */
function session(): \Source\Core\Session
{
    return new \Source\Core\Session();
}

/**
 * ################
 * ###   DUMP   ###
 * ################
 */
function dump($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";

    die();
}

/**
 * #################
 * ###   MODEL   ###
 * #################
 */

