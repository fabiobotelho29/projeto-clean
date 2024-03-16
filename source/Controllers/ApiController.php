<?php
/**
 * CONTROLADOR DO PAINEL ADMIN
 */

namespace Source\Controllers;

use http\Env\Request;
use Mpdf\Tag\U;
use Source\Core\Controller;
use Source\Core\Session;
use Source\Core\View;
use Source\Models\Users;
use Source\Models\UsersData;


/**
 * Class FrontController
 * @package Source\Controllers
 */
class ApiController extends Controller
{
    protected $METHOD;

    /** @var mixed|null User */
    public $USER;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $pathToViews = "";
        parent::__construct($pathToViews);

        if (\session()->has("user")){

            $this->USER = \session()->user;
        }
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

    public function passwordReset($data): void
    {
        $this->METHOD = $_SERVER['REQUEST_METHOD'];

        if ($this->METHOD === 'POST'){
            // dados do form
            $data = json_decode(file_get_contents('php://input'), true);

            // form validation
            $email = htmlspecialchars($data['email']);

            // user
            $user = (new Users())->findByEmail($email);

            // checking user
            if (!$user){

                $json['error'] = 'Usuário não encontrado. Verifique o email digitado.';
                echo json_encode($json);
                return;
            }

            // enviando e-mail de confirmação
            // mail views
            $pathMailViews = VIEWS_MAIL_PATH;
            $mail_view = new View($pathMailViews);
            $mail_view->render("forgot_passwd", [
                "user" => $this->USER
            ]);

            // emails para quem será enviado o formulário
            $emailenviar =$this->USER->email;
            $destino = $emailenviar;
            $assunto = "Esqueceu a senha";
            $nome = "Fabio Da Brenda";
            $email = 'fabiodabrenda@gmail.com';
            $message = $mail_view;

            // É necessário indicar que o formato do e-mail é html
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= 'From: Fabio Da Brenda <$email>';
            //$headers .= "Bcc: $EmailPadrao\r\n";

            //$message = 'Mensagem enviada pelo email';

            $enviaremail = mail($destino, $assunto, $message, $headers);
            if ($enviaremail) {
                $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
                echo 'funciona';
            } else {
                $mgm = "ERRO AO ENVIAR E-MAIL!";
                $enviaremail2 = mail("fabiodabrenda@gmail.com", 'Venda de Livro', "Não Confirmada: {$Customer_full_name} {$Customer_email}", $headers);
                echo "";
            }


            dump($mail_view);


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