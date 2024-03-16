<?php
/**
 * CONTROLADOR DO PAINEL ADMIN
 */

namespace Source\Controllers;

use Source\Core\Connect;
use Source\Core\Controller;
use Source\Models\Users;

/**
 * Class Admin
 * @package Source\Controllers
 */
class PanelController extends Controller
{
    /**
     * TestController constructor.
     */

    /** @var Users */
    public $USER;

    public function __construct()
    {
        $pathToViews = __DIR__ . "/../../themes/" . VIEWS_PANEL_THEME . "/";
        parent::__construct($pathToViews);

        // checking login
        if (!session()->has('user')){
            session()->destroy();
            redirect("auth/login");
        }

        // user
        $this->USER = session()->user;
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

    public function dashboard(?array $data): void
    {
        $seo = $this->seo
            ->title(": : Dashboard")
            ->favicon()->render();

        echo $this->view->render(
            "dashboard",
            [
                "seo" => $seo,
            ]
        );
    }

    public function ProfileUserData(?array $data): void
    {

        $seo = $this->seo
            ->title(": : Perfil do Usuário")
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

    public function EmployeesManage(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Painel do Usuário")
            ->favicon()->render();

        echo $this->view->render(
            "account-employees-manage",
            [
                "seo" => $seo,
            ]
        );
    }

    public function EmployeeData(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Painel do Usuário")
            ->favicon()->render();

        echo $this->view->render(
            "account-employees-employee-data",
            [
                "seo" => $seo,
            ]
        );
    }

    public function testvue(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Painel do Usuário")
            ->favicon()->render();

        echo $this->view->render(
            "test-vue",
            [
                "seo" => $seo,
            ]
        );
    }
}