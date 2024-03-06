<?php


namespace Source\Controllers;


use CoffeeCode\Paginator\Paginator;
use Source\Core\Controller;
use Source\Core\Login;
use Source\Core\LoginEmpresa;
use Source\Core\Session;
use Source\Core\View;
use Source\Models\Categorias;
use Source\Models\Empresas;
use Source\Models\Mensalidades;
use Source\Models\Opcionais;
use Source\Models\Opcoes;
use Source\Models\Pedidos;
use Source\Models\Produtos;
use Source\Models\TaxaEntrega;
use Source\Support\Pager;
use Source\Support\SwiftMail;
use Source\Support\Upload;

/**
 * Class Panel
 * @package Source\Controllers
 */
class Panel extends Controller
{

    /** @var $usuario Usuarios */
    protected $usuario;

    /** @var $empresa Empresas */
    protected $empresa;

    /**
     * TestController constructor.
     */
    public function __construct()
    {
        $pathToViews = __DIR__ . "/../../themes/" . VIEWS_PANEL_THEME . "/";

        parent::__construct($pathToViews);

        (new SwiftMail())->sendQueue();

        /* Informações do User e da Empresa */
        if (\session()->has("user_empresa")) {
            $this->empresa = (new Empresas())->findByEmail(\session()->user_empresa);
        }

    }

    /**
     * #############################
     * ###  CONSTRUÇÃO DAS ROTAS ###
     * #############################
     */

    /**
     * PANEL: ENTRAR
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
                $json['error'] = $this->message->warning("Preencha todos os campos")->render();
                echo json_encode($json);
                return;
            }

            $usuario = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRIPPED);
            $passwd = filter_var($data['passwd'], FILTER_SANITIZE_STRIPPED);

            $user = new LoginEmpresa();
            $user->bootstrap($usuario, $passwd);

            if (!$user->authUser()) {
                $json['error'] = $user->message()->render();
                echo json_encode($json);
                return;
            }

            /* selecionando a empresa para redirect */
            $empresa = (new Empresas())->findByEmail($usuario);

            $json['redirect'] = url("/{$empresa->slug}/panel/dashboard");
            echo json_encode($json);
            return;
        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        echo $this->view->render(
            "login",
            [
                "seo" => $seo
            ]
        );
    }

    /**
     * PANEL: DASHBOARD
     */
    public function dashboard(): void
    {
        protect_company_pages();

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("tachometer-alt") . " Dashboard";

        $mensalidades = (new Mensalidades())->
        find("empresa_id = :id", "id={$this->empresa->id}")->
        order("id DESC")->
        limit(5)->
        fetch(true);

        echo $this->view->render(
            "dashboard",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "mensalidades" => $mensalidades,
            ]
        );
    }

    /**
     * PANEL: PEDIDOS
     */
    public function pedidos(?array $data): void
    {
        protect_company_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* Recebendo dados do form */
            $data_inicial = filter_input(INPUT_POST, "data_inicial", FILTER_SANITIZE_STRIPPED);
            $data_final = filter_input(INPUT_POST, "data_final", FILTER_SANITIZE_STRIPPED);
            $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRIPPED);

            /* validando os campos */
            if (empty($data_inicial)) {
                $json['error'] = $this->message->error("Preencha a data inicial")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data_final)) {
                $json['error'] = $this->message->error("Preencha a data final")->render();
                echo json_encode($json);
                return;
            }

            if ($data_final < $data_inicial) {
                $json['error'] = $this->message->error("O período de filtragem de dados está incorreto")->render();
                echo json_encode($json);
                return;
            }

            $json['assincronus'] = null;

            /* efetuando a busca pelos pedidos */
            if (!empty($status)) {
                $pedidos = (new Pedidos())->find(
                    "empresa_id = :id AND DATE(created_at) BETWEEN \"{$data_inicial}\" AND \"{$data_final}\" AND status = :s",
                    "id={$this->empresa->id}&s={$status}"
                )->order("n_ordem DESC")->fetch(true);
            } else {
                $pedidos = (new Pedidos())->find(
                    "empresa_id = :id AND DATE(created_at) BETWEEN \"{$data_inicial}\" AND \"{$data_final}\" ",
                    "id={$this->empresa->id}"
                )->order("n_ordem DESC")->fetch(true);
            }


            if (empty($pedidos)) {
                $json['assincronus'] .= " <tr>
                                            <td colspan='7'>
                                            " . icon("ban") . "NÃO FORAM ENCONTRADOS REGISTROS PARA O FILTRO ACIMA
                                            </td></tr>";
            } else {
                foreach ($pedidos as $pedido) {
                    switch ($pedido->entrega):
                        case "entrega" :
                            $envio = icon("motorcycle");
                            $class = "primary";
                            break;
                        case "local" :
                            $envio = icon("shopping-bag");
                            $class = "danger";
                            break;
                    endswitch;

                    switch ($pedido->forma_pagamento):
                        case "dinheiro" :
                            $pagamento = icon("money");
                            break;
                        default :
                            $pagamento = icon("credit-card");
                            break;
                    endswitch;

                    $json['assincronus'] .=
                        "
                        <tr>
                        <td>{$pedido->n_ordem}</td>
                        <td style=\"width: 200px\">
                            <select name=\"status\"
                                    data-statuspedidos=\"true\"
                                    data-url='" . url("/changeStatusPedidos") . "'
                                    data-code=\"{$pedido->code}\"
                                    class=\"form-control\"> ";

                    foreach (STATUS_PEDIDOS as $key => $value):
                        $json['assincronus'] .= "<option " . ($pedido->status == $key ? "selected" : "") . " value=\"{$key}\">{$value}</option>";
                    endforeach;

                    $json['assincronus'] .= "
                            </select>
                        </td>
                        <td>" . date_pedido($pedido->created_at) . "</td>
                        <td>" . currency($pedido->total) . "</td>
                        <td>{$pedido->nome}</td>
                        <td>
                            <span style=\"padding: 5px; font-size: 1em\" class=\"text text-{$class}\">{$envio}</span>
                            <span style=\"padding: 5px; font-size: 1em\">{$pagamento}</span>
                        </td>
                         <td>
                              <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                                  <button data-view
                                          data-toggle=\"modal\" data-target=\"#view_modal\"
                                          data-url='" . url("/viewPedido") . "'
                                          data-code=\"{$pedido->code}\"
                                          title=\"Visualizar\"
                                          class=\"btn btn-primary\">" . icon("desktop") . "</button>                                         
                                          
                                          
                                  <button data-notification
                                          style=\"margin: 0 0 0 3px\"
                                          data-code=\"{$pedido->code}\"
                                          data-url='" . url("/notifyPedido") . "'
                                          class=\"btn btn-success\">" . icon("whatsapp") . "</button>                                          
                                          
                                          
                                  <button data-print
                                          title=\"Imprimir\" style=\"margin: 0 0 0 3px\"
                                          data-code=\"{$pedido->code}\"
                                          data-url='" . url("/printPedido") . "'
                                          class=\"btn btn-warning\">" . icon("print") . "</button>
                                          
                                  
                                    
                              </div>
                         </td>                        
                        </tr>

                    ";
                }
            }
            echo json_encode($json);
            return;
        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("refresh") . " Pedidos";
        $page_subtitle = "Gerencie os pedidos de sua loja";

        /* Selecionando os pedidos */
        $yesterday = date("Y-m-d", strtotime(" -1 day", strtotime(date("Y-m-d"))));
        $today = date("Y-m-d");

        $pedidos = (new Pedidos())->find(
            "empresa_id = :id AND DATE(created_at) BETWEEN \"{$yesterday}\" AND \"{$today}\" ",
            "id={$this->empresa->id}"
        );

        $n_pedidos = $pedidos->count();

        /* montar a url do Paginator */
        $pager = new Pager(url("/{$this->empresa->slug}/panel/pedidos/"));

        /* configurar o paginator */
        $pager->pager($n_pedidos, LIMITE_PAGINACAO, ($data['page'] ?? 1));

        echo $this->view->render(
            "pedidos",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "pedidos" => $pedidos->limit($pager->limit())->offset($pager->offset())->order("n_ordem DESC")->fetch(true),
                "paginator" => $pager
            ]
        );
    }

    /**
     * PANEL: CATEGORIAS - CADASTRO / LISTA
     */
    public
    function produtosCategorias(?array $data): void
    {
        protect_company_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* recebendo dados do form */
            $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRIPPED);

            $categoria = (new Categorias())->bootstrap(
                "{$this->empresa->id}",
                "{$nome}"
            );

            if (!$categoria->save()) {
                $json['error'] = $categoria->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Categoria {$nome} cadastrada com sucesso")->flash();
            $json['redirect'] = url("{$data['company']}/panel/produtos/categorias");
            echo json_encode($json);
            return;
        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("shopping-cart") . " Produtos / Categorias";
        $page_subtitle = "Gerencie as categorias dos produtos de sua loja";

        $categorias = (new Categorias())->find("empresa_id = :id", "id={$this->empresa->id}");

        /* contar as categorias */
        $num_categorias = $categorias->count();

        /* montar a url do Paginator */
        $pager = new Pager(url("/{$this->empresa->slug}/panel/produtos/categorias/"));

        /* configurar o paginator */
        $pager->pager($num_categorias, LIMITE_PAGINACAO, ($data['page'] ?? 1));


        echo $this->view->render(
            "produtos_categorias",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "categorias" => $categorias->order("nome ASC")->limit($pager->limit())->offset($pager->offset())->fetch(true),
                "paginator" => $pager,
                "n_itens" => $num_categorias
            ]
        );
    }

    /**
     * PANEL: CATEGORIAS - EDITAR
     */
    public
    function produtosCategoriasEditar(?array $data): void
    {
        /* recebendo dados do form */
        $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_STRIPPED);
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRIPPED);
        $disponivel = filter_input(INPUT_POST, "disponivel", FILTER_SANITIZE_STRIPPED);

        /* selecionando a categoria */
        $categoria = (new Categorias())->findByCode($code);

        if (empty($categoria)) {
            $json['error'] = $this->message->error("Categoria não encontrada")->render();
            echo json_encode($json);
            return;
        }

        /* Dados a serem alterados */
        $categoria->nome = $nome;
        $categoria->slug = str_slug($nome);
        $categoria->disponivel = $disponivel;

        /* verificando se tem categoria com este nome */
        if ($categoria->checkRepetida($categoria->slug, $categoria->empresa_id, $categoria->id)) {
            $json['error'] = $this->message->error("Já existe uma categoria com este nome")->render();
            echo json_encode($json);
            return;
        }

        if (!$categoria->save()) {
            $json['error'] = $categoria->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Categoria {$categoria->nome} atualizada com sucesso")->flash();
        $json['redirect'] = url("/{$data['company']}/panel/produtos/categorias/{$data['page']}");
        echo json_encode($json);
        return;
    }

    /**
     * PANEL: OPCIONAIS / LISTA
     */
    public
    function opcionaisLista(?array $data): void
    {
        protect_company_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* recebendo dados do form */
            $cat_id = filter_input(INPUT_POST, "cat_id", FILTER_VALIDATE_INT);
            $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRIPPED);
            $obrigatorio = filter_input(INPUT_POST, "obrigatorio", FILTER_SANITIZE_STRIPPED);
            $qtde_permitida = filter_input(INPUT_POST, "qtde_permitida", FILTER_VALIDATE_INT);

            if (empty($cat_id)) {
                $json['error'] = $this->message->info("Preencha o campo CATEGORIA")->render();
                echo json_encode($json);
                return;
            }

            if (empty($categoria)) {
                $json['error'] = $this->message->info("Preencha o campo NOME DA CATEGORIA")->render();
                echo json_encode($json);
                return;
            }


            $opcional = (new Opcionais())->bootstrap(
                "{$this->empresa->id}",
                "{$obrigatorio}",
                "{$qtde_permitida}"
            );

            /* armazenando a categoria original */
            $opcional->cat_id = $cat_id;

            $opcional->categoria = $categoria;
            $opcional->slug_categoria = str_slug($categoria);

            if (!$opcional->save()) {
                $json['error'] = $opcional->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Categoria Opcional {$categoria} cadastrada com sucesso")->flash();
            $json['redirect'] = url("{$data['company']}/panel/produtos/opcionais");
            echo json_encode($json);
            return;
        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("shopping-cart") . " Produtos / Opcionais";
        $page_subtitle = "Gerencie os opcionais dos produtos de sua loja";

        /* Categorias originais */
        $categorias = (new Categorias())->find("empresa_id = :id", "id={$this->empresa->id}")->order("nome")->fetch(true);

        /* selecionando somente os opcionais categorias */
        $opcionais = (new Opcionais())->
        find("empresa_id = :id AND categoria IS NOT NULL", "id={$this->empresa->id}");

        /* contar as opcionais */
        $num_opcionais = $opcionais->count();

        /* montar a url do Paginator */
        $pager = new Pager(url("/{$this->empresa->slug}/panel/produtos/opcionais/"));

        /* configurar o paginator */
        $pager->pager($num_opcionais, LIMITE_PAGINACAO, ($data['page'] ?? 1));

        echo $this->view->render(
            "opcionais_lista",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "opcionais" => $opcionais->limit($pager->limit())->offset($pager->offset())->order("cat_id ASC, categoria asc")->fetch(true),
                "paginator" => $pager,
                "categorias" => $categorias
            ]
        );
    }

    /**
     * PANEL: OPCIONAIS - EDITAR
     */
    public
    function opcionaisEditar(?array $data): void
    {
        /* recebendo dados do form */
        $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_STRIPPED);
        $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRIPPED);
        $cat_id = filter_input(INPUT_POST, "cat_id", FILTER_VALIDATE_INT);
        $obrigatorio = filter_input(INPUT_POST, "obrigatorio", FILTER_SANITIZE_STRIPPED);
        $qtde_permitida = filter_input(INPUT_POST, "qtde_permitida", FILTER_VALIDATE_INT);
        $disponivel = filter_input(INPUT_POST, "disponivel", FILTER_SANITIZE_STRIPPED);

        $opcional = (new Opcionais())->findByCode($code);

        if (empty($opcional)) {
            $json['error'] = $this->message->error("Categoria Opcional não encontrada")->render();
            echo json_encode($json);
            return;
        }

        /* campos do produto para alterar */
        $opcional->categoria = $categoria;
        $opcional->cat_id = $cat_id;
        $opcional->obrigatorio = $obrigatorio;
        $opcional->qtde_permitida = $qtde_permitida;
        $opcional->disponivel = $disponivel;

        /* ajustando slug */
        $opcional->slug_categoria = str_slug($categoria);


        /* salvando dados do produto */
        if (!$opcional->save()) {
            $json['error'] = $opcional->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Categoria Opcional {$opcional->categoria} atualizada com sucesso")->flash();
        $json['redirect'] = url("/{$data['company']}/panel/produtos/opcionais/{$data['page']}");
        echo json_encode($json);
        return;
    }

    /**
     * PANEL: OPCIONAIS - CADASTRO DE OPÇÕES
     */
    public
    function opcionaisCadastroOpcoes(?array $data): void
    {

        /* recebendo dados do form */
        $categoria_id = filter_input(INPUT_POST, "categoria_id", FILTER_VALIDATE_INT);
        $empresa_id = filter_input(INPUT_POST, "empresa_id", FILTER_VALIDATE_INT);
        $opcional = filter_input(INPUT_POST, "opcional", FILTER_SANITIZE_STRIPPED);
        $slug_categoria = filter_input(INPUT_POST, "slug_categoria", FILTER_SANITIZE_STRIPPED);
        $valor = filter_input(INPUT_POST, "valor", FILTER_SANITIZE_STRIPPED);

        $opcao = (new Opcoes())->bootstrap(
            "{$opcional}",
            "{$categoria_id}",
            "{$empresa_id}"
        );

        $opcao->opcional_slug = str_slug($opcional);
        $opcao->slug_categoria = str_slug($slug_categoria);

        if (!empty($valor)) {
            $opcao->valor = $valor;
        } else {
            $opcao->valor = null;
        }

        if (!$opcao->save()) {
            $json['error'] = $opcao->message()->render();
            echo json_encode($json);
            return;
        }

        /* recarregando as opções */
        $opcoes = (new Opcoes())->findByCategoriaId($categoria_id);
        $response_options = null;
        if (!empty($opcoes)) {
            foreach ($opcoes as $opcao) {
                $icon = icon("times");
                $response_options .= "
                    <div class='option_item row'>

                                        <div class='col-sm-4'>
                                            <input 
                                            class='form-control'
                                            data-alledit
                                            data-entity='" . crypt_entity("opcionais") . "'
                                            data-field='opcional'
                                            data-url='" . url("/allEdit") . "'
                                            data-code=\"{$opcao->code}\"
                                            type='text' 
                                            value=\"{$opcao->opcional}\">
                                        </div>
                                        <div class='col-sm-4'>
                                        <select class='form-control'
                                            data-changedispoption
                                            data-code=\"{$opcao->code}\"
                                            data-url='" . url("/changeDispOption") . "'>
                                            <option " . ($opcao->disponivel == "sim" ? "selected" : "") . " value=\"sim\">DISPONÍVEL</option>
                                            <option " . ($opcao->disponivel == "nao" ? "selected" : "") . " value=\"nao\">NÃO DISPONÍVEL</option>
                                            </select>
                                        </div>
                                        
                                        <div class='col-sm-3'>
                                            <input
                                             data-alledit
                                            data-entity='" . crypt_entity("opcionais") . "'
                                            data-field='valor'
                                            data-url='" . url("/allEdit") . "'
                                            data-code=\"{$opcao->code}\"
                                            type='text' class='maskMoney form-control' value=\"{$opcao->valor}\">
                                            
                                        </div>
                                        <div class='col-sm-1'>
                                        <a href='#'
                                                data-deleteoption='true'
                                                data-url='" . url("/delOption") . "'
                                                data-code=\"{$opcao->code}\"
                                                class='badge badge-danger btn-exclude'>{$icon}</a>
                                        </div>
                              </div>";
            }
        }

        $response_options .= "
        <script>
        $(\".maskMoney\").maskMoney({showSymbol: false, symbol: \"R$\", decimal: \".\", thousands: \"\"});
            $(\"#selected\").select();
        
            $(\"[data-deleteoption]\").click(function (e) {
            e.preventDefault();
            obj = $(this);
            dataset = obj.data()
            dataset.value = obj.val()
            
                // $.post(url, dados, function(response){}, \"json\");
                $.post(dataset.url, dataset, function (response) {
                    // error
                    if (response.error) {
                        alert(response.error)
                    }
                    //redirect
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                    
                    if (response.assincronus_options) {
                        $(\".loadResponseOptions\").html(response.assincronus_options);
                    }
                }, \"json\");            
            })
        </script>
        ";

        $json['assincronus_options'] = $response_options;
        echo json_encode($json);
        return;
    }

    /**
     * PANEL: PRODUTOS - CADASTRO / LISTA
     */
    public
    function produtosLista(?array $data): void
    {
        protect_company_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* recebendo dados do form */
            $categoria_id = filter_input(INPUT_POST, "categoria_id", FILTER_VALIDATE_INT);
            $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRIPPED);
            $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRIPPED);
            $valor = filter_input(INPUT_POST, "valor", FILTER_SANITIZE_STRIPPED);
            $opcionais = ($data['opcionais'] ?? null);

            /* verificando a imagem */

            $file = $_FILES['imagem'];
            if ($file['name'] == "") {
                $json['error'] = $this->message->error("SELECIONE UMA IMAGEM PARA O PRODUTO")->render();
                echo json_encode($json);
                return;
            } else {
                $upload = (new Upload());
                if (!$upload->image($file, $this->empresa->slug)) {
                    $json['error'] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }
            }

            $produto = (new Produtos())->bootstrap(
                "{$this->empresa->id}",
                "{$categoria_id}",
                "{$nome}",
                "{$descricao}",
                "{$valor}",
                "{$upload->name}"
            );

            /* Formatando os opcionais caso tenham */
            if (!empty($opcionais)) {
                $produto->opcionais = null;
                $ultimo = end($opcionais);

                foreach ($opcionais as $opcional) {
                    if ($opcional != $ultimo) {
                        $produto->opcionais .= $opcional . ",";
                    } else {
                        $produto->opcionais .= $opcional;
                    }

                }
            }

            if (!$produto->save()) {
                $json['error'] = $produto->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Produto {$nome} cadastrado com sucesso")->flash();
            $json['redirect'] = url("{$data['company']}/panel/produtos/lista");
            echo json_encode($json);
            return;
        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("shopping-cart") . " Produtos / Lista";
        $page_subtitle = "Gerencie os produtos de sua loja";

        $categorias = (new Categorias())->find("empresa_id = :id", "id={$this->empresa->id}");

        $produtos = (new Produtos())->find("empresa_id = :id", "id={$this->empresa->id}");

        $opcionais = (new Opcionais())->order("categoria")->find("empresa_id = :id AND categoria IS NOT NULL", "id={$this->empresa->id}")->fetch(true);

        /* contar as produtos */
        $num_produtos = $produtos->count();

        /* montar a url do Paginator */
        $pager = new Pager(url("/{$this->empresa->slug}/panel/produtos/lista/"));

        /* configurar o paginator */
        $pager->pager($num_produtos, LIMITE_PAGINACAO, ($data['page'] ?? 1));

        echo $this->view->render(
            "produtos_lista",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "categorias" => $categorias->order("nome ASC")->fetch(true),
                "produtos" => $produtos->limit($pager->limit())->offset($pager->offset())->order("categoria_id ASC, nome ASC")->fetch(true),
                "opcionais" => $opcionais,
                "paginator" => $pager
            ]
        );
    }

    /**
     * PANEL: PRODUTOS - EDITAR
     */
    public
    function produtosProdutosEditar(?array $data): void
    {
        /* recebendo dados do form */
        $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_STRIPPED);
        $categoria_id = filter_input(INPUT_POST, "categoria_id", FILTER_VALIDATE_INT);
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRIPPED);
        $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRIPPED);
        $valor = filter_input(INPUT_POST, "valor", FILTER_SANITIZE_STRIPPED);
        $disponivel = filter_input(INPUT_POST, "disponivel", FILTER_SANITIZE_STRIPPED);
        $opcionais = ($data['opcionais'] ?? null);

        $produto = (new Produtos())->findByCode($code);
        $empresa = $produto->empresa();

        if (empty($produto)) {
            $json['error'] = $this->message->error("Produto não encontrado")->render();
            echo json_encode($json);
            return;
        }

        $produto = (new Produtos())->findByCode($code);

        /* campos do produto para alterar */
        $produto->categoria_id = $categoria_id;
        $produto->nome = $nome;
        $produto->descricao = $descricao;
        $produto->valor = $valor;
        $produto->disponivel = $disponivel;
        $produto->opcionais = $opcionais;

        /* Formatando os opcionais caso tenham */
        if (!empty($opcionais)) {
            $produto->opcionais = null;
            $ultimo = end($opcionais);

            foreach ($opcionais as $opcional) {
                if ($opcional != $ultimo) {
                    $produto->opcionais .= $opcional . ",";
                } else {
                    $produto->opcionais .= $opcional;
                }

            }
        }

        /* salvando dados do produto */
        if (!$produto->save()) {
            $json['error'] = $produto->message()->render();
            echo json_encode($json);
            return;
        }

        /* verificando a imagem */
        $file = $_FILES['imagem'];

        if (!empty($file['name'])) {

            /* Primeiro apagar a imagem que está no servidor */
            $dir_images = CONF_UPLOAD_IMAGES_PRODUTOS;
            $delete_file = new Upload();
            if (!$delete_file->remove(CONF_UPLOAD_IMAGES_PRODUTOS . "{$produto->imagem}")) {
                $json['error'] = $delete_file->message()->render();
                echo json_encode($json);
                return;
            }

            /* depois fazer o upload da nova */
            $upload = (new Upload());
            if (!$upload->image($file, $empresa->slug)) {
                $json['error'] = $upload->message()->render();
                echo json_encode($json);
                return;
            }

            /* salvando a imagem no produto */
            $produto = (new Produtos())->findByCode($code);
            $produto->imagem = $upload->name;

            if (!$produto->save()) {
                $json['error'] = $produto->message()->render();
                echo json_encode($json);
                return;
            }
        }

        $this->message->success("Produto {$produto->nome} atualizado com sucesso")->flash();
        $json['redirect'] = url("/{$data['company']}/panel/produtos/lista/{$data['page']}");
        echo json_encode($json);
        return;
    }

    /**
     * PANEL: LOJA - CONFIGURAÇÕES
     * @param array|null $data
     */
    public
    function lojaConfiguracoes(?array $data): void
    {
        protect_company_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* recebendo dados do form */
            $whatsapp_atendimento = filter_input(INPUT_POST, "whatsapp_atendimento", FILTER_VALIDATE_INT);
            $taxa_entrega = filter_input(INPUT_POST, "taxa_entrega", FILTER_SANITIZE_STRIPPED);
            $horario_abertura = filter_input(INPUT_POST, "horario_abertura", FILTER_SANITIZE_STRIPPED);
            $horario_fechamento = filter_input(INPUT_POST, "horario_fechamento", FILTER_SANITIZE_STRIPPED);
            $msg_confirmacao = filter_input(INPUT_POST, "msg_confirmacao", FILTER_SANITIZE_STRIPPED);
            $msg_entrega = filter_input(INPUT_POST, "msg_entrega", FILTER_SANITIZE_STRIPPED);

            if (empty($whatsapp_atendimento) OR strlen($whatsapp_atendimento) < 10) {
                $json['error'] = $this->message->error("Preencha corretamente o número de Whatsapp")->render();
                echo json_encode($json);
                return;
            }

            if (empty($horario_abertura) OR empty($horario_fechamento)) {
                $json['error'] = $this->message->error("Preencha os dois horários")->render();
                echo json_encode($json);
                return;
            }

            if (empty($msg_confirmacao)) {
                $json['error'] = $this->message->error("Preencha a mensagem de confirmação")->render();
                echo json_encode($json);
                return;
            }

            if (empty($msg_entrega)) {
                $json['error'] = $this->message->error("Preencha a mensagem de saída para entrega")->render();
                echo json_encode($json);
                return;
            }

            $empresa = (new Empresas())->findById($this->empresa->id);

            /* verificando a imagem */
            $file = $_FILES['imagem'];

            if (!empty($file['name'])) {

                /* verificar se tem logomarca cadastrada */
                if (!empty($empresa->logomarca)) {
                    /* Primeiro apagar a imagem que está no servidor */
                    $dir_images = CONF_UPLOAD_IMAGES_LOGOMARCA;
                    $delete_file = new Upload();
                    if (!$delete_file->remove(CONF_UPLOAD_IMAGES_LOGOMARCA . "{$empresa->logomarca}")) {
                        $json['error'] = $delete_file->message()->render();
                        echo json_encode($json);
                        return;
                    }
                }

                /* depois fazer o upload da nova */
                $upload = (new Upload());
                if (!$upload->image_logo($file, $empresa->slug)) {
                    $json['error'] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                /* campo atualizados */
                $empresa->logomarca = $upload->name;
            }

            $empresa->whatsapp_atendimento = $whatsapp_atendimento;
            $empresa->taxa_entrega = ($taxa_entrega != "" ? $taxa_entrega : null);
            $empresa->horario_abertura = $horario_abertura;
            $empresa->horario_fechamento = $horario_fechamento;
            $empresa->msg_confirmacao = $msg_confirmacao;
            $empresa->msg_entrega = $msg_entrega;

            if (!$empresa->save()) {
                $json['error'] = $empresa->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Informações da Loja cadastradas/atualizadas com sucesso")->flash();
            $json['redirect'] = url("{$data['company']}/panel/loja/configuracoes");
            echo json_encode($json);
            return;
        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("cog") . " Loja / Configurações";
        $page_subtitle = "Gerencie sua loja";

        echo $this->view->render(
            "loja",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle
            ]
        );
    }

    /**
     * PANEL: LOJA - TAXAS DE ENTRREGA
     * @param array|null $data
     */
    public
    function lojaTaxasEntrega(?array $data): void
    {
        protect_company_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* recebendo dados do form */
            $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRIPPED);
            $taxa_entrega = filter_input(INPUT_POST, "taxa_entrega", FILTER_VALIDATE_FLOAT);

            $taxa = (new TaxaEntrega())->bootstrap(
                "{$this->empresa->id}",
                "{$bairro}",
                $taxa_entrega
            );

            if (!$taxa->save()) {
                $json['error'] = $taxa->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("TAxa de Entrega cadastrada com sucesso")->flash();
            $json['redirect'] = url("{$data['company']}/panel/loja/taxas-de-entrega");
            echo json_encode($json);
            return;
        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("cog") . " Loja / Taxas de Entrega";
        $page_subtitle = "Gerencie sua loja";

        $taxas = (new TaxaEntrega())->find("empresa_id = :id", "id={$this->empresa->id}");
        $n_taxas = $taxas->count();

        /* montar a url do Paginator */
        $pager = new Pager(url("/{$this->empresa->slug}/panel/loja/taxas-de-entrega/"));

        /* configurar o paginator */
        $pager->pager($n_taxas, LIMITE_PAGINACAO, ($data['page'] ?? 1));


        echo $this->view->render(
            "loja_taxas",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "taxas" => $taxas->order("bairro")->limit($pager->limit())->offset($pager->offset())->fetch(true),
                "paginator" => $pager
            ]
        );
    }

    /**
     * PANEL: LOJA - TAXAS DE ENTREGA - EDITAR
     */
    public
    function lojaTaxasEntregaEditar(?array $data): void
    {
        /* recebendo dados do form */
        $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_STRIPPED);
        $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRIPPED);
        $taxa_entrega = filter_input(INPUT_POST, "taxa_entrega", FILTER_SANITIZE_STRIPPED);

        /* selecionando a categoria */
        $taxa = (new TaxaEntrega())->findByCode($code);

        if (empty($taxa)) {
            $json['error'] = $this->message->error("Taxa de Entrega não encontrada")->render();
            echo json_encode($json);
            return;
        }

        if (empty($taxa_entrega)) {
            $taxa_entrega = null;
        }

        /* Dados a serem alterados */
        $taxa->bairro = $bairro;
        $taxa->taxa_entrega = $taxa_entrega;

        if (!$taxa->save()) {
            $json['error'] = $taxa->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Taxa de Entrega do bairro {$taxa->bairro} atualizada com sucesso")->flash();
        $json['redirect'] = url("/{$data['company']}/panel/loja/taxas-de-entrega/{$data['page']}");
        echo json_encode($json);
        return;
    }

    /**
     * PANEL: PERFIL
     * @param array|null $data
     */
    public
    function perfil(?array $data): void
    {
        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* dados do form */
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
            $empresa = $this->empresa;

            /* Dados a alterar */
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

            if (!empty($data['senha'])) {
                if (!is_passwd($data['senha'])) {
                    $json['error'] = $this->message->error("A senha deve conter entre 8 e 40 caracteres")->render();
                    echo json_encode($json);
                    return;
                }

                $empresa->senha = passwd($data['senha']);
            }

            if (!$empresa->save()) {
                $json['error'] = $empresa->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Dados da empresa atualizados com sucesso")->flash();
            $json['redirect'] = url("{$empresa->slug}/panel/perfil");
            echo json_encode($json);
            return;

        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("cog") . " Perfil / Configurações";
        $page_subtitle = "Gerencie seu perfil";

        echo $this->view->render(
            "perfil",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle
            ]
        );
    }

    /**
     * PANEL: FINANCEIRO
     */
    public function financeiro(?array $data): void
    {
        protect_company_pages();

        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("Requisição inválida. Recarregue a página.")->render();
                echo json_encode($json);
                return;
            }

            /* Recebendo dados do form */
            $data_inicial = filter_input(INPUT_POST, "data_inicial", FILTER_SANITIZE_STRIPPED);
            $data_final = filter_input(INPUT_POST, "data_final", FILTER_SANITIZE_STRIPPED);
            $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRIPPED);
            $entrega = filter_input(INPUT_POST, "entrega", FILTER_SANITIZE_STRIPPED);
            $forma_pagamento = filter_input(INPUT_POST, "forma_pagamento", FILTER_SANITIZE_STRIPPED);

            /* validando os campos */
            if (empty($data_inicial)) {
                $json['error'] = $this->message->error("Preencha a data inicial")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data_final)) {
                $json['error'] = $this->message->error("Preencha a data final")->render();
                echo json_encode($json);
                return;
            }

            if ($data_final < $data_inicial) {
                $json['error'] = $this->message->error("A data final não pode ser anterior à data inicial")->render();
                echo json_encode($json);
                return;
            }

            $terms = null;
            $params = null;

            /* verifcando o status */
            if ($status != "") {
                $terms .= " AND status = :status";
                $params .= "status={$status}";
            }

            /* verificando Tipo de Entrega */
            if ($entrega != "") {

                /* se anterior != "" precisa de AND e & */
                if ($status != "") {
                    $e = "&";
                } else {
                    $e = "";
                }

                $terms .= " AND entrega = :entrega";
                $params .= "{$e}entrega={$entrega}";
            }

            /* verificando Forma de Pagamento */
            if ($forma_pagamento != "") {

                /* se anterior != "" precisa de AND e & */
                if ($status != "" OR $entrega != "") {
                    $e = "&";
                } else {
                    $e = "";
                }

                $terms .= " AND forma_pagamento = :forma_pagamento";
                $params .= "{$e}forma_pagamento={$forma_pagamento}";
            }

            $pedidos = (new Pedidos())->find("empresa_id = :id AND DATE(created_at) BETWEEN \"{$data_inicial}\" AND \"{$data_final}\"
            {$terms}", "id={$this->empresa->id}&{$params}")->order("n_ordem ASC")
                //->count();
            ->fetch(true);

            $json['assincronus'] = null;

            /* Tipos de pedidos */
            $p_novo = null;
            $p_recebido = null;
            $p_confirmado = null;
            $p_delivery = null;
            $p_entregue = null;
            $p_cancelado = null;

            $n_novo = 0;
            $n_recebido = 0;
            $n_confirmado = 0;
            $n_delivery = 0;
            $n_pentregue = 0;
            $n_cancelado = 0;

            $n_entregue = null;
            $n_nao_entregue = null;

            if (empty($pedidos)) {
                $json['assincronus'] .= " <tr>
                                            <td colspan='8'>
                                            " . icon("ban") . "NÃO FORAM ENCONTRADOS REGISTROS PARA O FILTRO ACIMA
                                            </td></tr>";
            } else {
                foreach ($pedidos as $pedido) {

                    /* Somando os totais */

                    switch ($pedido->status):
                        case "novo";
                                $icon = ICON_PEDIDO_NOVO;
                                $color = COR_ICON_PEDIDO_NOVO;
                                $p_novo += $pedido->total;
                                $n_nao_entregue += 1;
                                $n_novo += 1;
                                break;
                        case "recebido";
                                $icon = ICON_PEDIDO_RECEBIDO;
                                $color = COR_ICON_PEDIDO_RECEBIDO;
                                $p_recebido += $pedido->total;
                                $n_nao_entregue += 1;
                                $n_recebido += 1;
                                break;
                        case "confirmado";
                                $icon = ICON_PEDIDO_CONFIRMADO;
                                $color = COR_ICON_PEDIDO_CONFIRMADO;
                                $p_confirmado += $pedido->total;
                                $n_nao_entregue += 1;
                                $n_confirmado += 1;
                                break;
                        case "delivery";
                                $icon = ICON_PEDIDO_DELIVERY;
                                $color = COR_ICON_PEDIDO_DELIVERY;
                                $p_delivery += $pedido->total;
                                $n_nao_entregue += 1;
                                $n_delivery += 1;
                                break;
                        case "entregue";
                                $icon = ICON_PEDIDO_ENTREGUE;
                                $color = COR_ICON_PEDIDO_ENTREGUE;
                                $p_entregue += $pedido->total;
                                $n_entregue += 1;
                                $n_pentregue += 1;
                                break;
                        case "cancelado";
                                $icon = ICON_PEDIDO_CANCELADO;
                                $color = COR_ICON_PEDIDO_CANCELADO;
                                $p_cancelado += $pedido->total;
                                $n_nao_entregue += 1;
                                $n_cancelado += 1;
                                break;
                    endswitch;

                    $json['assincronus'] .=
                        "
                        <tr>
                        <td>{$pedido->n_ordem}</td>
                        <td>".date_pedido($pedido->created_at)."</td>
                        <td><span style=\"color: {$color}\">".icon("{$icon}") ."</span> ". str_title($pedido->status)."</td>
                        <td>" . currency($pedido->total) . "</td>
                        <td>{$pedido->nome}</td>
                        <td>{$pedido->whatsapp}</td>
                        <td>".str_title($pedido->entrega)."</td>
                        <td>".str_title($pedido->forma_pagamento)."</td>                                               
                        </tr>";
                } // endforeach

                $json['assincronus'] .= "
                        <tr>
                            <td colspan='3'>
                            <br>
                                <strong>TOTAIS:</strong>
                                <table style='width: 100%'>
                                <tr>
                                    <td><span style=\"color: ".COR_ICON_PEDIDO_NOVO." \">".icon(ICON_PEDIDO_NOVO) ."</span> Pedidos Novos</td>
                                    <td>{$n_novo}</td>
                                    <td>".currency($p_novo)."</td>
                                </tr>
                                
                                <tr>
                                    <td><span style=\"color: ".COR_ICON_PEDIDO_RECEBIDO." \">".icon(ICON_PEDIDO_RECEBIDO) ."</span> Pedidos Recebidos</td>
                                    <td>{$n_recebido}</td>
                                    <td>".currency($p_recebido)."</td>
                                </tr>
                                
                                <tr>
                                    <td><span style=\"color: ".COR_ICON_PEDIDO_CONFIRMADO." \">".icon(ICON_PEDIDO_CONFIRMADO) ."</span>Pedidos Confirmados</td>
                                    <td>{$n_confirmado}</td>
                                    <td>".currency($p_confirmado)."</td>
                                </tr>
                                
                                
                                <tr>
                                    <td><span style=\"color: ".COR_ICON_PEDIDO_DELIVERY." \">".icon(ICON_PEDIDO_DELIVERY) ."</span>Pedidos Delivery</td>
                                    <td>{$n_delivery}</td>
                                    <td>".currency($p_delivery)."</td>
                                </tr>
                                
                                <tr>
                                    <td><span style=\"color: ".COR_ICON_PEDIDO_ENTREGUE." \">".icon(ICON_PEDIDO_ENTREGUE) ."</span>Pedidos Entregues</td>
                                    <td>{$n_pentregue}</td>
                                    <td>".currency($p_entregue)."</td>
                                </tr>
                                
                                <tr>
                                    <td><span style=\"color: ".COR_ICON_PEDIDO_CANCELADO." \">".icon(ICON_PEDIDO_CANCELADO) ."</span> Pedidos Cancelados</td>
                                    <td>{$n_cancelado}</td>
                                    <td>".currency($p_cancelado)."</td>
                                </tr>
                                </table>
                            </td>
                        </tr>
                        ";


            }
            echo json_encode($json);
            return;
        }

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("refresh") . " Financeiro";
        $page_subtitle = "Gerencie os recebimentos de sua loja";

        echo $this->view->render(
            "financeiro",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
            ]
        );
    }

    /**
     * @param array|null $data
     */
    public
    function videos(? array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("video-camera") . " Videos / Manual";
        $page_subtitle = "Videos de Configuração da Loja";

        echo $this->view->render(
            "videos",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle
            ]
        );
    }

    /**
     * @param array|null $data
     */
    public function print_pedido(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("video-camera") . " Videos / Manual";
        $page_subtitle = "Videos de Configuração da Loja";

        $pedido = (new Pedidos())->findByCode($data['code']);

        echo $this->view->render(
            "print_pedido_html",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "pedido" => $pedido,
            ]
        );
    }


    /**
     * Neste método chega o ajax e abre o pop-up
     * @param array|null $data
     */
    public function printPedidoPdf(?array $data): void
    {
        /* recebendo os dados */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);

        $pedido = (new Pedidos())->findByCode($code);

        if (empty($pedido)) {
            $json['error'] = $this->message->error("Pedido não encontrado")->render();
            echo json_encode($json);
            return;
        }

        $json['echo'] = "
        <script>
            window.open('" . url("/print_pedido_pdf/{$pedido->code}") . "', \"Pedido\", \"width=500,height=600\");
        </script>
        ";
        echo json_encode($json);
        return;
    }

    /**
     * Este método gera o pdf e abre a impressão
     * @param array|null $data
     */
    public function print_pedido_pdf(?array $data): void
    {

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | Panel - " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $page_title = icon("video-camera") . " Videos / Manual";
        $page_subtitle = "Videos de Configuração da Loja";

        $pedido = (new Pedidos())->findByCode($data['code']);

        echo $this->view->render(
            "print_pedido_pdf",
            [
                "seo" => $seo,
                "usuario" => $this->usuario,
                "empresa" => $this->empresa,
                "page_title" => $page_title,
                "page_subtitle" => $page_subtitle,
                "pedido" => $pedido,
            ]
        );
    }

    /**
     *
     */
    public
    function sair(): void
    {
        protect_company_pages();

        /* montando a rotina de logout */
        $auth = new LoginEmpresa();

        /* dados */
        if ($auth->authDestroy()) {
            redirect(url("/{$this->empresa->slug}/panel"));
            return;
        }
    }

}
