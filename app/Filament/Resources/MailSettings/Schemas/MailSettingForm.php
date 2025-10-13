<?php

namespace App\Filament\Resources\MailSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MailSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('mail_mailer'),
                TextInput::make('mail_host'),
                TextInput::make('mail_port'),
                TextInput::make('mail_username'),
                TextInput::make('mail_password')
                    ->password(),
                TextInput::make('mail_encryption'),
                TextInput::make('mail_from_address'),
                TextInput::make('mail_from_name'),
            ]);
    }
}
