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
 * Class Users
 * @package Source\Models
 */
class Users extends Model
{
    /** @var array $safe no update or create */
    protected static $protected = ["id", "created_at", "updated_at"];

    /** @var string $entity database table */
    protected static $entity = "users";

    /** @var */
    protected $message;

    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct(self::$entity, self::$protected, self::$required);
    }


    /**
     * @param int $empresa_id
     * @param string $nome
     * @return Users
     */
    public function bootstrap(
        string $name, string $email, string $password

    ): Users
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

        return $this;
    }

    #############
    ### FINDS ###
    #############
    /**
     * @param string $id
     * @param string $columns
     * @return null|Users
     */
    public
    function findById(string $id, $columns = "*"): ?Users
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $code
     * @param string $columns
     * @return null|Users
     */
    public
    function findByCode(string $code, $columns = "*"): ?Users
    {
        $find = $this->find("code = :code", "code={$code}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $email
     * @param string $columns
     * @return null|Users
     */
    public function findByEmail(string $email, $columns = "*"): ?Users
    {
        $find = $this->find("email = :e", "e={$email}", $columns);
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

        if (empty($this->email)) {
            $this->message()->error("Preencha o campo Email");
            return false;
        }

        if (!is_email($this->email)){

            $this->message()->error("Utilize um e-mail válido");
            return false;
        }

        if (empty($this->password)) {
            $this->message()->error("Preencha o campo Senha");
            return false;
        }

        if (!is_passwd($this->password)){

            $this->message()->error("A senha precisa ter entre " .CONF_PASSWD_MIN_LEN. " e " .CONF_PASSWD_MAX_LEN. " caracteres");
            return false;
        }

        $repeated = $this->find("email = :e ", "e={$this->email}")->fetch();

        if ($repeated) {
            $this->message()->error("Já existe outro cliente cadastrado com este email.");
            return false;
        }

        return true;
    }

    public function validate_update(): bool
    {
        if (empty($this->name)) {
            $this->message()->error("Preencha o campo Nome");
            return false;
        }

        if (empty($this->email)) {
            $this->message()->error("Preencha o campo Email");
            return false;
        }

        if (!is_email($this->email)){

            $this->message()->error("Utilize um e-mail válido");
            return false;
        }

        $repeated = $this->find("email = :e AND id <> :i", "e={$this->email}&i={$this->id}")->fetch();

        if ($repeated) {
            $this->message()->error("Já existe outro cliente cadastrado com este email.");
            return false;
        }

        return true;
    }

    #####################
    ### RELATIONSHIPS ###
    #####################

    /** has many */
    public function userAddresses(int $user_id)
    {
        $find = Connect::getInstance()->query("
        SELECT * FROM users_addresses where user_id = {$user_id}
        ")->fetchAll();
        return $find;
    }

    public function userActiveAddresses(int $user_id)
    {
        $find = Connect::getInstance()->query("
        SELECT * FROM users_addresses where user_id = {$user_id} AND status = 1
        ")->fetch();
        return $find;
    }

    /** has one */
    public function userData()
    {
        $find = Connect::getInstance()->query("
        SELECT * FROM users_data where user_id = {$this->id}
        ")->fetch();
        return $find;
    }

    ############
    ### SAVE ###
    ############


    /**
     * @return null|Users
     */
    public
    function save(): ?Users
    {

        if (empty($this->id)) {

            /* gerando código do registro */
            $this->code = generic_code();

            $this->json_data = json_encode($this->data);

            /** criptografando a senha */
            $this->password = passwd($this->password);

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