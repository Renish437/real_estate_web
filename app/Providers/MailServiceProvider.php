<?php

namespace App\Providers;

use App\Models\MailSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
public function boot(): void
{
      if (!Schema::hasTable('mail_settings')) {
            return;
        }

        $mailConfig = MailSetting::first();

        if ($mailConfig) {
            Config::set('mail.default', $mailConfig->mail_mailer);

            Config::set("mail.mailers.{$mailConfig->mail_mailer}.transport", $mailConfig->mail_mailer);
            Config::set("mail.mailers.{$mailConfig->mail_mailer}.host", $mailConfig->mail_host);
            Config::set("mail.mailers.{$mailConfig->mail_mailer}.port", $mailConfig->mail_port);
            Config::set("mail.mailers.{$mailConfig->mail_mailer}.username", $mailConfig->mail_username);
            Config::set("mail.mailers.{$mailConfig->mail_mailer}.password", $mailConfig->mail_password);
            Config::set("mail.mailers.{$mailConfig->mail_mailer}.encryption", $mailConfig->mail_encryption);

            Config::set('mail.from.address', $mailConfig->mail_from_address);
            Config::set('mail.from.name', $mailConfig->mail_from_name);
        } 
    }
}
