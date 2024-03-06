<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 11/05/2019
 * Time: 14:09
 */

namespace Source\Core;
use Source\Models\Users;
use Source\Core\Session;
use Source\Models\Usuarios;


/**
 * Class LoginAdmin
 * @package Source\Core
 */
class LoginAdmin extends Model
{
    /** @var */
    protected $message;

    /** @var string $entity database table */
    protected static $entity = "users";

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
     * @return LoginAdmin
     */
    public function bootstrap(string $email, string $passwd): LoginAdmin
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

        $admin_user = ADMIN_USER;
        $admin_passwd = ADMIN_PASSWD;

        if($admin_user != $this->email){
            $this->message()->warning("Usuário não verificado.");
            return false;
        }

        /* chech senha */
        if($this->passwd != $admin_passwd){
            $this->message()->warning("Senha incorreta.");
            return false;
        }

        /* retornando o id do registro */
//        $this->user_id = $user->user_id;
        return true;
    }

    /**
     * @return null|LoginAdmin
     */
    public function authUser(): ?LoginAdmin
    {

        /* checkando usuario e senha */
        if (!$this->checkUser()) {
            return null;
        }

        /* gerando a sessão */
        $session = new Session();
        $session->set("user_admin", $this->email);
        $this->data = $this->data();

        /* persistencia dos dados - active records */
        return $this;
    }

    /**
     * @return null|LoginAdmin
     */
    public function authDestroy():?LoginAdmin
    {
        $session = new Session();
        $session->unset("user_admin");
        return $this;
    }

    /**
     * @return bool
     */
    public static function user(): ?bool
    {
        $session = new Session();
        if (!$session->has("user_admin")) {
            return false;
        }
        return true;
    }
}