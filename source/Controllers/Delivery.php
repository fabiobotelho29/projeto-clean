<?php


namespace Source\Controllers;


use Source\Core\Controller;
use Source\Core\Login;
use Source\Core\Session;
use Source\Core\View;
use Source\Models\Carrinho;
use Source\Models\Categorias;
use Source\Models\Empresas;
use Source\Models\Opcionais;
use Source\Models\Opcoes;
use Source\Models\Pedidos;
use Source\Models\Produtos;
use Source\Models\StatusUsuario;
use Source\Models\TaxaEntrega;
use Source\Models\Usuarios;
use Source\Support\SwiftMail;

/**
 * Class Delivery
 * @package Source\Controllers
 */
class Delivery extends Controller
{

    /** @var $empresa Empresas */
    protected $empresa;

    /**
     * TestController constructor.
     */
    public function __construct()
    {
        $pathToViews = __DIR__ . "/../../themes/" . VIEWS_DELIVERY_THEME . "/";

        parent::__construct($pathToViews);

    }

    /**
     * #############################
     * ###  CONSTRUÇÃO DAS ROTAS ###
     * #############################
     */


    /**
     * HOME
     */
    public function home(?array $data): void
    {

        protect_delivery_pages($data['company']);

        /* Selecionando a emprsa */
        $empresa = (new Empresas())->findBySlug($data['company']);

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $company = $data['company'];

        /* verificando se temos a sessão cart */
        $valor_pedido = (new Carrinho())->getTotal();

        /* Dados para a página */
        $categorias = (new Categorias())
            ->order("nome")
            ->find("empresa_id = :id AND disponivel = :d",
                "id={$empresa->id}&d=sim")->fetch(true);

        echo $this->view->render(
            "home",
            [
                "seo" => $seo,
                "empresa" => $empresa,
                "categorias" => $categorias,
                "valor_pedido" => $valor_pedido
            ]
        );
    }

    /**
     * PRODUCT
     */
    public function product(?array $data): void
    {
        protect_delivery_pages($data['company']);
        /* Selecionando a emprsa */
        $empresa = (new Empresas())->findBySlug($data['company']);

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $company = $data['company'];

        /* Dados para a página */
        $produto = (new Produtos())->findByCode($data['product']);
        $categoria = (new Categorias())->findById("{$produto->categoria_id}");

        if (empty($produto)) {
            redirect("/{$empresa->slug}");
        }

        echo $this->view->render(
            "product",
            [
                "seo" => $seo,
                "empresa" => $empresa,
                "produto" => $produto,
                "categoria" => $categoria,
            ]
        );
    }

    /**
     * CART
     */
    public function cart(?array $data): void
    {
        protect_delivery_pages($data['company']);
        /* Selecionando a emprsa */
        $empresa = (new Empresas())->findBySlug($data['company']);

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        /* verificando se temos a sessão cart */
        $valor_pedido = (new Carrinho())->getTotal();

        $cart = (new Carrinho())->getCart();

        $company = $data['company'];

        echo $this->view->render(
            "cart",
            [
                "seo" => $seo,
                "empresa" => $empresa,
                "valor_pedido" => $valor_pedido,
                "cart" => $cart
            ]
        );
    }

    /**
     * CHECKOUT
     */
    public function checkout(?array $data): void
    {
        protect_delivery_pages($data['company']);

        /* Selecionando a emprsa */
        $empresa = (new Empresas())->findBySlug($data['company']);

        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        $company = $data['company'];

        $taxas = (new TaxaEntrega())->find("empresa_id = :id AND disponivel='sim'", "id={$empresa->id}")
            ->order("bairro")
            ->fetch(true);

        /* verificando se temos a sessão cart */
        $valor_pedido = (new Carrinho())->getTotal();

        $cart = (new Carrinho())->getCart();

        /* chekando a existência dos cookies */
        if (isset($_COOKIE['cliente_nome'])){
            $cliente = [
                "nome" => $_COOKIE['cliente_nome'] ?? "",
                "whatsapp" => $_COOKIE['cliente_whatsapp'] ?? "",
                "cep" => $_COOKIE['cliente_cep'] ?? "",
                "logradouro" => $_COOKIE['cliente_logradouro'] ?? "",
                "numero" => $_COOKIE['cliente_numero'] ?? "",
                "complemento" => $_COOKIE['cliente_complemento'] ?? "",
                "bairro" => $_COOKIE['cliente_bairro'] ?? "",
                "municipio" => $_COOKIE['cliente_municipio'] ?? "",
                "ponto_referência" => $_COOKIE['cliente_ponto_referencia'] ?? "",
                "forma_pagamento" => $_COOKIE['cliente_forma_pagamento'] ?? "",
            ];
        }

        echo $this->view->render(
            "checkout",
            [
                "seo" => $seo,
                "empresa" => $empresa,
                "valor_pedido" => $valor_pedido,
                "cart" => $cart,
                "cliente" => $cliente ?? null,
                "taxas" => $taxas
            ]
        );
    }

    /**
     * @param array|null $data
     */
    public function notFound(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        echo $this->view->render(
            "not_found",
            [
                "seo" => $seo,
            ]
        );
    }

    /**
     * @param array|null $data
     */
    public function unavailable(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        echo $this->view->render(
            "unavailable",
            [
                "seo" => $seo,
            ]
        );
    }

    /**
     * @param array|null $data
     */
    public function closed(?array $data): void
    {
        $seo = $this->seo
            ->title(SEO_SITE_NAME . " | " . SEO_SITE_SUBTITLE)
            ->favicon()->render();

        echo $this->view->render(
            "closed",
            [
                "seo" => $seo,
            ]
        );
    }

    /**
     * DELIVERY - ADD PRODUTO
     * @param array|null $data
     */
    public function addProduct(?array $data): void
    {
        /* recebendo os dados do formulário */
        $code_produto = filter_input(INPUT_POST, "product", FILTER_SANITIZE_STRIPPED);
        $code_empresa = filter_input(INPUT_POST, "empresa", FILTER_SANITIZE_STRIPPED);
        $produto = (new Produtos())->findByCode($code_produto);
        $empresa = (new Empresas())->findByCode($code_empresa);
        $valor_base = $produto->valor;
        $valor_opcionais = 0;
        $quantidade = filter_input(INPUT_POST, "prod_qtde", FILTER_VALIDATE_INT);
        $observacoes = filter_input(INPUT_POST, "observacoes", FILTER_SANITIZE_STRIPPED);

        /* unset nos datas acima */
        unset($data['product']);
        unset($data['prod_qtde']);
        unset($data['empresa']);
        unset($data['observacoes']);

        /* recuperando no produto o opcionais que é obrigatório */
        $opcionais = $produto->opcionais;

        if (strpos($opcionais, ",")) {
            /* é array */
            $explode = explode(",", $opcionais);

            /* girando os opcionais do produto */
            foreach ($explode as $opcional) {

                $obrigatorio = (new Opcionais())->find("id = :id AND obrigatorio = 'sim'", "id={$opcional}")->fetch();

                /* caso encontre obrigatório */
                if (!empty($obrigatorio)) {

                    /* verificando se o obrigatório foi preenchido no formulário */
                    if (!array_key_exists($obrigatorio->slug_categoria, $data)) {
                        $json['error'] = $this->message->error("O Opcional {$obrigatorio->categoria} é obrigatório")->render();
                        echo json_encode($json);
                        return;
                    }
                }

            }

        } else {
            /* não é array */
            $obrigatorio = (new Opcionais())->find("id = :id AND obrigatorio = 'sim'", "id={$opcionais}")->fetch();

            /* caso encontre obrigatório */
            if (!empty($obrigatorio)) {

                /* verificando se o obrigatório foi preenchido no formulário */
                if (!array_key_exists($obrigatorio->slug_categoria, $data)) {
                    $json['error'] = $this->message->error("O Opcional {$obrigatorio->categoria} é obrigatório")->render();
                    echo json_encode($json);
                    return;
                }
            }
        }

        /* só sobram os $data opcionais */
        $carrinho_opcionais = null;

        /* para cada opcional que estiver preenchido */
        foreach ($data as $key => $value) {

            /* selecionando o opcional */
            $opcional = (new Opcionais())->find(
                "empresa_id = :emp AND slug_categoria = :slug AND cat_id IS NOT NULL",
                "emp={$empresa->id}&slug={$key}")->fetch();

            /* valor de cada opcional escolhido */
            $valor_opcional = $opcional->valor;

            /* se o opcional não for array */
            if (!is_array($value)) {

                /* Selecionando a opção */
                $opcao = (new Opcoes())->findById($value);

                $carrinho_opcionais .= "{$opcional->categoria}: {$opcao->opcional}\n({$quantidade}x " . currency($opcao->valor) . ")|";

                /* somando o valor base */
                $valor_opcionais += $opcao->valor;

            } else {

                /* o opcional é um arrau */
                foreach ($value as $opcional_array) {

                    /* Selecionando a opção */
                    $opcao = (new Opcoes())->findById($opcional_array);

                    $carrinho_opcionais .= "{$opcional->categoria}: {$opcao->opcional}\n({$quantidade}x " . currency($opcao->valor) . ")|";
                    $valor_opcionais += $opcao->valor;
                }

            }

        }

        /* montando o produto no pedido */
        $carrinho = (new Carrinho())->bootstrap(
            "{$quantidade}",
            "{$produto->nome}",
            "{$produto->valor}",
            "{$valor_opcionais}",
            "{$carrinho_opcionais}",
            "{$observacoes}"
        );

        if (!$carrinho->add_product()) {
            $json['error'] = $carrinho->message()->render();
            echo json_encode($json);
            return;
        }

        $json['redirect'] = url("/{$empresa->slug}");
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function removeProduct(?array $data): void
    {
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);
        $indice = filter_var($data['indice'], FILTER_VALIDATE_INT);

        $empresa = (new Empresas())->findByCode($code);

        /* retirando a sessão da cart */
        $cart = (new Carrinho())->remove_product($indice);

        $json['redirect'] = url("{$empresa->slug}/cart");
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function sendPedido(?array $data): void
    {
        if (!empty($data['csrf'])) {

            if (!csrf_verify($data)) {
                $json['error'] = $this->message->error("RECARREGUE A PÁGINA")->render();
                echo json_encode($json);
                return;
            }

            /* recebendo os dados do formulário */
            $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_STRIPPED);
            $forma_envio = filter_input(INPUT_POST, "forma_envio", FILTER_SANITIZE_STRIPPED);
            $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRIPPED);
            $whatsapp = filter_input(INPUT_POST, "whatsapp", FILTER_SANITIZE_STRIPPED);
            $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRIPPED);
            $logradouro = filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_STRIPPED);
            $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_STRIPPED);
            $complemento = filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_STRIPPED);
            $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRIPPED);
            $municipio = filter_input(INPUT_POST, "municipio", FILTER_SANITIZE_STRIPPED);
            $ponto_referencia = filter_input(INPUT_POST, "ponto_referencia", FILTER_SANITIZE_STRIPPED);
            $forma_pagamento = filter_input(INPUT_POST, "forma_pagamento", FILTER_SANITIZE_STRIPPED);
            $troco = filter_input(INPUT_POST, "troco", FILTER_SANITIZE_STRIPPED);

            /* validando os campos */
            if (empty($forma_envio)) {
                $json['error'] = $this->message->error("SELECIONE A FORMA DE ENVIO")->render();
                echo json_encode($json);
                return;
            }

            if (empty($nome)) {
                $json['error'] = $this->message->error("PREENCHA SEU NOME")->render();
                echo json_encode($json);
                return;
            }

            if (empty($whatsapp)) {
                $json['error'] = $this->message->error("PREENCHA SEU WHATSAPP")->render();
                echo json_encode($json);
                return;
            }
/*
            if (empty($cep)) {
                $json['error'] = $this->message->error("PREENCHA O CEP PARA ENTREGA")->render();
                echo json_encode($json);
                return;
            }
*/
            if (empty($logradouro)) {
                $json['error'] = $this->message->error("PREENCHA O LOGRADOURO PARA ENTREGA")->render();
                echo json_encode($json);
                return;
            }

            if (empty($numero)) {
                $json['error'] = $this->message->error("PREENCHA O NÚMERO DO ENDEREÇO")->render();
                echo json_encode($json);
                return;
            }

            if (empty($bairro)) {
                $json['error'] = $this->message->error("PREENCHA O BAIRRO PARA ENTREGA")->render();
                echo json_encode($json);
                return;
            }

            if (empty($municipio)) {
                $json['error'] = $this->message->error("PREENCHA A CIDADE PARA ENTREGA")->render();
                echo json_encode($json);
                return;
            }

            if (empty($forma_pagamento)) {
                $json['error'] = $this->message->error("SELECIONE UMA FORMA DE PAGAMENTO")->render();
                echo json_encode($json);
                return;
            }

            /* Selecionando o bairro corretamente */
            $bairro = retorna_bairro($bairro);


            /* Selecionando a empresa */
            $empresa = (new Empresas())->findByCode($code);

            $mensagem = "*NOVO PEDIDO* \n";
            $mensagem .= "Data de Envio: " . date_hour_fmt_br() . "\n";
            $mensagem .= "Cliente: {$nome}  \n\n";
            $mensagem .= "*ENDEREÇO PARA ENTREGA* \n";
            $mensagem .= "{$logradouro}, {$numero} {$complemento} \n";
            $mensagem .= "{$bairro} / {$municipio} \n\n";

            if (!empty($ponto_referencia)):
                $mensagem .= "*PONTO DE REFERÊNCIA* \n";
                $mensagem .= "{$ponto_referencia} \n\n";
            endif;

            /*
             * DESCOMENTE ESTA LINHA PARA GERAR LINK GOOGLE MAPS
            $mensagem .= "*GOOGLE MAPS* \n";
            $mensagem .= str_maps($logradouro."+".$numero."+".$bairro."+".$municipio);
            $mensagem .= "\n\n";
            */

            $mensagem .= "*DESCRIÇÃO DO PEDIDO* \n";
            if ($forma_envio == 'local'):
                $mensagem .= "Forma de Envio: *Retirar no local*\n\n";
            else:
                $mensagem .= "Forma de Envio: *Entrega*\n\n";
            endif;

            $mensagem .= "*PRODUTOS*\n";

            $session = new Session();
            $cart = $session->cart;

            if (empty($cart)){
                $json['error'] = $this->message->error("SEU CARRINHO ESTÁ VAZIO")->render();
                echo json_encode($json);
                return;
            }

            foreach ($cart as $item) {
                $mensagem .= "*{$item['nome']}* \n";
                $mensagem .= "Qtde: {$item['quantidade']} \n";
                $mensagem .= "Valor: {$item['quantidade']} x " . currency($item['valor']) . " = " . currency($item['quantidade'] * $item['valor']) . " \n";
                $mensagem .= "--- \n";

                if (!empty($item['opcionais'])):

                    $explode = explode("|", $item['opcionais']);
                    foreach ($explode as $opcao):

                        $mensagem .= "{$opcao} \n";

                    endforeach;

                endif;

                if (!empty($item['observacoes'])){
                    $mensagem .= "Obs: _{$item['observacoes']}_ \n\n";
                }
            }
            /* armazenando os itens na tabela de pedidos */
            $pedido_mensagem = null;
            foreach ($cart as $item) {
                $pedido_mensagem .= "<b>{$item['nome']}</b> <br>";
                $pedido_mensagem .= "Qtde: {$item['quantidade']} <br>";
                $pedido_mensagem .= "Valor: {$item['quantidade']} x " . currency($item['valor']) . " = " . currency($item['quantidade'] * $item['valor']) . " <br>";
                $pedido_mensagem .= "--- <br>";

                if (!empty($item['opcionais'])):

                    $explode = explode("|", $item['opcionais']);
                    foreach ($explode as $opcao):

                        $pedido_mensagem .= "{$opcao} <br>";

                    endforeach;

                endif;

                if (!empty($item['observacoes'])){
                    $pedido_mensagem .= "Obs: <i>{$item['observacoes']}</i> <br><br>";
                }
            }

            /* Total do pedido */
            $total_pedido = (new Carrinho())->getTotal();
            $taxa_entrega = taxa_entrega("{$empresa->id}", "{$bairro}", $total_pedido);

            $mensagem .= "*SUBTOTAL DO PEDIDO* \n";
            $mensagem .= currency($total_pedido) ." \n";

            if ($forma_envio == "local"){

                $mensagem .= "*TOTAL DO PEDIDO* \n";
                $mensagem .= currency($total_pedido) . "\n\n";

            } elseif ($forma_envio == "entrega"){

                $mensagem .= "*TAXA DE ENTREGA:* \n";
                $mensagem .= currency($taxa_entrega) ." \n\n";

                $mensagem .= "*TOTAL DO PEDIDO* \n";
                $mensagem .= currency($total_pedido + $taxa_entrega) . "\n\n";
            }


            $mensagem .= "*FORMA DE PAGAMENTO* \n";

            switch ($forma_pagamento){
                case 'dinheiro': $forma_text = "Dinheiro"; break;
                case 'debito': $forma_text = "Cartão de Débito"; break;
                case 'credito': $forma_text = "Cartão de Crédito"; break;
            }

            $mensagem .= "{$forma_text} \n\n";

            if (!empty($troco)){
                $mensagem .= "*LEVAR TROCO PARA* \n";
                $mensagem .= currency($troco) . "\n";
            }

            $mensagem .= "----------";

            $mensagem = urlencode($mensagem);

            /* Criando os cookies para a próxima compra */
            $duracao = 60 * 60 * 24 * 30; // 30 dias de cookie
            setcookie('cliente_nome', "{$nome}", (time() + $duracao));
            setcookie('cliente_whatsapp', "{$whatsapp}", (time() + $duracao));
            setcookie("cliente_cep", "{$cep}", (time() + $duracao));
            setcookie("cliente_logradouro","{$logradouro}",  (time() + $duracao));
            setcookie("cliente_numero", "{$numero}",  (time() + $duracao));
            setcookie("cliente_complemento", "{$complemento}",  (time() + $duracao));
            setcookie("cliente_bairro", "{$bairro}",  (time() + $duracao));
            setcookie("cliente_municipio", "{$municipio}",  (time() + $duracao));
            setcookie("cliente_ponto_referencia", "{$ponto_referencia}",  (time() + $duracao));
            setcookie("cliente_forma_pagamento", "{$forma_pagamento}",  (time() + $duracao));

            /* Salvando pedido no banco de dados */
            $pedido = (new Pedidos())->bootstrap(
                "{$empresa->id}",
                "{$forma_envio}",
                "{$nome}",
                "{$whatsapp}",
                "{$logradouro}",
                "{$numero}",
                "{$bairro}",
                "{$municipio}",
                "{$forma_pagamento}",
                "{$pedido_mensagem}",
                "{$total_pedido}"
            );

            if (!empty($troco)){
                $pedido->troco = $troco;
            }

            if (!empty($cep)){
                $pedido->cep = $cep;
            }

            if (!empty($complemento)){
                $pedido->complemento = $complemento;
            }

            if (!empty($ponto_referencia)){
                $pedido->ponto_referencia = $ponto_referencia;
            }

            if (!$pedido->save()){
                $json['error'] = $pedido->message()->render();
                echo json_encode($json);
                return;
            }

            /* montando a mensagem whatsapp */
            $json['redirect'] = "https://api.whatsapp.com/send?phone=55{$empresa->whatsapp_atendimento}&text={$mensagem}";
            echo json_encode($json);
            return;
        }
    }

    /**
     * @param array|null $data
     */
    public function cleanPedido(?array $data): void
    {
        $session = new Session();
        $session->unset("cart");
        $empresa= (new Empresas())->findByCode($data['code']);
        redirect("/{$empresa->slug}");
    }
}