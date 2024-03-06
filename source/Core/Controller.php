<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 09/05/2019
 * Time: 11:26
 */

namespace Source\Core;


use Source\Support\Message;

/**
 * Class Controller
 * @package Source\Core
 */
class Controller
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Seo
     */
    protected $seo;
    /**
     * @var Message
     */
    protected $message;

    /**
     * Controller constructor.
     * @param string|null $pathToViews
     */
    public function __construct(string $pathToViews = null)
    {
        $this->view = new View($pathToViews);
        $this->seo = new Seo();
        $this->message = new Message();
    }
}