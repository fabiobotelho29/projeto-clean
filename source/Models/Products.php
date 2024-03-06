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
 * Class Products
 * @package Source\Models
 */
class Products extends Model
{
    /** @var array $safe no update or create */
    protected static $protected = ["id", "created_at", "updated_at"];

    /** @var string $entity database table */
    protected static $entity = "products";

    /** @var */
    protected $message;

    /**
     * Products constructor.
     */
    public function __construct()
    {
        parent::__construct(self::$entity, self::$protected, self::$required);
    }



    public function bootstrap(
        int $category_id, string $name, string $description, float $price, string $sku, string $dimona_sku_id
    ): Products
    {
        $this->category_id = $category_id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->sku = $sku;
        $this->dimona_sku_id = $dimona_sku_id;
        return $this;
    }

    #############
    ### FINDS ###
    #############
    /**
     * @param string $id
     * @param string $columns
     * @return null|Products
     */
    public
    function findById(string $id, $columns = "*"): ?Products
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $code
     * @param string $columns
     * @return null|Products
     */
    public
    function findByCode(string $code, $columns = "*"): ?Products
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

        if (empty($this->category_id)) {
            $this->message()->error("Selecione uma categoria para cadastrar o produto");
            return false;
        }

        if (empty($this->name)) {
            $this->message()->error("Preencha o campo Nome");
            return false;
        }

        if (empty($this->description)) {
            $this->message()->error("Preencha o campo Descrição");
            return false;
        }

        if (empty($this->price)) {
            $this->message()->error("Preencha o campo Preço");
            return false;
        }

        if (empty($this->sku)) {
            $this->message()->error("Preencha o campo SKU");
            return false;
        }

        if (empty($this->dimona_sku_id)) {
            $this->message()->error("Preencha o campo SKU Dimona");
            return false;
        }

        return true;
    }

    public function validate_update(): bool
    {
        if (empty($this->category_id)) {
            $this->message()->error("Selecione uma categoria para cadastrar o produto");
            return false;
        }

        if (empty($this->name)) {
            $this->message()->error("Preencha o campo Nome");
            return false;
        }

        if (empty($this->description)) {
            $this->message()->error("Preencha o campo Descrição");
            return false;
        }

        if (empty($this->price)) {
            $this->message()->error("Preencha o campo Preço");
            return false;
        }

        if (empty($this->sku)) {
            $this->message()->error("Preencha o campo SKU");
            return false;
        }

        if (empty($this->dimona_sku_id)) {
            $this->message()->error("Preencha o campo SKU Dimona");
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
     * @return null|Products
     */
    public
    function save(): ?Products
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