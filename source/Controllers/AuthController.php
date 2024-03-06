<?php
/**
 * CONTROLADOR DO PAINEL ADMIN
 */

namespace Source\Controllers;

use Source\Core\Connect;
use Source\Core\Controller;

/**
 * Class AuthController
 * @package Source\Controllers
 */
class AuthController extends Controller
{
    /**
     * TestController constructor.
     */
    public function __construct()
    {
        $pathToViews = __DIR__ . "/../../themes/" . VIEWS_PANEL_THEME . "/";
        parent::__construct($pathToViews);
    }

    /**
     * #############################
     * ###  CONSTRUÇÃO DAS ROTAS ###
     * #############################
     */

    /**
     * ADMIN: ENTRAR
     * @param array $data
     */

    public function register(?array $data): void
    {

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Cadastro de Usuário")
            ->favicon()->render();

        echo $this->view->render(
            "authentication/sign-up/register",
            [
                "seo" => $seo,
            ]
        );
    }

    public function login(?array $data): void
    {

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Login")
            ->favicon()->render();

        echo $this->view->render(
            "authentication/sign-in/login",
            [
                "seo" => $seo,
            ]
        );
    }
}