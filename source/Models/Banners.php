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
 * Class Banners
 * @package Source\Models
 */
class Banners extends Model
{
    /** @var array $safe no update or create */
    protected static $protected = ["id", "created_at", "updated_at"];

    /** @var string $entity database table */
    protected static $entity = "banners";

    /** @var */
    protected $message;

    /**
     * Banners constructor.
     */
    public function __construct()
    {
        parent::__construct(self::$entity, self::$protected, self::$required);
    }


    /**
     * @param int $empresa_id
     * @param string $nome
     * @return Banners
     */
    public function bootstrap(
        string $img, string $title, string $subtitle, string $description, string $link

    ): Banners
    {
        $this->img = $img;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->description = $description;
        $this->link= $link;

        return $this;
    }

    #############
    ### FINDS ###
    #############
    /**
     * @param string $id
     * @param string $columns
     * @return null|Banners
     */
    public
    function findById(string $id, $columns = "*"): ?Banners
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $code
     * @param string $columns
     * @return null|Banners
     */
    public
    function findByCode(string $code, $columns = "*"): ?Banners
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
        if (empty($this->img)) {
            $this->message()->error("Preencha o campo Imagem");
            return false;
        }

        if (empty($this->title)) {
            $this->message()->error("Preencha o campo Título");
            return false;
        }

        if (empty($this->subtitle)) {
            $this->message()->error("Preencha o campo Subtítulo");
            return false;
        }

        if (empty($this->description)) {
            $this->message()->error("Preencha o campo Descrição");
            return false;
        }

        if (empty($this->link)) {
            $this->message()->error("Preencha o campo Link");
            return false;
        }

        return true;
    }

    public function validate_update(): bool
    {
        if (empty($this->img)) {
            $this->message()->error("Preencha o campo Imagem");
            return false;
        }

        if (empty($this->title)) {
            $this->message()->error("Preencha o campo Título");
            return false;
        }

        if (empty($this->subtitle)) {
            $this->message()->error("Preencha o campo Subtítulo");
            return false;
        }

        if (empty($this->description)) {
            $this->message()->error("Preencha o campo Descrição");
            return false;
        }

        if (empty($this->link)) {
            $this->message()->error("Preencha o campo Link");
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
     * @return null|Banners
     */
    public
    function save(): ?Banners
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