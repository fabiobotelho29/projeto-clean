<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 09/05/2019
 * Time: 11:30
 */

namespace Source\Support;
use Source\Core\Session;


/**
 * Class Message
 * @package Source\Support
 */
class Message
{
    /** @var string */
    private $text;

    /** @var string */
    private $type;

    /** @var string */
    private $icon;

    /**
     * @return string
     */
    public function __toString()
    {
       return $this->render();
    }

    /**
     * @return null|string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function info(string $message): Message
    {
        $this->type = CONF_MESSAGE_INFO;
        $this->icon = CONF_MESSAGE_ICON_INFO;
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function success(string $message): Message
    {
        $this->type = CONF_MESSAGE_SUCCESS;
        $this->icon = CONF_MESSAGE_ICON_SUCCESS;
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function warning(string $message): Message
    {
        $this->type = CONF_MESSAGE_WARNING;
        $this->icon = CONF_MESSAGE_ICON_WARNING;
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function error(string $message): Message
    {
        $this->type = CONF_MESSAGE_ERROR;
        $this->icon = CONF_MESSAGE_ICON_ERROR;
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return "<br> <div style=\"font-size:0.8em; font-weight: normal; text-transform: uppercase;\" class='" . CONF_MESSAGE_CLASS . " " .CONF_MESSAGE_CLASS. "-{$this->getType()}'><b>{$this->icon} {$this->getText()}</b></div>";
//        return "<br> <div style=\"text-align:center; font-size:1em; color:#666; font-weight: normal; text-transform: uppercase;\"><b>{$this->getText()}</b></div>";
    }

    /**
     * @return string
     */
    public function json(): string
    {
        return json_encode(["error" => $this->getText()]);
    }

    /**
     *
     */
    public function flash(): void
    {
        (new Session())->set("flash", $this);
    }

    /**
     * @param string $message
     * @return string
     */
    private function filter(string $message): string
    {
        return filter_var($message, FILTER_SANITIZE_STRIPPED);
    }
}