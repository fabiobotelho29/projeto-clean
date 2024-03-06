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
 * Class Orders
 * @package Source\Models
 */
class Orders extends Model
{
    /** @var array $safe no update or create */
    protected static $protected = ["id", "created_at", "updated_at"];

    /** @var string $entity database table */
    protected static $entity = "orders";

    /** @var */
    protected $message;

    /**
     * Orders constructor.
     */
    public function __construct()
    {
        parent::__construct(self::$entity, self::$protected, self::$required);
    }


    public function bootstrap(
        int $user_id, string $customer_name, string $shipping_speed, int $order_id, string $dimona_id, int $address_id, string $status = ''
    ): Orders
    {
        $this->user_id = $user_id;
        $this->customer_name = $customer_name;
        $this->shipping_speed = $shipping_speed;
        $this->order_id = $order_id;
        $this->dimona_id = $dimona_id;
        $this->address_id = $address_id;
        $this->status = $status;
        return $this;
    }

    #############
    ### FINDS ###
    #############
    /**
     * @param string $id
     * @param string $columns
     * @return null|Orders
     */
    public
    function findById(string $id, $columns = "*"): ?Orders
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $code
     * @param string $columns
     * @return null|Orders
     */
    public
    function findByCode(string $code, $columns = "*"): ?Orders
    {
        $find = $this->find("code = :code", "code={$code}", $columns);
        return $find->fetch();
    }

    public
    function findByDimonaId(string $dimona_id, $columns = "*"): ?Orders
    {
        $find = $this->find("dimona_id = :d", "d={$dimona_id}", $columns);
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

        if (empty($this->user_id)) {
            $this->message()->error("Selecione uma usuário");
            return false;
        }

        if (empty($this->customer_name)) {
            $this->message()->error("Preencha o campo Nome do Usuário/Cliente");
            return false;
        }

        if (empty($this->shipping_speed)) {
            $this->message()->error("Preencha o campo Tipo de Frete");
            return false;
        }

        if (empty($this->order_id)) {
            $this->message()->error("Preencha o campo Order ID vindo da Dimona");
            return false;
        }

        if (empty($this->dimona_id)) {
            $this->message()->error("Precisa receber o ID da Dimona");
            return false;
        }

        if (empty($this->address_id)) {
            $this->message()->error("Preencha o campo Endereço de Entrega");
            return false;
        }

        return true;
    }

    public function validate_update(): bool
    {
        if (empty($this->user_id)) {
            $this->message()->error("Selecione uma usuário");
            return false;
        }

        if (empty($this->customer_name)) {
            $this->message()->error("Preencha o campo Nome do Usuário/Cliente");
            return false;
        }

        if (empty($this->shipping_speed)) {
            $this->message()->error("Preencha o campo Tipo de Frete");
            return false;
        }

        if (empty($this->order_id)) {
            $this->message()->error("Preencha o campo Order ID vindo da Dimona");
            return false;
        }

        if (empty($this->dimona_id)) {
            $this->message()->error("Precisa receber o ID da Dimona");
            return false;
        }

        if (empty($this->address_id)) {
            $this->message()->error("Preencha o campo Endereço de Entrega");
            return false;
        }

        return true;
    }

    #####################
    ### RELATIONSHIPS ###
    #####################

    /* belongs to */
    public function user()
    {
        $find = Connect::getInstance()->query("
        select * from users where id = {$this->user_id}
        ")->fetch();

        return $find;
    }


    ############
    ### SAVE ###
    ############


    /**
     * @return null|Orders
     */
    public
    function save(): ?Orders
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