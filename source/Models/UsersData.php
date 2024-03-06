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
 * Class UsersData
 * @package Source\Models
 */
class UsersData extends Model
{
    /** @var array $safe no update or create */
    protected static $protected = ["id", "created_at", "updated_at"];

    /** @var string $entity database table */
    protected static $entity = "users_data";

    /** @var */
    protected $message;

    /**
     * UsersData constructor.
     */
    public function __construct()
    {
        parent::__construct(self::$entity, self::$protected, self::$required);
    }

    public function bootstrap(
        int $user_id, string $document_type, string $document
    ): UsersData
    {
        $this->user_id = $user_id;
        $this->document_type = $document_type;
        $this->document = $document;

        return $this;
    }

    #############
    ### FINDS ###
    #############
    /**
     * @param string $id
     * @param string $columns
     * @return null|UsersData
     */
    public
    function findById(string $id, $columns = "*"): ?UsersData
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $code
     * @param string $columns
     * @return null|UsersData
     */
    public
    function findByCode(string $code, $columns = "*"): ?UsersData
    {
        $find = $this->find("code = :code", "code={$code}", $columns);
        return $find->fetch();
    }

    public function findByUser (int $id, $columns = "*"): ?UsersData
    {
        $find = $this->find("user_id = :u", "u={$id}", $columns);
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

        if (empty($this->document_type)) {
            $this->message()->error("Preencha o campo Tipo de Documento");
            return false;
        }

        if (empty($this->document)) {
            $this->message()->error("Preencha o campo Documento");
            return false;
        }

        $repeated = Connect::getInstance()->query("
        select * FROM users_data where user_id = {$this->user_id}
        ")->fetch();

        if ($repeated){
            $this->message()->error("Já existe documento cadastrado para este usuário");
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

        if (empty($this->document_type)) {
            $this->message()->error("Preencha o campo Tipo de Documento");
            return false;
        }

        if (empty($this->document)) {
            $this->message()->error("Preencha o campo Documento");
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
     * @return null|UsersData
     */
    public
    function save(): ?UsersData
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