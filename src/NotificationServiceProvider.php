<?php

namespace Fahmiardi\Laravel\Notifications;

use Illuminate\Support\ServiceProvider;
use Fahmiardi\Laravel\Notifications\Channels\SnsChannel;
use Aws\Sns\SnsClient;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SnsChannel::class, function ($app) {
            $config = $this->app['config']['services.sns'];
            $configure = [
                'credentials' => [
                    'key'    => $config['key'],
                    'secret' => $config['secret'],
                ],
                'version' => 'latest',
                'region' => $config['region']
            ];
            $profile = isset($config['profile']) ? ($config['profile'] ?: null) : null;

            if ($profile) {
                unset($configure['credentials']);
                $configure['profile'] = $profile;
            }

            return new SnsChannel(SnsClient::factory($configure));
        });
    }
}
