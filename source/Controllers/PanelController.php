<?php
/**
 * CONTROLADOR DO PAINEL ADMIN
 */

namespace Source\Controllers;

use Source\Core\Connect;
use Source\Core\Controller;

/**
 * Class Admin
 * @package Source\Controllers
 */
class PanelController extends Controller
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

    public function index(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " : : Dashboard")
            ->favicon()->render();

        echo $this->view->render(
            "index",
            [
                "seo" => $seo,
            ]
        );
    }

    public function ProfileUserData(?array $data): void
    {

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Painel do Usuário")
            ->favicon()->render();

        echo $this->view->render(
            "account-profile-user-data",
            [
                "seo" => $seo,
            ]
        );
    }

    public function ProfileChangePassword(?array $data): void
    {

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Painel do Usuário")
            ->favicon()->render();

        echo $this->view->render(
            "account-profile-change-password",
            [
                "seo" => $seo,
            ]
        );
    }
    public function CompanyData(?array $data): void
    {

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Painel do Usuário")
            ->favicon()->render();

        echo $this->view->render(
            "account-company-data",
            [
                "seo" => $seo,
            ]
        );
    }
}