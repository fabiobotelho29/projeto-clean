<?php
/**
 * SUPPORT MAIL FILE
 */

namespace Source\Support;


use Source\Core\Connect;

class SwiftMail
{
    /** @var array */
    private $data;

    /** @var SwiftMail */
    private $mail;

    /** @var $mailer */
    private $mailer;

    /** @var Message */
    private $message;

    /** @var $sender */
    private $sender;

    /**
     * Email constructor.
     */
    public function __construct()
    {
        $this->mail = new \Swift_SmtpTransport(CONF_MAIL_HOST, CONF_MAIL_PORT);
        $this->data = new \stdClass();
        $this->message = new Message();

        //setup
        $this->mailer = new \Swift_Mailer($this->mail);

        //auth
        $this->mail->setUsername(CONF_MAIL_USER);
        $this->mail->setPassword(CONF_MAIL_PASS);

    }

    /**
     * @param string $subject
     * @param string $body
     * @param string $toEmail
     * @param string $$recipientName
     * @return SwiftMail
     */
    public function bootstrap(string $subject, string $body, string $recipient, string $recipientName): SwiftMail
    {
        $this->data->subject = $subject;
        $this->data->body = $body;
        $this->data->recipient_email = $recipient;
        $this->data->recipient_name = $recipientName;
        return $this;
    }

    /**
     * @param string $filePath
     * @param string $fileName
     * @return SwiftMail
     */
    public
    function attach(string $filePath, string $fileName): SwiftMail
    {

        $this->data->attach[$filePath] = \Swift_Attachment::fromPath($filePath)->setFilename($fileName);
        return $this;
    }

    /**
     * @param $from
     * @param $fromName
     * @return bool
     */
    public
    function send(string $from = CONF_MAIL_SENDER['address'], string $fromName = CONF_MAIL_SENDER["name"]): bool
    {
        if (empty($this->data)) {
            $this->message->error("Erro ao enviar, favor verifique os dados");
            return false;
        }

        if (!is_email($this->data->recipient_email)) {
            $this->message->warning("O e-mail de destinatário não é válido");
            return false;
        }

        if (!is_email($from)) {
            $this->message->warning("O e-mail de remetente não é válido");
            return false;
        }

        try {

            $this->sender = new \Swift_Message();
            $this->sender->setSubject($this->data->subject);
            $this->sender->setFrom([$from => $fromName]);
            $this->sender->setTo([$this->data->recipient_email => $this->data->recipient_name]);
            $this->sender->setBody($this->data->body, "text/html");
            $this->sender->getCharset();

            if (!empty($this->data->attach)) {
                foreach ($this->data->attach as $file) {
                    $this->sender->attach($file);
                }
            }

            if ($this->mailer->send($this->sender)) {
                return true;
            } else {
                return false;
            }

        } catch (\Exception $e) {
            $this->message->error($e->getMessage());
            return false;
        }
    }

    /**
     * @param string $from
     * @param string $fromName
     * @return bool
     */
    public function queue(string $from = CONF_MAIL_SENDER['address'], string $fromName = CONF_MAIL_SENDER["name"]): bool
    {
        try {
            $stmt = Connect::getInstance()->prepare(
                "INSERT INTO mail_queue (subject, body, from_email, from_name, recipient_email, recipient_name)
                          VALUES 
                          (:subject, :body, :from_email, :from_name, :recipient_email, :recipient_name)"
            );

            $stmt->bindValue(":subject", $this->data->subject, \PDO::PARAM_STR);
            $stmt->bindValue(":body", $this->data->body, \PDO::PARAM_STR);
            $stmt->bindValue(":from_email", $from, \PDO::PARAM_STR);
            $stmt->bindValue(":from_name", $fromName, \PDO::PARAM_STR);
            $stmt->bindValue(":recipient_email", $this->data->recipient_email, \PDO::PARAM_STR);
            $stmt->bindValue(":recipient_name", $this->data->recipient_name, \PDO::PARAM_STR);

            $stmt->execute();
            return true;

        } catch (\PDOException $exception) {
            $this->message->error($exception->getMessage());
            return false;
        }
    }

    /**
     * @param int $perSecond
     */
    public function sendQueue(int $perSecond = 5)
    {
        $stmt = Connect::getInstance()->query("SELECT * FROM mail_queue WHERE sent_at IS NULL");
        if ($stmt->rowCount()) {
            foreach ($stmt->fetchAll() as $send) {
                $email = $this->bootstrap(
                    $send->subject,
                    $send->body,
                    $send->recipient_email,
                    $send->recipient_name
                );

                if ($email->send($send->from_email, $send->from_name)) {
                    usleep(1000000 / $perSecond);
                    Connect::getInstance()->exec("UPDATE mail_queue SET sent_at = NOW() WHERE id = {$send->id}");
                }
            }
        }
    }

    /**
     * @return SwiftMail
     */
    public
    function mail(): SwiftMail
    {
        return $this->mail;
    }

    /**
     * @return Message
     */
    public
    function message(): Message
    {
        return $this->message;
    }

}