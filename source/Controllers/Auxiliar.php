<?php
/**
 * CONTROLADOR AUXILIAR PARA RODAS AS ROTINAS AJAX
 */

namespace Source\Controllers;


use Psr\Log\NullLogger;
use Source\Core\Connect;
use Source\Core\Controller;
use Source\Core\Login;
use Source\Core\LoginEmpresa;
use Source\Core\Session;
use Source\Core\View;
use Source\Models\Categorias;
use Source\Models\Consultores;
use Source\Models\Empresas;
use Source\Models\Mensalidades;
use Source\Models\NivelAcesso;
use Source\Models\Opcionais;
use Source\Models\Opcoes;
use Source\Models\Pedidos;
use Source\Models\Produtos;
use Source\Models\StatusUsuario;
use Source\Models\TaxaEntrega;
use Source\Models\TiposVeiculos;
use Source\Models\Usuarios;
use Source\Support\SwiftMail;

/**
 * Class Auxiliar
 * @package Source\Controllers
 */
class Auxiliar extends Controller
{


    /**
     * Auxiliar constructor.
     */
    public function __construct()
    {
        $pathToViews = __DIR__ . "/../../themes/" . VIEWS_WEB_THEME . "/";

        parent::__construct($pathToViews);
    }

    /**
     * #############################
     * ###  CONSTRUÇÃO DAS ROTAS ###
     * #############################
     */

    public function changeStatus(?array $data): void
    {
        $empresa_code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);
        $empresa = (new Empresas())->findByCode($empresa_code);

        if (empty($empresa)) {
            $json['error'] = $this->message->error("EMPRESA NÃO ENCONTRADA")->render();
            echo json_encode($json);
            return;
        }

        /* alterando o valor do status */
        $empresa->situacao = "{$data['val']}";

        if (!$empresa->save()) {
            $json['error'] = $empresa->message()->render();
            echo json_encode($json);
            return;
        }

        return;
    }

    /**
     * @param array|null $data
     */
    public function loadEditCategory(?array $data): void
    {
        /* recebendo dados */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);

        /* selecionando a categoria */
        $categoria = (new Categorias())->findByCode($code);

        $response = "        
        <input type='hidden' name='code' value=\"{$categoria->code}\">
                    <div class=\"form-group\">
                        <label>NOME DA CATEGORIA</label>
                        <input type=\"text\" name=\"nome\" class=\"form-control\" value=\"{$categoria->nome}\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>DISPONÍVEL</label>
                        <select name='disponivel' id='' class='form-control'>
                        <option " . ($categoria->disponivel == 'sim' ? 'selected' : '') . "  value='sim'>SIM</option>
                        <option " . ($categoria->disponivel == 'nao' ? 'selected' : '') . " value='nao'>NÃO</option>
                        </select>
                    </div>
                    
        ";

        $json['assincronus'] = $response;
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function loadEditOptional(?array $data): void
    {
        /* recebendo dados */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);

        /* selecionando o opcional */
        $opcional = (new Opcionais())->findByCode($code);

        $empresa_id = $opcional->empresa()->id;

        $categorias = (new Categorias())->order("nome ASC")->find("empresa_id = :id", "id={$empresa_id}")->fetch(true);

        $response = "        
        <input type='hidden' name='code' value=\"{$opcional->code}\">
        
                    <div class=\"form-group\">
                        <label for=\"\">CATEGORIA</label>
                            <select name=\"cat_id\" id=\"\" class=\"form-control\">";
        if (!empty($categorias)):
            foreach ($categorias as $categoria):
                $response .= "<option " . ($categoria->id == $opcional->cat_id ? "selected" : "") . " value='" . $categoria->id . "'>{$categoria->nome}</option>";
            endforeach;
        endif;
        $response .= "</select>
                    </div>


                    <div class=\"form-group\">
                        <label for=\"\">NOME DA CATEGORIA OPCIONAL</label>
                        <input type=\"text\" name=\"categoria\" class=\"form-control\" value=\"{$opcional->categoria}\">
                    </div>

                    <div class=\"form-group\">
                            <label for=\"\">OBRIGATÓRIO</label>
                            <select name=\"obrigatorio\" id=\"\" class=\"form-control\">
                                <option value=\"\">SELECIONE</option>
                                <option " . ($opcional->obrigatorio == 'sim' ? 'selected' : '') . "  value='sim'>SIM</option>
                                <option " . ($opcional->obrigatorio == 'nao' ? 'selected' : '') . " value='nao'>NÃO</option>
                            </select>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"\">QUANT. PERMITIDA DE OPÇÕES</label>
                            <select name=\"qtde_permitida\" id=\"\" class=\"form-control\">";
        for ($a = 1; $a <= 10; $a++):
            $response .= "<option " . ($opcional->qtde_permitida == $a ? 'selected' : '') . " value=\"{$a}\">{$a}</option>";
        endfor;
        $response .= "</select>
                        </div>
                    
                        <div class=\"form-group\">
                            <label for=\"\">DISPONÍVEL</label>
                            <select name=\"disponivel\" id=\"\" class=\"form-control\">
                                <option value=\"\">SELECIONE</option>
                                <option " . ($opcional->disponivel == 'sim' ? 'selected' : '') . "  value='sim'>SIM</option>
                                <option " . ($opcional->disponivel == 'nao' ? 'selected' : '') . " value='nao'>NÃO</option>
                            </select>
                        </div>
                   
                    
        ";

        $response .= "
                                <script>
                                    $(\".maskMoney\").maskMoney({showSymbol: false, symbol: \"R$\", decimal: \".\", thousands: \"\"});
                                    
                                    $(\"#text_edit\").keyup(function () {

                                    var limite = 255;
                                    var caracteresDigitados = $(this).val().length;
                                    var caracteresRestantes = limite - caracteresDigitados;
                                    var conteudo = $(this).val()
                            
                                    if (caracteresDigitados >= limite) {
                                        conteudo = conteudo.substr(0, limite)
                                    }
                            
                                    $(this).val(conteudo)
                                    $(\"#cont_edit\").html(caracteresRestantes);
                            
                                });
                                </script>";

        $json['assincronus'] = $response;
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function loadEditDeliveryTax(?array $data): void
    {
        /* recebendo dados */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);

        /* selecionando a taxa */
        $taxa = (new TaxaEntrega())->findByCode($code);

        $response = "        
        <input type='hidden' name='code' value=\"{$taxa->code}\">
                    <div class=\"form-group\">
                        <label for=\"\">BAIRRO DE ATENDIMENTO</label>
                        <input value=\"{$taxa->bairro}\" type=\"text\" name=\"bairro\" class=\"form-control\" placeholder=\"Digite o bairro corretamente\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"\">TAXA DE ENTREGA</label>
                        <input value=\"{$taxa->taxa_entrega}\" type=\"text\" name=\"taxa_entrega\" class=\"form-control maskMoney\" placeholder=\"Digite a taxa de entrega\">
                    </div>                                   
                    
        ";

        $response .= "
         <script>
             $(\".maskMoney\").maskMoney({showSymbol: false, symbol: \"R$\", decimal: \".\", thousands: \"\"});
         </script>
         ";

        $json['assincronus'] = $response;
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function loadOptions(?array $data): void
    {
        /* recebendo dados */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);

        /* selecionando a categoria opcional */
        $categoria_opcional = (new Opcionais())->findByCode($code);

        $empresa_id = $categoria_opcional->empresa_id;

        $response = "        
        <input type='hidden' name='categoria_id' value=\"{$categoria_opcional->id}\">
        <input type='hidden' name='slug_categoria' value=\"{$categoria_opcional->slug_categoria}\">
        <input type='hidden' name='empresa_id' value=\"{$empresa_id}\">
                    <div class=\"form-group\">
                        <label for=\"\">" . mb_strtoupper($categoria_opcional->categoria) . "</label>
                        <input id='selected' onfocus='javascript:this.select()' placeholder='Digite o nome da opção' type=\"text\" name=\"opcional\" class=\"form-control\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"\">VALOR <small>Caso seja gratuito basta não preencher este campo</small></label>
                        <input onfocus='javascript:this.select()' placeholder='Digite o valor' type=\"text\" name=\"valor\" class=\"form-control maskMoney\">
                    </div>
                    <button class=\"btn btn-primary\"> SALVAR</button>
        ";

        $response .= "<br><br>";

        /* listando as opções já cadastradas */
        $opcoes_cadastradas = (new Opcionais())->findByCategoriaId($categoria_opcional->id);

        $response_options = null;
        if (!empty($opcoes_cadastradas)) {
            foreach ($opcoes_cadastradas as $opcao) {
                $icon = icon("times");

                /* carregando a opção disponivel */
                if ($opcao->disponivel == "sim") {
                    $disponivel = "primary";
                    $text = "DISPONÍVEL";
                } else {
                    $disponivel = "danger";
                    $text = "NÃO DISPONÍVEL";
                }

                $response_options .= "<div class='option_item row'>

                                        <div class='col-sm-4'>
                                            <input 
                                            class='form-control'
                                            data-alledit
                                            data-entity='".crypt_entity("opcionais")."'
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
                                            data-entity='".crypt_entity("opcionais")."'
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

        $json['assincronus'] = $response;
        $json['assincronus_options'] = $response_options;
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function changeDispOption(?array $data): void
    {
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);

        $opcao = (new Opcoes())->findByCode($code);

        if (empty($opcao)) {
            $json['error'] = $this->message->error("OPÇÃO NÂO ENCONTRADA")->render();
            echo json_encode($json);
            return;
        }

        $valor = filter_var($data['value'], FILTER_SANITIZE_STRIPPED);

        if ($valor == "sim") {
            $opcao->disponivel = "sim";
        } else {
            $opcao->disponivel = "nao";
        }

        if (!$opcao->save()) {
            $json['error'] = $opcao->message()->render();
            echo json_encode($json);
            return;
        }

        return;
    }

    /**
     * @param array|null $data
     */
    public function delOption(? array $data): void
    {
        /* recebendo dados */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);

        /* opção a ser apagada */
        $opcao = (new Opcoes())->findByCode($code);
        $categoria_id = $opcao->categoria_id;

        if (!$opcao->deleteRegister()) {
            $json['error'] = $opcao->message()->render();
            echo json_encode($json);
            return;
        }

        /* listando as opções já cadastradas */
        $opcoes_cadastradas = (new Opcionais())->findByCategoriaId($categoria_id);

        $response = null;

        if (!empty($opcoes_cadastradas)) {
            foreach ($opcoes_cadastradas as $opcao) {
                $icon = icon("times");
                $response .= "<div class='option_item row'>

                                        <div class='col-sm-4'>
                                            <input 
                                            class='form-control'
                                            data-alledit
                                            data-entity='".crypt_entity("opcionais")."'
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
                                            data-entity='".crypt_entity("opcionais")."'
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

        $response .= "
        <script>
        
        $(\".maskMoney\").maskMoney({showSymbol: false, symbol: \"R$\", decimal: \".\", thousands: \"\"});
        
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

        $json['assincronus_options'] = $response;
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function loadEditProduct(?array $data): void
    {
        /* recebendo dados */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);

        /* selecionando o produto */
        $produto = (new Produtos())->findByCode($code);

        $empresa_id = $produto->empresa()->id;
        $categoria_id = $produto->categoria_id;

        /* selecionando as categorias */
        $categorias = (new Categorias())->order("nome ASC")->find("empresa_id = :id", "id={$empresa_id}")->fetch(true);

        /* selecionando os opcionais */
        $opcionais = (new Opcionais())
            ->order("categoria")
            ->find("cat_id = :cat_id AND empresa_id = :id AND categoria IS NOT NULL",
                "cat_id={$categoria_id}&id={$empresa_id}")->fetch(true);

        $response = "        
        <img style=\"width: 100px ;\" src='" . url("/images/produtos/{$produto->imagem}") . "' alt=\"\">
        <hr>
        <input type='hidden' name='code' value=\"{$produto->code}\">
        
        
                    <div class=\"form-group\">
                        <label for=\"\">CATEGORIA</label>
                        <select name=\"categoria_id\" class=\"form-control\"
                        data-findcategory=\"true\"
                        data-url='" . url("/findCategoy") . "'>
                            <option value=\"\">SELECIONE</option>";

        if (!empty($categorias)):
            foreach ($categorias as $categoria):
                $response .= "<option " . ($categoria->id == $produto->categoria_id ? "selected" : "") . " value='" . $categoria->id . "'>" . $categoria->nome . "</option>";
            endforeach;
        endif;

        $response .= "
                        </select>
                    </div>
        
                    <div class=\"form-group\">
                        <label>NOME DO PRODUTO</label>
                        <input type=\"text\" name=\"nome\" class=\"form-control\" value=\"{$produto->nome}\">
                    </div>
                    
                    <div class=\"form-group\">
                            <label for=\"\">OPCIONAIS <small>Para mais de 1, use a tecla Ctrl</small></label>
                            <select class=\"form-control loadResponseOptions\" multiple name=\"opcionais[]\">";


        if (!empty($opcionais)) {
            foreach ($opcionais as $opcional) {

                /* verificando se nos opcionais tem "," */
                $mystring = $produto->opcionais;
                $findme = ',';
                $pos = strpos($mystring, $findme);

                if ($pos === false) {
                    /* Não tem "," */
                    $response .= "<option " . ($opcional->id == $produto->opcionais ? "selected" : "") . " value=\"{$opcional->id}\">{$opcional->categoria}</option>";

                } else {
                    /* Tem "," */
                    /* quebrando os opcionais do produto em array */
                    $array_options = explode(",", $produto->opcionais);

                    $response .= "<option " . (in_array($opcional->id, $array_options) ? "selected" : "") . " value=\"{$opcional->id}\">{$opcional->categoria}</option>";

                }

            }
        }

        $response .= "</select>
                        </div>
                    
                    <div class=\"form-group\">
                        <label for=\"\">DESCRIÇÃO</label>
                        <textarea placeholder=\"Ex.: Dois pães de hamburguer + presunto + queijo etc..\" name=\"descricao\" id=\"text_edit\" rows=\"5\" class=\"form-control\">{$produto->descricao}</textarea>
                        Caracteres restantes: <span id=\"cont_edit\">300</span>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"\">VALOR</label>
                        <input type=\"text\" name=\"valor\" class=\"form-control maskMoney\" value=\"{$produto->valor}\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>DISPONÍVEL</label>
                        <select name='disponivel' id='' class='form-control'>
                        <option " . ($produto->disponivel == 'sim' ? 'selected' : '') . "  value='sim'>SIM</option>
                        <option " . ($produto->disponivel == 'nao' ? 'selected' : '') . " value='nao'>NÃO</option>
                        </select>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"\">IMAGEM <small>Só selecione caso queira alterar a imagem do produto</small></label>
                        <input type=\"file\" name=\"imagem\" class=\"form-control\">
                    </div>
                    
        ";

        $response .= "
                    
                                <script>
                                    $(\".maskMoney\").maskMoney({showSymbol: false, symbol: \"R$\", decimal: \".\", thousands: \"\"});
                                    
                                    $(\"#text_edit\").keyup(function () {

                                    var limite = 255;
                                    var caracteresDigitados = $(this).val().length;
                                    var caracteresRestantes = limite - caracteresDigitados;
                                    var conteudo = $(this).val()
                            
                                    if (caracteresDigitados >= limite) {
                                        conteudo = conteudo.substr(0, limite)
                                    }
                            
                                    $(this).val(conteudo)
                                    $(\"#cont_edit\").html(caracteresRestantes);
                            
                                });
                                    
                                    $(\"[data-findcategory]\").change(function (e) {
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
                                            
                                            if (response.assincronus) {
                                                $(\".loadResponseOptions\").html(response.assincronus);
                                            }
                                        }, \"json\");
                                    })
                                </script>";

        $json['assincronus'] = $response;
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function findCategoy(?array $data): void
    {
        /* recebendo dados do formulário */
        $cat_id = filter_var($data['value'], FILTER_VALIDATE_INT);

        $opcionais = (new Opcionais())->find("cat_id = :id", "id={$cat_id}")->fetch(true);

        if (!empty($opcionais)) {
            $json['assincronus'] = null;
            foreach ($opcionais as $opcional) {
                $json['assincronus'] .= "<option value=\"{$opcional->id}\">{$opcional->categoria}</option>";
            }
        }

        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function allEdit(?array $data): void
    {
        /* dados */
        $entity = filter_input(INPUT_POST, 'entity', FILTER_SANITIZE_STRIPPED);
        $field = filter_input(INPUT_POST, 'field', FILTER_SANITIZE_STRIPPED);
        $value = filter_input(INPUT_POST, 'value', FILTER_SANITIZE_STRIPPED);
        $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRIPPED);

        $entity = decrypy_enity($entity);

        if (empty($value)) {
            $value = 0.00;
        }

        $sql = Connect::getInstance()->query(
            "UPDATE {$entity} set {$field}=\"{$value}\" WHERE code = \"{$code}\""
        );
    }

    /**
     * @param array|null $data
     */
    public function internalCompanyAccess(?array $data): void
    {
        /* selecionando a empresa */
        $empresa = (new Empresas())->findByCode($data['code']);

        /* Gerando o user para acessar a empresa */
        $session = new Session();
        $session->set("user_empresa", "{$empresa->email}");

        redirect("/{$empresa->slug}/panel/dashboard");
    }

    /**
     * @param array|null $data
     */
    public function internalConsultorAccess(?array $data): void
    {
        /* selecionando o consultor */
        $consultor = (new Consultores())->findByCode($data['code']);

        /* Gerando o user para acessar a empresa */
        $session = new Session();
        $session->set("user_consultor", "{$consultor->code}");

        redirect("/consultor/dashboard");
    }

    /**
     * @param array|null $data
     */
    public function changeStatusPedidos(?array $data): void
    {
        /* recebendo os dados */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);
        $value = filter_var($data['value'], FILTER_SANITIZE_STRIPPED);


        $pedido = (new Pedidos())->findByCode($code);
        $empresa = Connect::getInstance()->query(
            "SELECT * FROM empresas WHERE id = {$pedido->empresa_id}"
        )->fetch();


        if (empty($pedido)) {
            $json['error'] = $this->message->error("Pedido não encontrado")->render();
            echo json_encode($json);
            return;
        }

        /* campo de edição */
        $pedido->status = $value;

        if (!$pedido->save()) {
            $json['error'] = $pedido->message()->render();
            echo json_encode($json);
            return;
        }


        /* abrindo a tela de notificação */
        if ($value == "confirmado") {
            $mensagem = ">> *PEDIDO CONFIRMADO* \n\n";

            $mensagem .= "{$pedido->nome}, \n";
            $mensagem .= "{$empresa->msg_confirmacao}";

            $mensagem = urlencode($mensagem);
            $whatsapp = str_whatsapp($pedido->whatsapp);

            $json['echo'] = "
            <script>
                openedWindow = window.open(\"https://modules.whatsapp.com/send?phone=55{$whatsapp}&text={$mensagem}\", \"Whatsapp\", \"width=10,height=10\");
                
                setTimeout(function(){ openedWindow.close(); }, 3000);                
                
            </script>
            ";

            echo json_encode($json);
            return;
        }

        if ($value == "delivery") {
            $mensagem = ">>  *PEDIDO ENVIADO PARA ENTREGA* \n\n";

            $mensagem .= "{$pedido->nome},  \n";
            $mensagem .= "{$empresa->msg_entrega}";

            $mensagem = urlencode($mensagem);
            $whatsapp = str_whatsapp($pedido->whatsapp);

            $json['echo'] = "
            <script>
                openedWindow = window.open(modules{$wmodulessapp}{$mensagem}, \"Whatsapp\", \"width=10,height=10\");
                setTimeout(function(){ openedWindow.close(); }, 3000); 
            </script>
            ";

            echo json_encode($json);
            return;
        }

    }

    /**
     * @param array|null $data
     */
    public function viewPedido(?array $data): void
    {
        /* recebendo os dados */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);

        $pedido = (new Pedidos())->findByCode($code);

        if (empty($pedido)) {
            $json['error'] = $this->message->error("Pedido não encontrado")->render();
            echo json_encode($json);
            return;
        }

        $mensagem = "<strong>[ {$pedido->n_ordem} ] RESUMO DO PEDIDO </strong><br>";
        $mensagem .= "Data de Envio: " . date_hour_fmt_br() . "<br>";
        $mensagem .= "Cliente: {$pedido->nome} <br> Telefone: {$pedido->whatsapp}<br><br>";
        $mensagem .= "<b>ENDEREÇO PARA ENTREGA</b> <br>";
        $mensagem .= "{$pedido->logradouro}, {$pedido->numero} {$pedido->complemento} <br>";
        $mensagem .= "{$pedido->bairro} / {$pedido->municipio} <br>";

        if (!empty($ponto_referencia)):
            $mensagem .= "<br><b>PONTO DE REFERÊNCIA</b> <br>";
            $mensagem .= "{$ponto_referencia} <br>";
        endif;

        /*
         * DESCOMENTE ESTA LINHA PARA GERAR LINK GOOGLE MAPS
        $mensagem .= "<a class='btn btn-sm btn-primary' href= '" . str_maps($pedido->logradouro . "+" . $pedido->numero . "+" . $pedido->bairro . "+" . $pedido->municipio) . "' 
        target='_blank'>" . icon("map-marker") . " GOOGLE MAPS</a>";
        $mensagem .= "<br><br>";
        */


        $mensagem .= "<b>DESCRIÇÃO DO PEDIDO</b> <br>";
        if ($pedido->entrega == 'local'):
            $mensagem .= "Forma de Envio: <b>Retirar no local</b><br><br>";
        else:
            $mensagem .= "Forma de Envio: <b>Entrega</b><br><br>";
        endif;

        $mensagem .= "<b>PRODUTOS</b><br>";

        $mensagem .= $pedido->mensagem;

        $mensagem .= "<b>TOTAL DO PEDIDO</b> <br>";
        $mensagem .= currency($pedido->total) . " <br><br>";

        $mensagem .= "<b>FORMA DE PAGAMENTO</b> <br>";

        switch ($pedido->forma_pagamento) {
            case 'dinheiro':
                $forma_text = "Dinheiro";
                break;
            case 'debito':
                $forma_text = "Cartão de Débito";
                break;
            case 'credito':
                $forma_text = "Cartão de Crédito";
                break;
        }

        $mensagem .= "{$forma_text}";

        if (!empty($pedido->troco)) {

            $mensagem .= " (Troco para: " . currency($pedido->troco) . ")<br>";
        }

        $json['assincronus_pedidos'] = $mensagem;
        echo json_encode($json);
        return;

    }

    /**
     * @param array|null $data
     */
    public function notifyPedido(?array $data): void
    {
        /* recebendo os dados */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);

        $pedido = (new Pedidos())->findByCode($code);

        if (empty($pedido)) {
            $json['error'] = $this->message->error("Pedido não encontrado")->render();
            echo json_encode($json);
            return;
        }

        /* montando a mensagem whatsapp */
        $whatsapp = str_whatsapp($pedido->whatsapp);

        $mensagem = "";

        $json['echo'] = "
        <script>
            openedWindow = window.open(\"https://api.whatsapp.com/send?phone=55{$whatsapp}modulesxt={$mensagem}\", \"Whatsapp\", \"width=10,height=10\");
            setTimeout(function(){ openedWindow.close(); }, 3000); 
        </script>
        ";

        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function printPedido(?array $data): void
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
            window.open('" . url("/print_pedido/{$pedido->code}") . "', \"Pedido\", \"width=350,height=500\");
        </script>
        ";
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function loadNewPedidos(?array $data): void
    {
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);
        $empresa = (new Empresas())->findByCode($code);
        $pedidos = (new Pedidos())->find(
            "empresa_id = :id AND status = :s",
            "id={$empresa->id}&s=novo")->count();

        if (!empty($pedidos)) {
            $audio = url("/old-ring.mp3");
            $json['assincronus_new'] = "<div class='alert alert-danger'>" . icon("exclamation-triangle") . " EXISTE(M) <b> {$pedidos} </b> PEDIDO(S) NOVO(S) 
            <a class='btn btn-sm btn-danger' href='" . url("/{$empresa->code}/panel/pedidos") . "'>" . icon("refresh") . "</a>
            <audio autoplay>
              <source src='".$audio."' type='audio/mpeg'>
            </audio>
            </div>";
            echo json_encode($json);
            return;
        }

        $json['assincronus_new'] = "<div class='alert alert-info'>" . icon("check") . " VOCÊ NÃO TEM NOVOS PEDIDOS!</div>";
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function loadVideos(?array $data): void
    {
        $video = filter_var($data['video'], FILTER_SANITIZE_STRIPPED);

        $embed = "
        <div class='embed-container'>
        <iframe width=\"560\" 
                height=\"315\" 
                src=\"https://www.youtube.com/embed/{$video}\" 
                frameborder=\"0\" 
                allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" 
                allowfullscreen>
         </iframe>
         </div>
        ";

        $json['assincronus_video'] = "{$embed}";
        echo json_encode($json);
        return;
    }

    /**
     * @param array|null $data
     */
    public function loadTaxaEntrega(? array $data): void
    {
        /* Recebendo os dados do elemento */
        $code = filter_var($data['code'], FILTER_SANITIZE_STRIPPED);
        $valor_pedido = filter_var($data['valorPedido'], FILTER_VALIDATE_FLOAT);

        /* Consultando a empresa */
        $empresa = (new Empresas())->findByCode($code);

        /* PEgando o ID da empresa */
        $empresa_id = $empresa->id;

        /* Recebendo  bairro */
        $bairro = filter_var($data['bairro'], FILTER_SANITIZE_STRIPPED);

        /* Retornando a taxa de entrega */
        $return_taxa = taxa_entrega($empresa_id, $bairro, $valor_pedido);

        $json['assincronus'] = currency($return_taxa);
        echo json_encode($json);
        return;

    }

}