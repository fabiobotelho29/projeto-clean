<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 11/05/2019
 * Time: 14:09
 */

namespace Source\Core;
use Source\Models\Empresas;
use Source\Models\Users;
use Source\Core\Session;
use Source\Models\Usuarios;


/**
 * Class LoginEmpresa
 * @package Source\Core
 */
class LoginEmpresa extends Model
{
    /** @var */
    protected $message;

    /** @var string $entity database table */
    protected static $entity = "empresas";

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
     * @return LoginEmpresa
     */
    public function bootstrap(string $email, string $passwd): LoginEmpresa
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
        $this->empresa = (new Empresas())->findByEmail($this->email);

        if (empty($this->empresa)){
            $this->message()->warning("E-mail da empresa não verificado.");
            return false;
        }

        /* verificando a senha */
        if (!passwd_verify($this->passwd, $this->empresa->senha)){
            $this->message()->warning("A Senha digitada está incorreta.");
            return false;
        }

        /* retornando o id do registro */
        return true;
    }

    /**
     * @return null|LoginEmpresa
     */
    public function authUser(): ?LoginEmpresa
    {

        /* checkando usuario e senha */
        if (!$this->checkUser()) {
            return null;
        }

        /* gerando a sessão */
        $session = new Session();
        $session->set("user_empresa", $this->email);
        $this->data = $this->data();

        /* persistencia dos dados - active records */
        return $this;
    }

    /**
     * @return null|LoginEmpresa
     */
    public function authDestroy():?LoginEmpresa
    {
        $session = new Session();
        $session->unset("user_empresa");
        return $this;
    }

    /**
     * @return bool
     */
    public static function user(): ?bool
    {
        $session = new Session();
        if (!$session->has("user_empresa")) {
            return false;
        }
        return true;
    }
}