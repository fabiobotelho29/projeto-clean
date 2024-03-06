<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 09/05/2019
 * Time: 19:24
 */

namespace Source\Models;


use Source\Core\Connect;
use Source\Core\Model;


/**
 * Class OrdersItems
 * @package Source\Models
 */
class OrdersItems extends Model
{
    /** @var array $safe no update or create */
    protected static $protected = ["id", "created_at", "updated_at"];

    /** @var string $entity database table */
    protected static $entity = "orders_items";

    /** @var */
    protected $message;

    /**
     * OrdersItems constructor.
     */
    public function __construct()
    {
        parent::__construct(self::$entity, self::$protected, self::$required);
    }


    public function bootstrap(
        int $order_id, int $product_id, string $name, string $sku, string $dimona_sku_id, float $price
    ): OrdersItems
    {
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->name = $name;
        $this->sku = $sku;
        $this->dimona_sku_id = $dimona_sku_id;
        $this->price = $price;
        return $this;
    }

    #############
    ### FINDS ###
    #############
    /**
     * @param string $id
     * @param string $columns
     * @return null|OrdersItems
     */
    public
    function findById(string $id, $columns = "*"): ?OrdersItems
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $code
     * @param string $columns
     * @return null|OrdersItems
     */
    public
    function findByCode(string $code, $columns = "*"): ?OrdersItems
    {
        $find = $this->find("code = :code", "code={$code}", $columns);
        return $find->fetch();
    }

    ########################
    ### PUBLIC FUNCTIONS ###
    ########################

    /**
     * @return bool
     */
    public function validate_register(): bool
    {

        if (empty($this->order_id)) {
            $this->message()->error("Selecione um pedido");
            return false;
        }

        if (empty($this->product_id)) {
            $this->message()->error("Preencha o campo ID do Produto");
            return false;
        }

        if (empty($this->name)) {
            $this->message()->error("Preencha o campo Nome do Produto");
            return false;
        }

        if (empty($this->sku)) {
            $this->message()->error("Preencha o campo SKU");
            return false;
        }

        if (empty($this->dimona_sku_id)) {
            $this->message()->error("Preencha o campo Dimona SKU ID");
            return false;
        }

        if (empty($this->price)) {
            $this->message()->error("Preencha o campo Preço do Produto");
            return false;
        }

        return true;
    }

    public function validate_update(): bool
    {

        if (empty($this->order_id)) {
            $this->message()->error("Selecione um pedido");
            return false;
        }

        if (empty($this->product_id)) {
            $this->message()->error("Preencha o campo ID do Produto");
            return false;
        }

        if (empty($this->name)) {
            $this->message()->error("Preencha o campo Nome do Produto");
            return false;
        }

        if (empty($this->sku)) {
            $this->message()->error("Preencha o campo SKU");
            return false;
        }

        if (empty($this->dimona_sku_id)) {
            $this->message()->error("Preencha o campo Dimona SKU ID");
            return false;
        }

        if (empty($this->price)) {
            $this->message()->error("Preencha o campo Preço do Produto");
            return false;
        }

        return true;
    }

    #####################
    ### RELATIONSHIPS ###
    #####################

    /* belongs to */
    public function order()
    {
        $find = Connect::getInstance()->query("
        select * from orders where id = {$this->order_id}
        ")->fetch();

        return $find;
    }

    /* onr */
    public function product()
    {
        $find = Connect::getInstance()->query("
        select * from products where id = {$this->product_id}
        ")->fetch();

        return $find;
    }


    ############
    ### SAVE ###
    ############


    /**
     * @return null|OrdersItems
     */
    public
    function save(): ?OrdersItems
    {

        if (empty($this->id)) {

            /* gerando código do registro */
            $this->code = generic_code();

            $this->json_data = json_encode($this->data);

            /* cadastra */
            $newRegister = $this->create($this->safe());
            if ($this->fail()) {
                $this->message()->error($this->fail());
                return null;
            }

            $this->data = $this->findById($newRegister);
            $this->message()->success('Cadastro efetuado com sucesso');
            return $this->data;

        } else {

            /* atualiza */
            $idRegister = $this->id;

            $upUser = $this->update($this->safe(), "id = :id", "id={$idRegister}");
            if ($this->fail()) {
                $this->message()->error("Erro ao atualizar.");
                return null;
            }

            $this->data = $this->findById($idRegister);
            $this->message()->success('Registro atualizado com sucesso');
            return $this->data;
        }

    }

    /**
     * @return bool
     */
    public
    function deleteRegister(): bool
    {
        if (!$this->id) {
            $this->message()->error("Envie a ID do registro que deseja que seja apagado.");
            return false;
        } else {
            $idRegister = $this->id;

            $deleted = $this->delete("id", $idRegister);
            if ($this->fail()) {
                $this->message()->error("Erro ao apagar o registro.");
                return false;
            }

            $this->message()->success("Registro apagado com sucesso.");
            return true;
        }
    }

}