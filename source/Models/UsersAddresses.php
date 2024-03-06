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
 * Class UsersAddresses
 * @package Source\Models
 */
class UsersAddresses extends Model
{
    /** @var array $safe no update or create */
    protected static $protected = ["id", "created_at", "updated_at"];

    /** @var string $entity database table */
    protected static $entity = "users_addresses";

    /** @var */
    protected $message;

    /**
     * UsersAddresses constructor.
     */
    public function __construct()
    {
        parent::__construct(self::$entity, self::$protected, self::$required);
    }


    /**
     * @param int $empresa_id
     * @param string $nome
     * @return UsersAddresses
     */
    public function bootstrap(
        int $user_id, string $zipcode, string $street, string $number, string $city, string $state, string $neighborhood, string $complement = ''

    ): UsersAddresses
    {
        $this->user_id = $user_id;
        $this->zipcode = $zipcode;
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->state = $state;

        return $this;
    }

    #############
    ### FINDS ###
    #############
    /**
     * @param string $id
     * @param string $columns
     * @return null|UsersAddresses
     */
    public
    function findById(string $id, $columns = "*"): ?UsersAddresses
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $code
     * @param string $columns
     * @return null|UsersAddresses
     */
    public
    function findByCode(string $code, $columns = "*"): ?UsersAddresses
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
        if (empty($this->user_id)) {
            $this->message()->error("Selecione um usuário");
            return false;
        }

        if (empty($this->zipcode)) {
            $this->message()->error("Preencha o campo CEP");
            return false;
        }

        if (empty($this->street)) {
            $this->message()->error("Preencha o campo Rua");
            return false;
        }

        if (empty($this->number)) {
            $this->message()->error("Preencha o campo Número");
            return false;
        }

        if (empty($this->neighborhood)) {
            $this->message()->error("Preencha o campo Bairro");
            return false;
        }

        if (empty($this->city)) {
            $this->message()->error("Preencha o campo Cidade");
            return false;
        }

        if (empty($this->state)) {
            $this->message()->error("Preencha o campo Estado");
            return false;
        }

        return true;
    }

    public function validate_update(): bool
    {
        if (empty($this->user_id)) {
            $this->message()->error("Selecione um usuário");
            return false;
        }

        if (empty($this->zipcode)) {
            $this->message()->error("Preencha o campo CEP");
            return false;
        }

        if (empty($this->street)) {
            $this->message()->error("Preencha o campo Rua");
            return false;
        }

        if (empty($this->number)) {
            $this->message()->error("Preencha o campo Número");
            return false;
        }

        if (empty($this->neighborhood)) {
            $this->message()->error("Preencha o campo Bairro");
            return false;
        }

        if (empty($this->city)) {
            $this->message()->error("Preencha o campo Cidade");
            return false;
        }

        if (empty($this->state)) {
            $this->message()->error("Preencha o campo Estado");
            return false;
        }

        if ($this->status == 1) {

            // zerando todos os outros status
            $update = Connect::getInstance()->query("
            UPDATE users_addresses set status = 0 where user_id = {$this->user_id} AND id <> {$this->id}"
            )->fetch();
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
     * @return null|UsersAddresses
     */
    public
    function save(): ?UsersAddresses
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