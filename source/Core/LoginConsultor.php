<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 11/05/2019
 * Time: 14:09
 */

namespace Source\Core;
use Source\Models\Consultores;
use Source\Models\Users;
use Source\Core\Session;
use Source\Models\Usuarios;


/**
 * Class LoginConsultor
 * @package Source\Core
 */
class LoginConsultor extends Model
{
    /** @var */
    protected $message;

    /** @var string $entity database table */
    protected static $entity = "consultores";

    /** @var array $required table fileds */
    protected static $required = ["email", "passwd"];

    /** @var array */
    protected static $protected = ["id", "created_at", "updated_at"];

    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct(self::$entity, self::$protected, self::$required);
    }


    /**
     * @param string $user
     * @param string $passwd
     * @return LoginConsultor
     */
    public function bootstrap(string $email, string $passwd): LoginConsultor
    {
        $this->email = $email;
        $this->passwd = $passwd;
        return $this;
    }

    /**
     * @return bool
     */
    private function checkUser(): bool
    {

        /* selecionando o consultor */
        $this->consultor = (new Consultores())->findByEmail($this->email);

        if (empty($this->consultor)){
            $this->message()->warning("Usuário não verificado.");
            return false;
        }

        /* verificando a senha */
        if (!passwd_verify($this->passwd, $this->consultor->senha)){
            $this->message()->warning("Senha incorreta.");
            return false;
        }

        /* retornando o id do registro */
        return true;
    }

    /**
     * @return null|LoginConsultor
     */
    public function authUser(): ?LoginConsultor
    {

        /* checkando usuario e senha */
        if (!$this->checkUser()) {
            return null;
        }

        /* gerando a sessão */
        $session = new Session();
        $session->set("user_consultor", $this->consultor->code);
        $this->data = $this->data();

        /* persistencia dos dados - active records */
        return $this;
    }

    /**
     * @return null|LoginConsultor
     */
    public function authDestroy():?LoginConsultor
    {
        $session = new Session();
        $session->unset("user_consultor");
        return $this;
    }

    /**
     * @return bool
     */
    public static function user(): ?bool
    {
        $session = new Session();
        if (!$session->has("user_consultor")) {
            return false;
        }
        return true;
    }
}