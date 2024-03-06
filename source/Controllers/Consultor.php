<?php


namespace Source\Controllers;


use function Composer\Autoload\includeFile;
use Source\Core\Connect;
use Source\Core\Controller;
use Source\Core\LoginConsultor;
use Source\Core\View;
use Source\Models\Comissoes;
use Source\Models\Consultores;
use Source\Models\Empresas;
use Source\Models\Mensalidades;
use Source\Models\NivelAcesso;
use Source\Models\Planos;
use Source\Models\StatusUsuario;
use Source\Models\Usuarios;
use Source\Support\PagHiper;
use Source\Support\SwiftMail;

/**
 * Class Consultor
 * @package Source\Controllers
 */
class Consultor extends Controller
{
    /**
     * TestController constructor.
     */
    public function __construct()
    {
        $pathToViews = __DIR__ . "/../../themes/" . VIEWS_CONSULTOR_THEME . "/";

        parent::__construct($pathToViews);

        if (!empty(session()->user_consultor)){
            $this->consultor = (new Consultores())->findByCode(session()->user_consultor);
        }

        (new SwiftMail())->sendQueue();
    }

    /**
     * #############################
     * ###  CONSTRUÇÃO DAS ROTAS ###
     * #############################
     */

    /**
     * Consultor: ENTRAR
     * @param array $data
     */
    public function login(?array $data): void
    {

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            if (in_array("", $data)) {
                $json['warning'] = $this->message->warning("Preencha todos os campos")->render();
                echo json_encode($json);
                return;
            }

            $usuario = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRIPPED);
            $passwd = filter_var($data['passwd'], FILTER_SANITIZE_STRIPPED);

            $user = new LoginConsultor();
            $user->bootstrap($usuario, $passwd);

            if (!$user->authUser()) {
                $json['error'] = $user->message()->render();
                echo json_encode($json);
                return;
            }

            $json['redirect'] = url("/consultor/dashboard");

            echo json_encode($json);
            return;
        }

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
     * Consultor: DASHBOARD
     */
    public function dashboard(?array $data): void
    {
        protect_consultor_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRIPPED);
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
            $consultor = (new Consultores())->findById($this->consultor->id);

            /* dados alterados */
            $consultor->nome = $nome;
            $consultor->email = $email;
            $consultor->whatsapp = $whatsapp;
            $consultor->cpf = $cpf;
            $consultor->banco = $banco;
            $consultor->agencia = $agencia;
            $consultor->tipo_conta = $tipo_conta;
            $consultor->conta = $conta;

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

        /* Dados para a dashboard */
        $empresas = (new Empresas())->find("consultor_id = :id", "id={$this->consultor->id}")->count();
        $comissoes_previsao = Connect::getInstance()->query(
            "SELECT SUM(valor_comissao) as valor FROM comissoes 
                      WHERE MONTH(mensalidade_data_vencimento) = '". date("m") ."' 
                      AND consultor_id = ".$this->consultor->id
                )->fetch();


        echo $this->view->render(
            "dashboard",
            [
                "seo" => $seo,
                "consultor" => $this->consultor,
                "empresas" => $empresas,
                "comissoes_previsao" => $comissoes_previsao->valor,
            ]
        );
    }

    /**
     * Consultor: EMPRESAS - CADASTRO
     * @param array|null $data
     */
    public function empresaCadastro(? array $data): void
    {

        protect_consultor_pages();

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
            $json['redirect'] = url("/consultor/empresa/cadastro");
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Cadastro de Empresas";
        $page_subtitle = "Formulário para cadastro de novas empresas clientes";
        $planos = (new Planos())->find()->order("mensalidade DESC")->fetch(true);

        echo $this->view->render(
            "empresas_cadastro",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "consultor" => $this->consultor,
                "planos" => $planos,
            ]
        );
    }

    /**
     * CONSULTOR: EMPRESAS - LISTA
     */
    public function empresaLista(): void
    {

        protect_consultor_pages();

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Lista de Empresas";
        $page_subtitle = "Lista de Empresas cadastradas";

        $list_empresas = (new Empresas())->find("consultor_id = :id", "id={$this->consultor->id}")->order("nome_fantasia")->fetch(true);

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
     * CONSULTOR: EMPRESAS - DETALHE
     * @param array $data
     */
    public function empresaDetalhes(array $data): void
    {
        protect_consultor_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $tipo_pessoa = filter_input(INPUT_POST, "tipo_pessoa", FILTER_SANITIZE_STRIPPED);
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


            /* selecionando a empresa */
            $empresa = (new Empresas())->findByCode($data['code']);

            $empresa->tipo_pessoa = $tipo_pessoa;
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
            ]
        );
    }

    /**
     * CONSULTOR: COMISSÃO
     * @param array $data
     */
    public function comissoesLista(array $data): void
    {
        protect_consultor_pages();

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
                $json['error'] = $this->message->error("SELECIONE UM COLABORADOR")->render();
                echo json_encode($json);
                return;
            }

            /* selecionando a empresa */
            $empresa = (new Empresas())->findByCode($data['code']);

            $empresa->tipo_pessoa = $tipo_pessoa;
            $empresa->consultor_id = $consultor_id;
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

        $page_title = "Comissões - Detalhes";
        $page_subtitle = "Lista de Comissões";

        $comissoes_pagas = (new Comissoes())->find("consultor_id = :id AND data_pagamento IS NOT NULL", "id={$this->consultor->id}")->fetch(true);
        $comissoes_aberto = (new Comissoes())->find("consultor_id = :id AND data_pagamento IS NULL", "id={$this->consultor->id}")->fetch(true);

        echo $this->view->render(
            "comissoes_lista",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "comissoes_pagas" => $comissoes_pagas,
                "comissoes_aberto" => $comissoes_aberto,
            ]
        );
    }

    /**
     * CONSULTOR: ALTERAR SENHA
     * @param array $data
     */
    public function consultorAlterarSenha(array $data): void
    {
        protect_consultor_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
            $senha_atual = filter_input(INPUT_POST, "senha_atual", FILTER_SANITIZE_STRIPPED);
            $senha_nova = filter_input(INPUT_POST, "senha_nova", FILTER_SANITIZE_STRIPPED);
            $senha_nova_repeat = filter_input(INPUT_POST, "senha_nova_repeat", FILTER_SANITIZE_STRIPPED);

            /* selecionando o consultor */
            $consultor = (new Consultores())->findById($this->consultor->id);

            /* validando as senhas */
            if (empty($senha_atual) OR !is_passwd($senha_atual)){
                $json['error'] = $this->message->error("A SENHA ATUAL DEVE TER DE 8 A 40 CARACTERES")->render();
                echo json_encode($json);
                return;
            }

            if (empty($senha_nova) OR !is_passwd($senha_nova)){
                $json['error'] = $this->message->error("A NOVA SENHA DEVE TER DE 8 A 40 CARACTERES")->render();
                echo json_encode($json);
                return;
            }

            if (empty($senha_nova_repeat) OR !is_passwd($senha_nova_repeat)){
                $json['error'] = $this->message->error("A REPETIÇÃO DA NOVA SENHA DEVE TER DE 8 A 40 CARACTERES")->render();
                echo json_encode($json);
                return;
            }

            if ($senha_nova != $senha_nova_repeat){
                $json['error'] = $this->message->error("A REPETIÇÃO DA NOVA SENHA DEVE SER IGUAL À NOVA SENHA")->render();
                echo json_encode($json);
                return;
            }

            if (!passwd_verify($senha_atual, $consultor->senha)){
                $json['error'] = $this->message->error("A SENHA ATUAL DIGITADA NÃO CONFERE COM A SENHA CADASTRADA")->render();
                echo json_encode($json);
                return;
            }


            /* ALTERANDO A SENHA */
            $consultor->senha = passwd($senha_nova);

            if (!$consultor->save()){
                $json['error'] = $consultor->message()->render();
                echo json_encode($json);
                return;
            }

            $json['success'] = $this->message->success("Senha alterada com sucesso")->render();
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Administração")
            ->favicon()->render();

        $page_title = "Consultor - Alterar Senha";
        $page_subtitle = "Alteração de Senha";

        echo $this->view->render(
            "senha_alterar",
            [
                "seo" => $seo,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
            ]
        );
    }

    /**
     * ADMIN: SAIR
     */
    public
    function sair(): void
    {
        protect_consultor_pages();

        /* montando a rotina de logout */
        $auth = new LoginConsultor();

        /* dados */
        if ($auth->authDestroy()) {
            redirect("/consultor");
            return;
        }
    }



}