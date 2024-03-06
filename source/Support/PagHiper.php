<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 09/05/2019
 * Time: 11:30
 */

namespace Source\Support;

use Source\Core\Model;


/**
 * Class PagHiper
 * @package Source\Support
 */
class PagHiper
{

    /** @var */
    public $transaction_id;
    /** @var */
    public $order_id;
    /** @var */
    public $url;

    /**
     * @param string $order_id
     * @param string $payer_email
     * @param string $razao_social
     * @param string $cnpj
     * @param string $payer_phone
     * @param string $payer_street
     * @param string $payer_number
     * @param null|string $payer_complement
     * @param string $payer_district
     * @param string $payer_city
     * @param string $payer_state
     * @param string $payer_zip_code
     * @param string $days_due_date
     * @param float $mensalidade
     * @param string $descricao
     * @param int $quantidade
     * @param int $item_id
     * @return PagHiper
     */
    public function bootstrap(
        string $order_id,
        string $payer_email,
        string $razao_social,
        string $cnpj,
        string $payer_phone,
        string $payer_street,
        string $payer_number,
        ?string $payer_complement,
        string $payer_district,
        string $payer_city,
        string $payer_state,
        string $payer_zip_code,
        string $days_due_date,
        float $mensalidade,
        string $descricao,
        int $quantidade = 1,
        int $item_id = 1
    ): PagHiper
    {
        $this->order_id = $order_id;
        $this->payer_email = $payer_email;
        $this->razao_social = $razao_social;
        $this->cnpj = $cnpj;
        $this->payer_phone = $payer_phone;
        $this->payer_street = $payer_street;
        $this->payer_number = $payer_number;
        $this->payer_complement = $payer_complement;
        $this->payer_district = $payer_district;
        $this->payer_city = $payer_city;
        $this->payer_state = $payer_state;
        $this->payer_zip_code = $payer_zip_code;
        $this->days_due_date = $days_due_date;
        $this->mensalidade = $mensalidade;
        $this->descricao = $descricao;
        $this->quantidade = $quantidade;
        $this->item_id = $item_id;

        return $this;
    }

    /**
     * @return bool
     */
    public function gera_boleto(): bool
    {
        $data = array(
            'apiKey' => PAG_HIPER_API_KEY,
            'order_id' => $this->order_id, // código interno do lojista para identificar a transacao.
            'payer_email' => $this->payer_email,
            'payer_name' => $this->razao_social, // nome completo ou razao social
            'payer_cpf_cnpj' => $this->cnpj, // cpf ou cnpj
            'payer_phone' => $this->payer_phone, // fixou ou móvel
            'payer_street' => $this->payer_street, // logradouro
            'payer_number' => $this->payer_number, // numero
            'payer_complement' => $this->payer_complement, // complemento
            'payer_district' => $this->payer_district, // bairro
            'payer_city' => $this->payer_city, // cidade
            'payer_state' => $this->payer_state, // apenas sigla do estado
            'payer_zip_code' => $this->payer_zip_code, //CEP
            'notification_url' => '',
            'discount_cents' => '0', // em centavos
            'shipping_price_cents' => '0', // valor do frete em centavos
            'shipping_methods' => SEO_SITE_NAME, // Método de entrega (SEDEX, SEDEX10, PAC, TRANSPORTADORA, MOTOBOY, RETIRADA NO LOCAL)
            'fixed_description' => true, // Frase pré-configurada no painel do PagHiper
            'type_bank_slip' => 'boletoA4', // formato do boleto
            'days_due_date' => $this->days_due_date, // dias para vencimento do boleto
            'late_payment_fine' => '2',// Percentual de multa após vencimento.
            'per_day_interest' => true, // Juros após vencimento.
            'items' => array(
                array('description' => $this->descricao,
                    'quantity' => $this->quantidade,
                    'item_id' => $this->item_id,
                    'price_cents' => $this->mensalidade), // em centavos
            ),
        );



        $data_post = json_encode($data);
        $url = "https://modules.paghiper.com/transaction/create/";
        $mediaType = "application/json"; // formato da requisição
        $charSet = "UTF-8";
        $headers = array();
        $headers[] = "Accept: " . $mediaType;
        $headers[] = "Accept-Charset: " . $charSet;
        $headers[] = "Accept-Encoding: " . $mediaType;
        $headers[] = "Content-Type: " . $mediaType . ";charset=" . $charSet;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $json = json_decode($result, true);

        // captura o http code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


        if ($httpCode == 201):
            // CÓDIGO 201 SIGNIFICA QUE O BOLETO FOI GERADO COM SUCESSO
            $this->result = $result;

            $this->order_id = $json['create_request']['order_id'];
            $this->transaction_id = $json['create_request']['transaction_id'];
            $this->url = $json['create_request']['bank_slip']['url_slip'];


            // Exemplo de como capturar a resposta json
//            $transaction_id = $json['create_request']['transaction_id'];
//            $url_slip = $json['create_request']['bank_slip']['url_slip'];
//            $digitable_line = $json['create_request']['bank_slip']['digitable_line'];

            /*
             * {
             *      "create_request":
             *          {
             *              "result":"success",
             *              "response_message":"transacao criada",
             *              "transaction_id":"4XM8F9ROK3C214GK",
             *              "created_date":"2020-07-17 01:39:29",
             *              "value_cents":"103900",
             *              "status":"pending",
             *              "order_id":"655356",
             *              "due_date":"2020-07-22",
             *              "bank_slip":
             *                  {
             *                      "digitable_line":"23793.39126 60004.332767 48000.685700 8 83240000103900",
             *                      "url_slip":"https://www.paghiper.com/checkout/boleto/76f19df4f9585f09ecff1a1cf48a164dedfcae7dd87d593930aa662288317cc95e3b7f8d859302ae29fa249b650dc91e5047981cc80738250eff9fe280e60d06/4XM8F9ROK3C214GK/43327648",
             *                      "url_slip_pdf":"https://www.paghiper.com/checkout/boleto/76f19df4f9585f09ecff1a1cf48a164dedfcae7dd87d593930aa662288317cc95e3b7f8d859302ae29fa249b650dc91e5047981cc80738250eff9fe280e60d06/4XM8F9ROK3C214GK/43327648/pdf",
             *                      "bar_code_number_to_image":"23798832400001039003391260004332764800068570"
             *                  },
             *              "http_code":201,
             *              "http_cod":201
             *           }
             * }
             */

            return true;
        else:
            $this->result = $result;
            return false;

        endif;
    }
}