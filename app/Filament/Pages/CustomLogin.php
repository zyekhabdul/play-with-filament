<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Auth\Pages\Login as BaseLogin;

class CustomLogin extends BaseLogin
{
    protected function getEmailFormComponent(): Component
    {
        // Use a plain text input (no HTML5 email validation) and update the label
        return TextInput::make('email')
            ->label(__('Email address or username'))
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    /**
     * Map submitted form data to credentials. If the login value contains
     * an '@' treat it as an email, otherwise use the 'username' key so the
     * user provider can lookup by username.
     *
     * @param array<string,mixed> $data
     * @return array<string,mixed>
     */
    protected function getCredentialsFromFormData(array $data): array
    {
        $login = (string) ($data['email'] ?? '');

        if (str_contains($login, '@')) {
            return [
                'email' => $login,
                'password' => $data['password'] ?? '',
            ];
        }

        return [
            'username' => $login,
            'password' => $data['password'] ?? '',
        ];
    }
}