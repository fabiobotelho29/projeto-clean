<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 09/05/2019
 * Time: 10:56
 */

namespace Source\Core;

use League\Plates\Engine;


/**
 * Class View
 * @package Source\Core
 */
class View
{
    /**
     * @var Engine
     */
    protected $engine;

    /**
     * View constructor.
     * @param string $path
     * @param string $ext
     */
    public function __construct(string $path = VIEWS_PATH, string $ext = VIEWS_EXT)
    {
        $this->engine = Engine::create("{$path}", "{$ext}");
    }

    /**
     * @param string $name
     * @param string $path
     * @return View
     */
    public function addFolder(string $name, string $path): View
    {
        $this->engine->addFolder($name, $path);
        return $this;
    }

    /**
     * @param string $templateName
     * @param array $data
     * @return string
     */
    public function render(string $templateName, array $data): string
    {
        return $this->engine->render($templateName, $data);
    }

    /**
     * @return Engine
     */
    public function engine():Engine
    {
        return $this->engine();
    }
}

