<?php
/**
 * CONTROLADOR DO PAINEL ADMIN
 * comment
 */

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Banners;


/**
 * Class FrontController
 * @package Source\Controllers
 */
class FrontController extends Controller
{
    /**
     * TestController constructor.
     */
    public function __construct()
    {
        $pathToViews = __DIR__ . "/../../themes/" . VIEWS_FRONT_THEME . "/";

        parent::__construct($pathToViews);

    }

    /**
     * #############################
     * ###  CONSTRUÇÃO DAS ROTAS ###
     * #############################
     */

    /**
     * FRONT HOME
     * @param array $data
     */
    public function home(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Home")
            ->favicon()->render();

        /* BANNERS */
        $banners = (new Banners())->find("status = 1")->fetch(true);

        echo $this->view->render(
            "home",
            [
                "seo" => $seo,
                "banners" => $banners
            ]
        );
    }

    public function login(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Login")
            ->favicon()->render();

        echo $this->view->render(
            "login",
            [
                "seo" => $seo,
            ]
        );
    }

    public function register(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Cadastro")
            ->favicon()->render();

        echo $this->view->render(
            "register",
            [
                "seo" => $seo,
            ]
        );
    }

    public function profile(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Perfil")
            ->favicon()->render();

        /** Checking session */
        if (isset(session()->user)){

            $user_session = session()->user;
            $user_data = $user_session->userData();

        }

        echo $this->view->render(
            "profile",
            [
                "seo" => $seo,
                "user_session" => $user_session,
                "user_data" => $user_data,
            ]
        );
    }

    public function contact(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Contato")
            ->favicon()->render();

        echo $this->view->render(
            "contact",
            [
                "seo" => $seo,
            ]
        );
    }

    public function store(?array $data): void
    {
        $seo = $this->seo->title(SEO_SITE_NAME . " | Loja")->favicon()->render();

        echo $this->view->render(
            "store",
            [
                "seo" => $seo,
            ]
        );
    }

    public function productDetail(?array $data): void
    {
        $seo = $this->seo->title(SEO_SITE_NAME . " | Produto")->favicon()->render();

        echo $this->view->render(
            "product-details",
            [
                "seo" => $seo,
            ]
        );
    }

    public function cart(?array $data): void
    {
        $seo = $this->seo->title(SEO_SITE_NAME . " | Carrinho")->favicon()->render();

        echo $this->view->render(
            "cart",
            [
                "seo" => $seo,
            ]
        );
    }

    public function checkout(?array $data): void
    {
        $seo = $this->seo->title(SEO_SITE_NAME . " | Finalizar Compra")->favicon()->render();

        echo $this->view->render(
            "checkout",
            [
                "seo" => $seo,
            ]
        );
    }


}