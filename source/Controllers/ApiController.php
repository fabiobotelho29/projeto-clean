<?php
/**
 * CONTROLADOR DO PAINEL ADMIN
 */

namespace Source\Controllers;

use http\Env\Request;
use Mpdf\Tag\U;
use Source\Core\Controller;
use Source\Core\Session;
use Source\Models\Users;
use Source\Models\UsersData;


/**
 * Class FrontController
 * @package Source\Controllers
 */
class ApiController extends Controller
{
    protected $METHOD;
    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $pathToViews = "";
        parent::__construct($pathToViews);
    }

    /**
     * #############################
     * ###  CONSTRUÇÃO DAS ROTAS ###
     * #############################
     */

    public function registerUser($data): void
    {
        $this->METHOD = $_SERVER['REQUEST_METHOD'];

        if ($this->METHOD === 'POST'){
            // dados do form
            $data = json_decode(file_get_contents('php://input'), true);

            // form validation
            $firstName = htmlspecialchars($data['firstName']);
            $lastName = htmlspecialchars($data['lastName']);
            $email = htmlspecialchars($data['email']);
            $password = htmlspecialchars($data['password']);
            $terms = htmlspecialchars($data['terms']);


            // use
            $user = new Users();
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->email = $email;
            $user->password = $password;
            $user->terms = $terms;

            // validating user
            if (!$user->validate_register()){

                $json['error'] = $user->response;
                echo json_encode($json);
                return;
            }

            // saving user
            if (!$user->save()){
                $json['error'] = $user->response;
                echo json_encode($json);
                return;
            }
            $json['success'] = $user->response;
            echo json_encode($json);
            return;

        } else {

            $json['erro'] = 'Tipo de Requisição inválida';
            echo json_encode($json);
            return;
        }



    }

    public function loginUser($data): void
    {
        $this->METHOD = $_SERVER['REQUEST_METHOD'];

        if ($this->METHOD === 'POST'){
            // dados do form
            $data = json_decode(file_get_contents('php://input'), true);

            // form validation
            $email = htmlspecialchars($data['email']);
            $password = htmlspecialchars($data['password']);

            // use
            $user = (new Users())->findByEmail($email);

            // checking user
            if (!$user){

                $json['error'] = 'Usuário não encontrado. Verifique o email digitado.';
                echo json_encode($json);
                return;
            }

            // validating password
            if (!passwd_verify($password, $user->password)){

                $json['error'] = 'A Senha digitada está incorreta.';
                echo json_encode($json);
                return;
            }

            // loging in user
            \session()->set("user", $user);

            $json['success'] = "Usuário encontrado. Aguarde redirecionamento.";
            $json['url'] = url('panel/dashboard');
            echo json_encode($json);
            return;

        } else {

            $json['erro'] = 'Tipo de Requisição inválida';
            echo json_encode($json);
            return;
        }



    }

    public function test(?array $data)
    {
        $json['resposta'] = "Resposta do JSON";
        $json['status'] = "SUCESSO";
        echo json_encode($json);
        return;
    }

}