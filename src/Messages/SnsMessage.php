<?php

namespace Fahmiardi\Laravel\Notifications\Messages;

class SnsMessage
{
    /**
     * The "level" of the notification (info, success, warning, error).
     *
     * @var string
     */
    public $level = 'info';

    /**
     * The topic arn the message should be sent to.
     *
     * @var string
     */
    public $topicArn;

    /**
     * The message of the message.
     *
     * @var string
     */
    public $message;

    /**
     * The message's subject.
     *
     * @var string
     */
    public $subject;

    /**
     * Indicate that the notification gives information about a successful operation.
     *
     * @return $this
     */
    public function success()
    {
        $this->level = 'success';

        return $this;
    }

    /**
     * Indicate that the notification gives information about a warning.
     *
     * @return $this
     */
    public function warning()
    {
        $this->level = 'warning';

        return $this;
    }

    /**
     * Indicate that the notification gives information about an error.
     *
     * @return $this
     */
    public function error()
    {
        $this->level = 'error';

        return $this;
    }

    /**
     * Set the Sns topic arn the message should be sent to.
     *
     * @param  string $topicArn
     * @return $this
     */
    public function topicArn($topicArn)
    {
        $this->topicArn = $topicArn;

        return $this;
    }

    /**
     * Set the subject of the Sns message.
     *
     * @param  string $subject
     * @return $this
     */
    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set the message of the Sns message.
     *
     * @param  string  $payload
     * @return $this
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }
}
