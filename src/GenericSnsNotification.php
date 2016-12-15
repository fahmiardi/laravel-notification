<?php

namespace Fahmiardi\Laravel\Notifications;

use Illuminate\Notifications\Notification;
use Fahmiardi\Laravel\Notifications\Channels\SnsChannel;

class GenericSnsNotification extends Notification
{
    protected $topicArn;
    protected $subject;
    protected $message;

    public function __construct($topicArn, $subject, $message)
    {
        $this->topicArn = $topicArn;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SnsChannel::class];
    }

    /**
     * Get the sns message representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Fahmiardi\Laravel\Notifications\Messages\SnsMessage
     */
    public function toSns($notifiable)
    {
        return (new Messages\SnsMessage)
            ->topicArn($this->topicArn)
            ->subject($this->subject)
            ->message($this->message);
    }
}
