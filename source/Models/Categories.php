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
 * Class Categories
 * @package Source\Models
 */
class Categories extends Model
{
    /** @var array $safe no update or create */
    protected static $protected = ["id", "created_at", "updated_at"];

    /** @var string $entity database table */
    protected static $entity = "categories";

    /** @var */
    protected $message;

    /**
     * Categories constructor.
     */
    public function __construct()
    {
        parent::__construct(self::$entity, self::$protected, self::$required);
    }


    /**
     * @param int $empresa_id
     * @param string $nome
     * @return Categories
     */
    public function bootstrap(
        string $name
    ): Categories
    {
        $this->name = $name;
        return $this;
    }

    #############
    ### FINDS ###
    #############
    /**
     * @param string $id
     * @param string $columns
     * @return null|Categories
     */
    public
    function findById(string $id, $columns = "*"): ?Categories
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $code
     * @param string $columns
     * @return null|Categories
     */
    public
    function findByCode(string $code, $columns = "*"): ?Categories
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
        if (empty($this->name)) {
            $this->message()->error("Preencha o campo Nome");
            return false;
        }

        return true;
    }

    public function validate_update(): bool
    {
        if (empty($this->name)) {
            $this->message()->error("Preencha o campo Name");
            return false;
        }

        return true;
    }

    #####################
    ### RELATIONSHIPS ###
    #####################


    ############
    ### SAVE ###
    ############


    /**
     * @return null|Categories
     */
    public
    function save(): ?Categories
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