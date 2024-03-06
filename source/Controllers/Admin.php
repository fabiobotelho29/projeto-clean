<?php
/**
 * CONTROLADOR DO PAINEL ADMIN
 */

namespace Source\Controllers;

use Source\Core\Connect;
use Source\Core\Controller;
use Source\Core\LoginAdmin;
use Source\Core\View;
use Source\Models\Banners;
use Source\Models\Comissoes;
use Source\Models\Consultores;
use Source\Models\Empresas;
use Source\Models\Mensalidades;
use Source\Models\Planos;
use Source\Support\PagHiper;
use Source\Support\SwiftMail;

/**
 * Class Admin
 * @package Source\Controllers
 */
class Admin extends Controller
{
    /**
     * TestController constructor.
     */
    public function __construct()
    {
        $pathToViews = __DIR__ . "/../../themes/" . VIEWS_ADMIN_THEME . "/";
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

    public function login(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        echo $this->view->render(
            "login",
            [
                "seo" => $seo,
            ]
        );
    }

    /**
     * ADMIN: DASHBOARD
     */
    public function dashboard(): void
    {
        protect_admin_pages();
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        echo $this->view->render(
            "dashboard",
            [
                "seo" => $seo,
            ]
        );
    }

    public function banners(): void
    {
        protect_admin_pages();
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        /* BANNERS */
        $banners_obj = (new Banners())->find();
        $banners = $banners_obj->fetch(true);
        $banners_count = $banners_obj->count();

        echo $this->view->render(
            "banners",
            [
                "seo" => $seo,
                "banners" => $banners,
                "banners_count" => $banners_count,
            ]
        );
    }

    public function bannersUpdate(?array $data): void
    {
        protect_admin_pages();
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        /* BANNER */
        $banner = (new Banners())->findByCode($data['code']);


        echo $this->view->render(
            "banners_edit",
            [
                "seo" => $seo,
                "banner" => $banner,
            ]
        );
    }

    /**
     * ADMIN: CONSULTORES - CADASTRO
     * @param array|null $data
     */
    public function consultorCadastro(? array $data): void
    {

        protect_admin_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRIPPED);
            $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRIPPED);
            $whatsapp = filter_input(INPUT_POST, "whatsapp", FILTER_SANITIZE_STRIPPED);
            $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_STRIPPED);
            $banco = filter_input(INPUT_POST, "banco", FILTER_SANITIZE_STRIPPED);
            $agencia = filter_input(INPUT_POST, "agencia", FILTER_SANITIZE_STRIPPED);
            $tipo_conta = filter_input(INPUT_POST, "tipo_conta", FILTER_SANITIZE_STRIPPED);
            $conta = filter_input(INPUT_POST, "conta", FILTER_SANITIZE_STRIPPED);

            /* Formatando os campos */
            $nome = str_title($nome);
            $email = mb_strtolower($email);

            $consultor = (new Consultores())->bootstrap(
                "{$nome}",
                "{$email}",
                "{$senha}",
                "{$whatsapp}",
                "{$cpf}",
                "{$banco}",
                "{$agencia}",
                "{$tipo_conta}",
                "{$conta}"
            );

            if (!$consultor->save()) {
                $json['error'] = $consultor->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Consultor cadastrado com sucesso")->flash();
            $json['redirect'] = url("/manager/consultor/cadastro");
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Cadastro de Consultores";
        $page_subtitle = "Formulário para cadastro de novos consultores";

        /* Dados para a página */
        $consultores = (new Consultores())->find()->fetch(true);

        /* URL DE ACESSO */
        $url_acesso = "consultores_cadastro";

        echo $this->view->render(
            "{$url_acesso}",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "consultores" => $consultores,
            ]
        );
    }

    /**
     * ADMIN: CONSULTORES - LISTA
     * @param array|null $data
     */
    public function consultorLista(): void
    {

        protect_admin_pages();

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Lista de Consultores";
        $page_subtitle = "Lista de Consultores cadastrados";

        $list_consultores = (new Consultores())->find()->order("nome")->fetch(true);

        echo $this->view->render(
            "consultores_lista",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "consultores" => $list_consultores,
            ]
        );
    }

    /**
     * ADMIN: CONSULTORES - DETALHES
     * @param array|null $data
     */
    public function consultorDetalhes(? array $data): void
    {

        protect_admin_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRIPPED);
            $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRIPPED);
            $whatsapp = filter_input(INPUT_POST, "whatsapp", FILTER_SANITIZE_STRIPPED);
            $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_STRIPPED);
            $banco = filter_input(INPUT_POST, "banco", FILTER_SANITIZE_STRIPPED);
            $agencia = filter_input(INPUT_POST, "agencia", FILTER_SANITIZE_STRIPPED);
            $tipo_conta = filter_input(INPUT_POST, "tipo_conta", FILTER_SANITIZE_STRIPPED);
            $conta = filter_input(INPUT_POST, "conta", FILTER_SANITIZE_STRIPPED);

            /* Formatando os campos */
            $nome = str_title($nome);
            $email = mb_strtolower($email);

            /* selecionando o consultor */
            $consultor = (new Consultores())->findByCode($data['code']);

            /* dados alterados */
            $consultor->nome = $nome;
            $consultor->email = $email;
            $consultor->whatsapp = $whatsapp;
            $consultor->cpf = $cpf;
            $consultor->banco = $banco;
            $consultor->agencia = $agencia;
            $consultor->tipo_conta = $tipo_conta;
            $consultor->conta = $conta;

            /* verificando se a senha foi alterada */
            if ($senha != ""){
                if (is_passwd($senha)){
                    $consultor->senha = passwd($senha);
                } else {
                    $json['error'] = $this->message->error("A SENHA DEVE TER DE 8 A 40 CARACTERES")->render();
                    echo json_encode($json);
                    return;
                }
            }

            if (!$consultor->save()) {
                $json['error'] = $consultor->message()->render();
                echo json_encode($json);
                return;
            }

            $json['success'] = $this->message->success("Dados do Consultor atualizados com sucesso")->render();
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Dados do Consultor";
        $page_subtitle = "Formulário de Dados do Consultor";

        /* Dados para a página */
        $consultor = (new Consultores())->findByCode($data['code']);
        $empresas = (new Empresas())->find("consultor_id = :id", "id={$consultor->id}")->fetch(true);
        $comissoes = (new Comissoes())->find("consultor_id = :id", "id={$consultor->id}")->fetch(true);

        /* URL DE ACESSO */
        $url_acesso = "consultores_detalhe";

        echo $this->view->render(
            "{$url_acesso}",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "consultor" => $consultor,
                "empresas" => $empresas,
                "comissoes" => $comissoes,
            ]
        );
    }

    /**
     * ADMIN: PLANOS - CADASTRO
     * @param array|null $data
     */
    public function planosCadastro(? array $data): void
    {

        protect_admin_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRIPPED);
            $mensalidade = filter_input(INPUT_POST, "mensalidade", FILTER_SANITIZE_STRIPPED);
            $comissao = filter_input(INPUT_POST, "comissao", FILTER_SANITIZE_STRIPPED);

            $plano = (new Planos())->bootstrap(
                "{$nome}",
                "{$mensalidade}",
                "{$comissao}"
            );

            if (!$plano->save()) {
                $json['error'] = $plano->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Plano cadastrado com sucesso")->flash();
            $json['redirect'] = url("/manager/planos/lista");
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Cadastro de Planos";
        $page_subtitle = "Formulário para cadastro de novos planos";

        /* Dados para a página */
        $planos = (new Planos())->find()->fetch(true);

        /* URL DE ACESSO */
        $url_acesso = "planos_cadastro";


        echo $this->view->render(
            "{$url_acesso}",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "planos" => $planos,
            ]
        );
    }

    /**
     * ADMIN: PLANOS - LISTA
     * @param array|null $data
     */
    public function planosLista(? array $data): void
    {

        protect_admin_pages();

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Lista de Planos";
        $page_subtitle = "Lista de Planos cadastrados";

        $list_planos = (new Planos())->find()->order("nome")->fetch(true);

        echo $this->view->render(
            "planos_lista",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "planos" => $list_planos,
            ]
        );
    }

    /**
     * ADMIN: PLANOS - DETALHES
     * @param array|null $data
     */
    public function planosDetalhes(? array $data): void
    {

        protect_admin_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRIPPED);
            $mensalidade = filter_input(INPUT_POST, "mensalidade", FILTER_SANITIZE_STRIPPED);
            $comissao = filter_input(INPUT_POST, "comissao", FILTER_SANITIZE_STRIPPED);

            $plano = (new Planos())->findByCode($data['code']);

            $plano->nome = $nome;
            $plano->mensalidade = $mensalidade;
            $plano->comissao = $comissao;

            if (!$plano->save()) {
                $json['error'] = $plano->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Plano atualizado com sucesso")->flash();
            $json['redirect'] = url("/manager/planos/detalhe/{$data['code']}");
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Dados do Plano";
        $page_subtitle = "Formulário de Dados do Plano";

        /* Dados para a página */
        $plano = (new Planos())->findByCode($data['code']);

        /* URL DE ACESSO */
        $url_acesso = "planos_detalhe";


        echo $this->view->render(
            "{$url_acesso}",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "plano" => $plano,
            ]
        );
    }

    /**
     * ADMIN: EMPRESAS - CADASTRO
     * @param array|null $data
     */
    public function empresaCadastro(? array $data): void
    {

        protect_admin_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $tipo_pessoa = filter_input(INPUT_POST, "tipo_pessoa", FILTER_SANITIZE_STRIPPED);
            $consultor_id = filter_input(INPUT_POST, "consultor_id", FILTER_VALIDATE_INT);
            $plano_id = filter_input(INPUT_POST, "plano_id", FILTER_VALIDATE_INT);
            $razao_social = filter_input(INPUT_POST, "razao_social", FILTER_SANITIZE_STRIPPED);
            $nome_fantasia = filter_input(INPUT_POST, "nome_fantasia", FILTER_SANITIZE_STRIPPED);
            $documento = filter_input(INPUT_POST, "documento", FILTER_SANITIZE_STRIPPED);
            $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRIPPED);
            $logradouro = filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_STRIPPED);
            $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_STRIPPED);
            $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRIPPED);
            $municipio = filter_input(INPUT_POST, "municipio", FILTER_SANITIZE_STRIPPED);
            $uf = filter_input(INPUT_POST, "uf", FILTER_SANITIZE_STRIPPED);
            $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRIPPED);
            $whatsapp = filter_input(INPUT_POST, "whatsapp", FILTER_SANITIZE_STRIPPED);
            $responsavel = filter_input(INPUT_POST, "responsavel", FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRIPPED);

            /* Formatando os campos */
            $razao_social = str_title($razao_social);
            $nome_fantasia = str_title($nome_fantasia);
            $logradouro = str_title($logradouro);
            $bairro = str_title($bairro);
            $municipio = str_title($municipio);
            $email = mb_strtolower($email);
            $uf = mb_strtoupper($uf);

            /* validando o consultor_id */
            if (!is_int($consultor_id)){
                $json['error'] = $this->message->error("SELECIONE UM CONSULTOR")->render();
                echo json_encode($json);
                return;
            }

            $empresa = (new Empresas())->bootstrap(
                "{$tipo_pessoa}",
                "{$consultor_id}",
                "{$plano_id}",
                "{$razao_social}",
                "{$nome_fantasia}",
                "{$documento}",
                "{$cep}",
                "{$logradouro}",
                "{$numero}",
                "{$bairro}",
                "{$municipio}",
                "{$uf}",
                "{$telefone}",
                "{$whatsapp}",
                "{$responsavel}",
                "{$email}",
                1
            );

            /* GERANDO SLUG DA EMPRESA */
            $slug = str_slug($empresa->nome_fantasia);
            $empresa->slug = $slug;

            /* GERANDO A SENHA */
            $senha = gera_senha();
            $empresa->senha = passwd($senha);

            if (!$empresa->save()) {
                $json['error'] = $empresa->message()->render();
                echo json_encode($json);
                return;
            }

            $subject = "[" . SEO_SITE_NAME . "] - Confirmação de Cadastro";
            $mail_view = new View(MAIL_PATH);
            $body = $mail_view->render("register_confirm", [
                "empresa" => $empresa,
                "subject" => $subject,
                "senha" => $senha,
            ]);
            $recipient = $email;
            $recipient_name = $nome_fantasia;


            /* Enviando e-mail de cadastro */
            $mail = (new SwiftMail())->bootstrap(
                "{$subject}",
                "{$body}",
                "{$recipient}",
                "{$recipient_name}"
            )->queue();

            /* E-MAIL DE CADASTRO */

            /* selecionando o consultor */
            $consultor = (new Consultores())->findById($consultor_id);

            $subject = "[" . SEO_SITE_NAME . "] - Novo Cadastro";
            $mail_view = new View(MAIL_PATH);
            $body = $mail_view->render("register_new", [
                "empresa" => $empresa,
                "consultor" => $consultor,
                "subject" => $subject,
            ]);
            $recipient = CONF_MAIL_REGISTER;
            $recipient_name = SEO_SITE_NAME;


            /* Enviando e-mail de cadastro */
            $mail = (new SwiftMail())->bootstrap(
                "{$subject}",
                "{$body}",
                "{$recipient}",
                "{$recipient_name}"
            )->queue();

            $this->message->success("Empresa cadastrada com sucesso")->flash();
            $json['redirect'] = url("/manager/empresa/cadastro");
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Cadastro de Empresas";
        $page_subtitle = "Formulário para cadastro de novas empresas clientes";

        /* Dados para a página */
        $consultores = (new Consultores())->find()->order("nome")->fetch(true);
        $planos = (new Planos)->find()->order("mensalidade DESC")->fetch(true);

        /* URL DE ACESSO */
        $url_acesso = "empresas_cadastro";


        echo $this->view->render(
            "{$url_acesso}",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "consultores" => $consultores,
                "planos" => $planos
            ]
        );
    }

    /**
     *ADMIN: EMPRESAS - LISTA
     */
    public function empresaLista(): void
    {

        protect_admin_pages();

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Lista de Empresas";
        $page_subtitle = "Lista de Empresas cadastradas";

        $list_empresas = (new Empresas())->find()->order("nome_fantasia")->fetch(true);

        echo $this->view->render(
            "empresas_lista",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "empresas" => $list_empresas
            ]
        );
    }

    /**
     * ADMIN: EMPRESAS - DETALHE
     * @param array $data
     */
    public function empresaDetalhes(array $data): void
    {
        protect_admin_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $tipo_pessoa = filter_input(INPUT_POST, "tipo_pessoa", FILTER_SANITIZE_STRIPPED);
            $consultor_id = filter_input(INPUT_POST, "consultor_id", FILTER_VALIDATE_INT);
            $plano_id = filter_input(INPUT_POST, 'plano_id', FILTER_VALIDATE_INT);
            $razao_social = filter_input(INPUT_POST, "razao_social", FILTER_SANITIZE_STRIPPED);
            $nome_fantasia = filter_input(INPUT_POST, "nome_fantasia", FILTER_SANITIZE_STRIPPED);
            $documento = filter_input(INPUT_POST, "documento", FILTER_SANITIZE_STRIPPED);
            $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRIPPED);
            $logradouro = filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_STRIPPED);
            $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_STRIPPED);
            $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRIPPED);
            $municipio = filter_input(INPUT_POST, "municipio", FILTER_SANITIZE_STRIPPED);
            $uf = filter_input(INPUT_POST, "uf", FILTER_SANITIZE_STRIPPED);
            $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRIPPED);
            $whatsapp = filter_input(INPUT_POST, "whatsapp", FILTER_SANITIZE_STRIPPED);
            $responsavel = filter_input(INPUT_POST, "responsavel", FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRIPPED);

            /* Formatando os campos */
            $razao_social = str_title($razao_social);
            $nome_fantasia = str_title($nome_fantasia);
            $logradouro = str_title($logradouro);
            $bairro = str_title($bairro);
            $municipio = str_title($municipio);
            $email = mb_strtolower($email);
            $uf = mb_strtoupper($uf);

            /* validando o consultor_id */
            if (!is_int($consultor_id)){
                $json['error'] = $this->message->error("SELECIONE UM COLABORADOR")->render();
                echo json_encode($json);
                return;
            }

            /* selecionando a empresa */
            $empresa = (new Empresas())->findByCode($data['code']);

            $empresa->tipo_pessoa = $tipo_pessoa;
            $empresa->consultor_id = $consultor_id;
            $empresa->plano_id = $plano_id;
            $empresa->razao_social = $razao_social;
            $empresa->nome_fantasia = $nome_fantasia;
            $empresa->documento = $documento;
            $empresa->cep = $cep;
            $empresa->logradouro = $logradouro;
            $empresa->numero = $numero;
            $empresa->bairro = $bairro;
            $empresa->municipio = $municipio;
            $empresa->uf = $uf;
            $empresa->telefone = $telefone;
            $empresa->whatsapp = $whatsapp;
            $empresa->responsavel = $responsavel;
            $empresa->email = $email;

            /* alterando slug de acordo com nome fantasia */
            $empresa->slug = str_slug($nome_fantasia);

            if (!$empresa->save()) {
                $json['error'] = $empresa->message()->render();
                echo json_encode($json);
                return;
            }

            $json['success'] = $this->message->success("Dados da Empresa atualizados com sucesso")->render();
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        /* dados para a página */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);
        $empresa = (new Empresas())->findByCode($code);
        $consultores = (new Consultores())->find()->order("nome")->fetch(true);
        $mensalidades = (new Mensalidades())->find("empresa_id = :id", "id={$empresa->id}")->fetch(true);
        $planos = (new Planos())->find()->order("mensalidade DESC")->fetch(true);

        if (!$empresa) {
            echo "<script>alert(\"Empresa não localizada\"); history.back();</script>";
            return;
        }

        $page_title = "{$empresa->nome_fantasia} - Detalhes";
        $page_subtitle = "Detalhes da Empresa";

        echo $this->view->render(
            "empresas_detalhe",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "empresa" => $empresa,
                "consultores" => $consultores,
                "mensalidades" => $mensalidades,
                "planos" => $planos,
            ]
        );
    }

    /**
     * ADMIN: EMPRESAS - CADASTRO DE MENSALIDADE
     * @param array $data
     */
    public function empresaMensalidadeCadastro(array $data): void
    {

        if (!empty($data['code'])) {

            $empresa = (new Empresas())->findByCode($data['code']);

            if (empty($empresa)) {
                $json['error'] = $this->message->error("EMPRESA NÃO ENCONTRADA")->render();
                echo json_encode($json);
                return;
            }

            /* gerando codigo pedido */
            $order_id = codigo_pedido();

            /* Cadastrando mensalidade */
            $ultima_mensalidade = (new Mensalidades())->find("empresa_id = :id", "id={$empresa->id}")->order("id DESC")->fetch();

            /* se não tiver mensalidade, cadastra a primeira */
            if (empty($ultima_mensalidade)){
                $dias_boleto = 1;

                $mensalidade = $empresa->plano()->mensalidade;
                $mensalidade_mais_taxa = $mensalidade + TAXA_BOLETO;

                /* Cadastrando o boleto */
                $boleto = (new PagHiper())->bootstrap(
                    "{$order_id}",
                    "{$empresa->email}",
                    "{$empresa->razao_social}",
                    "{$empresa->documento}",
                    "{$empresa->telefone}",
                    "{$empresa->logradouro}",
                    "{$empresa->number}",
                    "{$empresa->complemento}",
                    "{$empresa->bairro}",
                    "{$empresa->cidade}",
                    "{$empresa->uf}",
                    "{$empresa->cep}",
                    "{$dias_boleto}",
                    converte_centavos($mensalidade_mais_taxa),
                    "Taxa de cadastro no sistema " . SEO_SITE_NAME,
                    "1",
                    "001"
                );

                if (!$boleto->gera_boleto()){

                    $json['error'] = $this->message->error("FALHA AO GERAR O BOLETO")->render();
                    echo json_encode($json);
                    return;

                }

                /* gerando a mensalidade */
                $mensalidade = (new Mensalidades())->bootstrap(
                    "{$empresa->id}",
                    date_fmt_app(),
                    $mensalidade,
                    "{$order_id}",
                    "{$boleto->transaction_id}",
                    "{$boleto->url}"
                );

                if (!$mensalidade->save()){
                    $json['error'] = $mensalidade->message()->render();
                    echo json_encode($json);
                    return;
                }
            } /* PRIMEIRA MENSALIDADE */ elseif (!empty($ultima_mensalidade)){

                /* Pegar data de vencimento da última mensalidade */
                $data_vencimento = $ultima_mensalidade->data_vencimento;

                /* acrescentar 30 dias */
                $data_prox_vencimento = date("Y-m-d", strtotime("+1 month", strtotime($data_vencimento)));

                /* calcular quantos dias faltam para a data acima */
                $data_hoje = date_fmt_app();
                $diff_dias = (strtotime($data_prox_vencimento) - strtotime($data_hoje)) / (60 * 60 * 24);

                $dias_boleto = $diff_dias;

                $mensalidade = $empresa->plano()->mensalidade;
                $mensalidade_mais_taxa = $mensalidade + TAXA_BOLETO;

                /* Cadastrando o boleto */
                $boleto = (new PagHiper())->bootstrap(
                    "{$order_id}",
                    "{$empresa->email}",
                    "{$empresa->razao_social}",
                    "{$empresa->documento}",
                    "{$empresa->telefone}",
                    "{$empresa->logradouro}",
                    "{$empresa->number}",
                    "{$empresa->complemento}",
                    "{$empresa->bairro}",
                    "{$empresa->cidade}",
                    "{$empresa->uf}",
                    "{$empresa->cep}",
                    "{$dias_boleto}",
                    converte_centavos($mensalidade_mais_taxa),
                    "Mensalidade do sistema " . SEO_SITE_NAME,
                    "1",
                    "001"
                );


                if (!$boleto->gera_boleto()){

                    $json['error'] = $this->message->error("FALHA AO GERAR O BOLETO")->render();
                    echo json_encode($json);
                    return;

                }

                /* gerando a mensalidade */
                $mensalidade = (new Mensalidades())->bootstrap(
                    "{$empresa->id}",
                    "{$data_prox_vencimento}",
                    $mensalidade,
                    "{$order_id}",
                    "{$boleto->transaction_id}",
                    "{$boleto->url}"
                );

                if (!$mensalidade->save()){
                    $json['error'] = $mensalidade->message()->render();
                    echo json_encode($json);
                    return;
                }

            } // end if ultima_mensalidade

            $this->message->success("MENSALIDADE GRAVADA COM SUCESSO")->flash();
            $json['redirect'] = url("/manager/empresa/detalhe/{$data['code']}");
            echo json_encode($json);
            return;
        }
    }

    /**
     * ADMIN: EMPRESAS - BAIXA DE MENSALIDADE
     * @param array $data
     */
    public function empresaMensalidadeBaixar(array $data): void
    {

        if (!empty($data['code'])) {

            $mensalidade = (new Mensalidades())->findByCode($data['code']);

            if (empty($mensalidade)) {
                $json['error'] = $this->message->error("MENSALIDADE NÃO ENCONTRADA")->render();
                echo json_encode($json);
                return;
            }

            /* ATUALIZANDO CAMPO DE DATA DE PAGAMENTO */
            $mensalidade->data_pagamento = date_fmt_app();

            if (!$mensalidade->save()){
                $json['error'] = $mensalidade->message()->render();
                echo json_encode($json);
                return;
            }

            /* RECUPERANDO O CODIGO DA EMPRESA PARA REDIRECT */
            $empresa = (new Empresas())->findById($mensalidade->empresa_id);


            /* Para cada mensalidade baixada devo criar uma comissão para o consultor */
            $consultor_id = $empresa->consultor_id;
            $empresa_id = $empresa->id;
            $mensalidade_id = $mensalidade->id;
            $mensalidade_data_vencimento = $mensalidade->data_vencimento;
            $valor_mensalidade = $mensalidade->valor;

            $comissao = (new Comissoes())->bootstrap(
                "{$consultor_id}",
                "{$empresa_id}",
                "{$empresa->plano_id}",
                "{$mensalidade_id}",
                "{$valor_mensalidade}",
                "{$mensalidade_data_vencimento}"
            );

            if (!$comissao->save()){
                $json['error'] = $comissao->message()->render();
                echo json_encode($json);
                return;
            }

            $json['successRedirect'] = $this->message->success("MENSALIDADE {$data['code']} BAIXADA COM SUCESSO")->render();
            if ($data['source'] == "mensalidade"){
                $json['after_redirect'] = url("/manager/mensalidades/em-aberto");
            } elseif ($data['source'] == "empresa"){
                $json['after_redirect'] = url("/manager/empresa/detalhe/{$empresa->code}");
            }

            echo json_encode($json);
            return;
        }
    }

    /**
     * ADMIN: EMPRESAS - LIBERAÇÃO DE ACESSO
     * @param array $data
     */
    public function empresaLibera(array $data): void
    {
        if (!empty($data['code'])) {

            $empresa = (new Empresas())->findByCode($data['code']);
            $empresa->status = $data['status'];
            if (!$empresa->save()) {
                $json['error'] = $empresa->message()->render();
                echo json_encode($json);
                return;
            }

            $json['success'] = $this->message->success("Status de {$empresa->nome_fantasia} alterado com Sucesso")->render();
            echo json_encode($json);
            return;

        }
    }

    /**
     * ADMIN: MENSALIDADES - EM ABERTO
     * @param array|null $data
     */
    public function mensalidadesEmAberto(? array $data): void
    {

        protect_admin_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $tipo_pessoa = filter_input(INPUT_POST, "tipo_pessoa", FILTER_SANITIZE_STRIPPED);
            $consultor_id = filter_input(INPUT_POST, "consultor_id", FILTER_VALIDATE_INT);
            $razao_social = filter_input(INPUT_POST, "razao_social", FILTER_SANITIZE_STRIPPED);
            $nome_fantasia = filter_input(INPUT_POST, "nome_fantasia", FILTER_SANITIZE_STRIPPED);
            $documento = filter_input(INPUT_POST, "documento", FILTER_SANITIZE_STRIPPED);
            $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRIPPED);
            $logradouro = filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_STRIPPED);
            $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_STRIPPED);
            $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRIPPED);
            $municipio = filter_input(INPUT_POST, "municipio", FILTER_SANITIZE_STRIPPED);
            $uf = filter_input(INPUT_POST, "uf", FILTER_SANITIZE_STRIPPED);
            $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRIPPED);
            $whatsapp = filter_input(INPUT_POST, "whatsapp", FILTER_SANITIZE_STRIPPED);
            $responsavel = filter_input(INPUT_POST, "responsavel", FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRIPPED);

            /* Formatando os campos */
            $razao_social = str_title($razao_social);
            $nome_fantasia = str_title($nome_fantasia);
            $logradouro = str_title($logradouro);
            $bairro = str_title($bairro);
            $municipio = str_title($municipio);
            $email = mb_strtolower($email);
            $uf = mb_strtoupper($uf);

            /* validando o consultor_id */
            if (!is_int($consultor_id)){
                $json['error'] = $this->message->error("SELECIONE UM CONSULTOR")->render();
                echo json_encode($json);
                return;
            }

            $empresa = (new Empresas())->bootstrap(
                "{$tipo_pessoa}",
                "{$consultor_id}",
                "{$razao_social}",
                "{$nome_fantasia}",
                "{$documento}",
                "{$cep}",
                "{$logradouro}",
                "{$numero}",
                "{$bairro}",
                "{$municipio}",
                "{$uf}",
                "{$telefone}",
                "{$whatsapp}",
                "{$responsavel}",
                "{$email}",
                1
            );

            /* GERANDO SLUG DA EMPRESA */
            $slug = str_slug($empresa->nome_fantasia);
            $empresa->slug = $slug;

            /* GERANDO A SENHA */
            $senha = gera_senha();
            $empresa->senha = passwd($senha);

            if (!$empresa->save()) {
//                $json['error'] = $this->message->error("Erro ao cadastrar empresa.")->render();
                $json['error'] = $empresa->message()->render();
                echo json_encode($json);
                return;
            }

            $subject = "[" . SEO_SITE_NAME . "] - Confirmação de Cadastro";
            $mail_view = new View(MAIL_PATH);
            $body = $mail_view->render("register_confirm", [
                "empresa" => $empresa,
                "subject" => $subject,
                "senha" => $senha,
            ]);
            $recipient = $email;
            $recipient_name = $nome_fantasia;


            /* Enviando e-mail de cadastro */
            $mail = (new SwiftMail())->bootstrap(
                "{$subject}",
                "{$body}",
                "{$recipient}",
                "{$recipient_name}"
            )->queue();

            /* E-MAIL DE CADASTRO */

            /* selecionando o consultor */
            $consultor = (new Consultores())->findById($consultor_id);

            $subject = "[" . SEO_SITE_NAME . "] - Novo Cadastro";
            $mail_view = new View(MAIL_PATH);
            $body = $mail_view->render("register_new", [
                "empresa" => $empresa,
                "consultor" => $consultor,
                "subject" => $subject,
            ]);
            $recipient = CONF_MAIL_REGISTER;
            $recipient_name = SEO_SITE_NAME;


            /* Enviando e-mail de cadastro */
            $mail = (new SwiftMail())->bootstrap(
                "{$subject}",
                "{$body}",
                "{$recipient}",
                "{$recipient_name}"
            )->queue();

            $this->message->success("Empresa cadastrada com sucesso")->flash();
            $json['redirect'] = url("/manager/empresa/cadastro");
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Mensalidades em Aberto";
        $page_subtitle = "Lista de mensalidades em aberto";

        /* Dados para a página */
        $mensalidades = (new Mensalidades())->find("data_pagamento IS NULL")->fetch(true);

        /* URL DE ACESSO */
        $url_acesso = "mensalidades_em_aberto_lista";


        echo $this->view->render(
            "{$url_acesso}",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "mensalidades" => $mensalidades,
            ]
        );
    }

    /**
     * ADMIN: MENSALIDADES - PAGAS
     * @param array|null $data
     */
    public function mensalidadesPagas(? array $data): void
    {

        protect_admin_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $tipo_pessoa = filter_input(INPUT_POST, "tipo_pessoa", FILTER_SANITIZE_STRIPPED);
            $consultor_id = filter_input(INPUT_POST, "consultor_id", FILTER_VALIDATE_INT);
            $razao_social = filter_input(INPUT_POST, "razao_social", FILTER_SANITIZE_STRIPPED);
            $nome_fantasia = filter_input(INPUT_POST, "nome_fantasia", FILTER_SANITIZE_STRIPPED);
            $documento = filter_input(INPUT_POST, "documento", FILTER_SANITIZE_STRIPPED);
            $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRIPPED);
            $logradouro = filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_STRIPPED);
            $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_STRIPPED);
            $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRIPPED);
            $municipio = filter_input(INPUT_POST, "municipio", FILTER_SANITIZE_STRIPPED);
            $uf = filter_input(INPUT_POST, "uf", FILTER_SANITIZE_STRIPPED);
            $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRIPPED);
            $whatsapp = filter_input(INPUT_POST, "whatsapp", FILTER_SANITIZE_STRIPPED);
            $responsavel = filter_input(INPUT_POST, "responsavel", FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRIPPED);

            /* Formatando os campos */
            $razao_social = str_title($razao_social);
            $nome_fantasia = str_title($nome_fantasia);
            $logradouro = str_title($logradouro);
            $bairro = str_title($bairro);
            $municipio = str_title($municipio);
            $email = mb_strtolower($email);
            $uf = mb_strtoupper($uf);

            /* validando o consultor_id */
            if (!is_int($consultor_id)){
                $json['error'] = $this->message->error("SELECIONE UM CONSULTOR")->render();
                echo json_encode($json);
                return;
            }

            $empresa = (new Empresas())->bootstrap(
                "{$tipo_pessoa}",
                "{$consultor_id}",
                "{$razao_social}",
                "{$nome_fantasia}",
                "{$documento}",
                "{$cep}",
                "{$logradouro}",
                "{$numero}",
                "{$bairro}",
                "{$municipio}",
                "{$uf}",
                "{$telefone}",
                "{$whatsapp}",
                "{$responsavel}",
                "{$email}",
                1
            );

            /* GERANDO SLUG DA EMPRESA */
            $slug = str_slug($empresa->nome_fantasia);
            $empresa->slug = $slug;

            /* GERANDO A SENHA */
            $senha = gera_senha();
            $empresa->senha = passwd($senha);

            if (!$empresa->save()) {
                $json['error'] = $empresa->message()->render();
                echo json_encode($json);
                return;
            }

            $subject = "[" . SEO_SITE_NAME . "] - Confirmação de Cadastro";
            $mail_view = new View(MAIL_PATH);
            $body = $mail_view->render("register_confirm", [
                "empresa" => $empresa,
                "subject" => $subject,
                "senha" => $senha,
            ]);
            $recipient = $email;
            $recipient_name = $nome_fantasia;


            /* Enviando e-mail de cadastro */
            $mail = (new SwiftMail())->bootstrap(
                "{$subject}",
                "{$body}",
                "{$recipient}",
                "{$recipient_name}"
            )->queue();

            /* E-MAIL DE CADASTRO */
            /* selecionando o consultor */
            $consultor = (new Consultores())->findById($consultor_id);

            $subject = "[" . SEO_SITE_NAME . "] - Novo Cadastro";
            $mail_view = new View(MAIL_PATH);
            $body = $mail_view->render("register_new", [
                "empresa" => $empresa,
                "consultor" => $consultor,
                "subject" => $subject,
            ]);
            $recipient = CONF_MAIL_REGISTER;
            $recipient_name = SEO_SITE_NAME;

            /* Enviando e-mail de cadastro */
            $mail = (new SwiftMail())->bootstrap(
                "{$subject}",
                "{$body}",
                "{$recipient}",
                "{$recipient_name}"
            )->queue();

            $this->message->success("Empresa cadastrada com sucesso")->flash();
            $json['redirect'] = url("/manager/empresa/cadastro");
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Mensalidades Pagas";
        $page_subtitle = "Lista de mensalidades Pagas";

        /* Dados para a página */
        $mensalidades = (new Mensalidades())->find("data_pagamento IS NOT NULL")->fetch(true);

        /* URL DE ACESSO */
        $url_acesso = "mensalidades_pagas";


        echo $this->view->render(
            "{$url_acesso}",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "mensalidades" => $mensalidades,
            ]
        );
    }

    /**
     * ADMIN: COMISSÕES - EM ABERTO
     * @param array|null $data
     */
    public function comissoesEmAberto(? array $data): void
    {

        protect_admin_pages();

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Comissões em Aberto";
        $page_subtitle = "Lista de comissões em aberto";

        /* Dados para a página */
        $comissoes = (new Comissoes())->find("data_pagamento IS NULL")->fetch(true);

        /* URL DE ACESSO */
        $url_acesso = "comissoes_em_aberto_lista";


        echo $this->view->render(
            "{$url_acesso}",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "comissoes" => $comissoes,
            ]
        );
    }

    /**
     * ADMIN: COMISSÕES - BAIXAR
     * @param array|null $data
     */
    public function comissoesBaixar(?array $data):void
    {
        if (!empty($data['code'])) {

            $comissao = (new Comissoes())->findByCode($data['code']);

            if (empty($comissao)) {
                $json['error'] = $this->message->error("COMISSÃO NÃO ENCONTRADA")->render();
                echo json_encode($json);
                return;
            }

            /* ATUALIZANDO CAMPO DE DATA DE PAGAMENTO */
            $comissao->data_pagamento = date_fmt_app();

            if (!$comissao->save()){
                $json['error'] = $comissao->message()->render();
                echo json_encode($json);
                return;
            }

            /* RECUPERANDO O CODIGO DA EMPRESA PARA REDIRECT */
            $empresa = (new Empresas())->findById($comissao->empresa_id);

            $json['successRedirect'] = $this->message->success("COMISSÃO {$data['code']} BAIXADA COM SUCESSO")->render();
            if ($data['source'] == "comissao"){
                $json['after_redirect'] = url("/manager/comissoes/em-aberto");
            }

            echo json_encode($json);
            return;
        }
    }

    /**
     * ADMIN: COMISSÕES - PAGAS
     * @param array|null $data
     */
    public function comissoesPagas(? array $data): void
    {

        protect_admin_pages();

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Comissões Pagas";
        $page_subtitle = "Lista de comissões Pagas";

        /* Dados para a página */
        $comissoes = (new Comissoes())->find("data_pagamento IS NOT NULL")->fetch(true);

        /* URL DE ACESSO */
        $url_acesso = "comissoes_pagas";


        echo $this->view->render(
            "{$url_acesso}",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "comissoes" => $comissoes,
            ]
        );
    }


    /**
     * ADMIN: SAIR
     */
    public
    function sair(): void
    {
        protect_admin_pages();

        /* montando a rotina de logout */
        $auth = new LoginAdmin();

        /* dados */
        if ($auth->authDestroy()) {
            redirect("/manager");
            return;
        }
    }

    /**
     * SITE ERROR
     * @param array $data
     */
    public function error(array $data): void
    {

        /* otimizando os erros */
        switch ($data['errcode']) {

            case "problemas":
                /* Composição do erro de conexão com banco de dados */
                $error = new \stdClass();
                $error->code = "OPS :/";
                $error->title = "Estamos enfrentando problemas :/";
                $error->message = "Parece que nosso serviço não está disponível no momento. Já estamos trabalhando nisso.";
                $error->linkTitle = "ENVIAR E-MAIL!";
                $error->link = "mailto:";
                break;

            case "manutencao":
                /* Composição do erro de manutenção */
                $error = new \stdClass();
                $error->code = "OPS :/";
                $error->title = "Estamos em manutenção :/";
                $error->message = "Voltamos logo! Por ora, estamos trabalhando para melhor poder atendê-los.";
                $error->linkTitle = null;
                $error->link = url();
                break;
            default:

                /* Composição do erro */
                $error = new \stdClass();
                $error->code = "ERRO " . $data['errcode'];
                $error->title = "Ops. Conteúdo indisponível :/";
                $error->message = "Sentimos muito mas o conteúdo não está acessível.";
                $error->linkTitle = "Continue navegando!";
                $error->link = url();
                break;
        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | {$error->code}")
            ->favicon()->render();

        echo $this->view->render(
            "error",
            [
                "seo" => $seo,
                "error" => $error
            ]
        );
    }
}