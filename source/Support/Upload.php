<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 20/11/2019
 * Time: 23:26
 */

namespace Source\Support;


/**
 * Class Upload
 * @author FabioC. Botelho <fabiobotelho29@gmail.com>
 * @package Source\Support
 */
/**
 * Class Upload
 * @package Source\Support
 */
/**
 * Class Upload
 * @package Source\Support
 */
class Upload
{
    /** @var Message */
    private $message;

    /** @var string */
    public $name;

    /** @var string */
    protected $type;

    /** @var string */
    protected $ext;

    /** @var string */
    protected $path_type;

    /** @var string */
    protected $path;

    /** @var string */
    protected $link;

    /** @var */
    protected $nova;

    /** @var array */
    private $allowed_files = [
        "application/zip",
        "application/x-zip-compressed",
        'application/x-rar-compressed',
        'application/x-bzip',
        "application/pdf",
        "application/msword",
        "text/plain",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    ];

    /** @var array */
    private $extensions_files = [
        "zip",
        "rar",
        "bz",
        "pdf",
        "doc",
        "docx",
        "xls",
        "xlsx",
        "txt"
    ];

    /** @var array */
    private $allowed_images = [
        "image/jpeg",
        "image/jpg",
        "image/png",
        "image/gif",
    ];

    /** @var array */
    private $extensions_images = [
        "jpg",
        "png",
        "jpeg"
    ];

    /** @var array */
    private $allowed_media = [
        "audio/mp3",
        "audio/mpeg",
        "video/mp4",
    ];

    /** @var array */
    private $extensions_media = [
        "mp3",
        "mp4"
    ];

    /**
     * Upload constructor.
     */
    public function __construct()
    {
        $this->message = new Message();
    }

    /**
     * @return Message
     */
    public function message(): Message
    {
        return $this->message;
    }

    /**
     * @param string $name
     * @return string
     */
    protected function create_name(string $name): string
    {
        $name = filter_var(mb_strtolower($name), FILTER_SANITIZE_STRIPPED);
        $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';
        $name = str_replace(["-----", "----", "---", "--"], "-",
            str_replace(" ", "-", trim(strtr(utf8_decode($name), utf8_decode($formats), $replace))));

        $this->name = time()."-{$name}." . $this->ext;

        if (file_exists("{$this->path}/{$this->name}") && is_file("{$this->path}/{$this->name}")) {
            $this->name = "{$name}-" . time() . ".{$this->ext}";
        }
        return $this->name;
    }


    /**
     * @param array $file
     * @param int $size
     * @param string $path
     * @return null|string
     */
    public function image(array $file, string $empresa, int $size = (1 * 1024 * 1024), string $path = CONF_UPLOAD_IMAGES_PRODUTOS):?string
    {
        $this->type = $file['type'];
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);
        $this->path = $path . "/";

        if (!in_array($this->type, $this->allowed_images)) {
            $this->message()->error("Você não selecionou uma imagem válida. Tamanho máximo, 1MB.");
            return null;
        }

        if (!in_array($this->ext, $this->extensions_images)) {
            $this->message()->error("Extensão de arquivo de imagem inválida.");
            return null;
        }

        if ($file['size'] > $size) {
            $this->message()->error("O tamanho do arquivo deve ser de, no máximo, {$size} bytes.");
            return null;
        }

        $this->name = $this->create_name(pathinfo($file['name'])['filename']);
        $this->name = $empresa."-".$this->name;

        /* redimensionando */
        $this->redimensionar($file, 100, 100);


        if (!imagejpeg($this->nova, $this->path . $this->name)) {
            $this->message->error("Houve um problema no Upload da imagem.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;
        /*
        if (!move_uploaded_file($file['tmp_name'], $this->path . $this->name)) {
            $this->message->error("Houve um problema no Upload da imagem.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;
        */
    }

    public function imageBanner(array $file, int $size = (1 * 1024 * 1024), string $path = CONF_UPLOAD_IMAGES_BANNER):?string
    {
        $this->type = $file['type'];
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);
        $this->path = $path . "/";

        if (!in_array($this->type, $this->allowed_images)) {
            $this->message()->error("Você não selecionou uma imagem válida. Tamanho máximo, 1MB.");
            return null;
        }

        if (!in_array($this->ext, $this->extensions_images)) {
            $this->message()->error("Extensão de arquivo de imagem inválida.");
            return null;
        }

        if ($file['size'] > $size) {
            $this->message()->error("O tamanho do arquivo deve ser de, no máximo, {$size} bytes.");
            return null;
        }

        $this->name = $this->create_name(pathinfo($file['name'])['filename']);
        $this->name = "banner-".$this->name;

        /* redimensionando */
        $this->redimensionar($file, 1920, 800);

//        if (!imagejpeg($this->nova, $this->path . $this->name)) {
//            $this->message->error("Houve um problema no Upload da imagem.<br> Favor entrar em contato com o administrador do Sistema.")->render();
//            return null;
//        }

//        return $this->name;

        if (!move_uploaded_file($file['tmp_name'], $this->path . $this->name)) {
            $this->message->error("Houve um problema no Upload da imagem.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;

    }

    public function image_logo(array $file, string $empresa, int $size = (1 * 1024 * 1024), string $path = CONF_UPLOAD_IMAGES_LOGOMARCA):?string
    {
        $this->type = $file['type'];
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);
        $this->path = $path . "/";

        if (!in_array($this->type, $this->allowed_images)) {
            $this->message()->error("Você não selecionou uma imagem válida. Tamanho máximo, 1MB.");
            return null;
        }

        if (!in_array($this->ext, $this->extensions_images)) {
            $this->message()->error("Extensão de arquivo de imagem inválida.");
            return null;
        }

        if ($file['size'] > $size) {
            $this->message()->error("O tamanho do arquivo deve ser de, no máximo, {$size} bytes.");
            return null;
        }

        $this->name = $this->create_name(pathinfo($file['name'])['filename']);
        $this->name = $empresa."-".$this->name;

        /* redimensionando */
        $this->redimensionar($file, 200, 200);


        if (!imagejpeg($this->nova, $this->path . $this->name)) {
            $this->message->error("Houve um problema no Upload da imagem.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;
        /*
        if (!move_uploaded_file($file['tmp_name'], $this->path . $this->name)) {
            $this->message->error("Houve um problema no Upload da imagem.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;
        */
    }

    /**
     * @param $imagem
     * @param $largura
     * @param string $altura
     * @return mixed
     */

    protected function redimensionar($imagem, $largura, $altura = 400){

        if ($imagem['type']=="image/jpeg"){
            $img = imagecreatefromjpeg($imagem['tmp_name']);
        }elseif ($imagem['type']=="image/jpg"){
            $img = imagecreatefromjpeg($imagem['tmp_name']);
        }else if ($imagem['type']=="image/gif"){
            $img = imagecreatefromgif($imagem['tmp_name']);
        }else if ($imagem['type']=="image/png"){
            $img = imagecreatefrompng($imagem['tmp_name']);
        }

        /* redimensionar proporcionalmente */

        $x   = imagesx($img);
        $y   = imagesy($img);
        /*
        $altura = ($largura * $y)/$x;
        */

        /* redimensionar forçado */

        $this->nova = imagecreatetruecolor($largura, $altura);
        imagecopyresampled($this->nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
        /*
        if ($imagem['type']=="image/jpeg"){
            $local="$pasta/$name".".jpg";
            imagejpeg($nova, $local);
        }else if ($imagem['type']=="image/gif"){
            $local="$pasta/$name".".gif";
            imagejpeg($nova, $local);
        }else if ($imagem['type']=="image/png"){
            $local="$pasta/$name".".png";
            imagejpeg($nova, $local);
        }
        */

        imagedestroy($img);
//        imagedestroy($this->nova);

        return $this->nova;
    }

    /**
     * @param array $file
     * @param int $size
     * @param string $path
     * @return null|string
     */
    public function banner(array $file, int $size = (2 * 1024 * 1024), string $path = CONF_UPLOAD_IMAGES_BANNER):?string
    {
        $this->type = $file['type'];
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);
        $this->path = $path . "/";

        if (!in_array($this->type, $this->allowed_images)) {
            $this->message()->error("Você não selecionou uma imagem válida. Tamanho máximo, 2MB.");
            return null;
        }

        if (!in_array($this->ext, $this->extensions_images)) {
            $this->message()->error("Extensão de arquivo de imagem inválida.");
            return null;
        }

        if ($file['size'] > $size) {
            $this->message()->error("O tamanho do arquivo deve ser de, no máximo, {$size} bytes.");
            return null;
        }

        $this->name = $this->create_name(pathinfo($file['name'])['filename']);

        /* redimensionando */
        $this->redimensionar($file, 1200, 300);


        if (!imagejpeg($this->nova, $this->path . $this->name)) {
            $this->message->error("Houve um problema no Upload da imagem.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;
        /*
        if (!move_uploaded_file($file['tmp_name'], $this->path . $this->name)) {
            $this->message->error("Houve um problema no Upload da imagem.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;
        */
    }

    public function logomarca(array $file, int $size = (2 * 1024 * 1024), string $path = CONF_UPLOAD_IMAGES_LOGOMARCA):?string
    {
        $this->type = $file['type'];
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);
        $this->path = $path . "/";

        if (!in_array($this->type, $this->allowed_images)) {
            $this->message()->error("Você não selecionou uma imagem válida. Tamanho máximo, 2MB.");
            return null;
        }

        if (!in_array($this->ext, $this->extensions_images)) {
            $this->message()->error("Extensão de arquivo de imagem inválida.");
            return null;
        }

        if ($file['size'] > $size) {
            $this->message()->error("O tamanho do arquivo deve ser de, no máximo, {$size} bytes.");
            return null;
        }

        $this->name = $this->create_name(pathinfo($file['name'])['filename']);

        /* redimensionando */
        $this->redimensionar($file, 165, 46);


        if (!imagejpeg($this->nova, $this->path . $this->name)) {
            $this->message->error("Houve um problema no Upload da imagem.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;
        /*
        if (!move_uploaded_file($file['tmp_name'], $this->path . $this->name)) {
            $this->message->error("Houve um problema no Upload da imagem.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;
        */
    }


    /**
     * @param array $file
     * @param int $size
     * @param string $path
     * @return null|string
     */
    public function file(array $file, int $size = (50 * 1024 * 1024), string $path = CONF_UPLOAD_FILE_DIR):?string
    {

        $this->type = $file['type'];
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);
        $this->path = $path . "/";

        if (!in_array($this->type, $this->allowed_files)) {
            $this->message()->error("Você não selecionou um formato de aquivo válido.");
            return null;
        }

        if (!in_array($this->ext, $this->extensions_files)) {
            $this->message()->error("Extensão de arquivo inválida.");
            return null;
        }

        if ($file['size'] > $size) {
            $this->message()->error("O tamanho do arquivo deve ser de, no máximo, {$size} bytes.");
            return null;
        }

        $this->name = $this->create_name(pathinfo($file['name'])['filename']);

        if (!move_uploaded_file($file['tmp_name'], $this->path . $this->name)) {
            $this->message()->error("Houve um problema no Upload do arquivo.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;
    }

    /**
     * @param array $file
     * @param int $size
     * @param string $path
     * @return null|string
     */
    public function media(array $file, int $size = (1024 * 1024 * 1024), string $path = CONF_UPLOAD_MEDIA_DIR):?string
    {
        $this->type = $file['type'];
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);
        $this->path = $path . "/";

        if (!in_array($this->type, $this->allowed_media)) {
            $this->message()->error("Você não selecionou um formato de mídia válido.");
            return null;
        }

        if (!in_array($this->ext, $this->extensions_media)) {
            $this->message()->error("Extensão de arquivo inválida.");
            return null;
        }

        if ($file['size'] > $size) {
            $this->message()->error("O tamanho do arquivo deve ser de, no máximo, {$size} bytes.");
            return null;
        }

        $this->name = $this->create_name(pathinfo($file['name'])['filename']);

        if (!move_uploaded_file($file['tmp_name'], $this->path . $this->name)) {
            $this->message()->error("Houve um problema no Upload do arquivo.<br> Favor entrar em contato com o administrador do Sistema.")->render();
            return null;
        }

        return $this->name;
    }

    /**
     * @param string $filePath
     */
    public function remove(string $filePath): bool
    {
        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
            return true;
        }

        $this->message()->error("Arquivo não apagado.");
        return false;
    }
}