<?php

namespace Fahmiardi\Laravel\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Fahmiardi\Laravel\Notifications\Messages\SnsMessage;
use Aws\Sns\SnsClient;

class SnsChannel
{
    protected $snsClient;

    public function __construct(SnsClient $snsClient)
    {
        $this->snsClient = $snsClient;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSns($notifiable);

        $this->snsClient->publish($this->buildPayload($message));
    }

    protected function buildPayload(SnsMessage $message)
    {
        return [
            'Message' => $message->message,
            'TopicArn' => $message->topicArn,
            'Subject' => $message->subject
        ];
    }
}