# More Laravel Notification Providers

## Available Channels:

- AWS SNS (Simple Notification Services), support using `credentials` or `profile`

## Install

```php
$ composer require fahmiardi/laravel-notification
```

## Setup

Add config to `app/services.php`:

```php
return [
    ...
    'sns' => [
        'key' => env('SNS_KEY'),
        'secret' => env('SNS_SECRET'),
        'region' => env('SNS_REGION'),
        'profile' => env('AWS_PROFILE'),
    ],
];
```

## Usage

Use generic:

```php
<?php

$user->notify(
    new \Fahmiardi\Laravel\Notifications\GenericSnsNotification($topicArn, $subject, $message)
);
```

Create your own:

Read the official page (#Creating Notifications)[https://laravel.com/docs/5.3/notifications#creating-notifications]

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Fahmiardi\Laravel\Notifications\Channels\SnsChannel;
use Fahmiardi\Laravel\Notifications\Messages\SnsMessage;

class InvoicePaid extends Notification
{
    protected $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function via($notifiable)
    {
        return [SnsChannel::class];
    }

    public function toSns($notifiable)
    {
        return (new SnsMessage)
            ->topicArn('ARN')
            ->subject('SUBJECT')
            ->message('MESSAGE');
    }
}

$user->notify(new InvoicePaid($invoice));
```