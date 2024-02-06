<?php


namespace App\Repositories;

use App\Exceptions\ComplaintsException;

class ComplaintsRepository
{
    /**
     * Cria um novo registro.
     *
     * @param array $attr
     * @return \App\Models\Complaints
     */
    public static function register(array $attr): \App\Models\Complaints
    {
        // Criando registro.
        $complaints = \App\Models\Complaints::create($attr);

        // Valida se foi registrada a denúncia.
        !$complaints && throw new ComplaintsException('Não foi possível registrar sua denúncia. Por favor, tente novamente.');

        return $complaints;
    }

    public static function sendMail(array $data): bool
    {
        // Recupetando configurações de e-mail.
        $mailSettings = unserialize(\App\Repositories\SettingsRepository::getSetting('application_complaints_mail'));

        \Illuminate\Support\Facades\Config::set('mail.mailers.smtp', [
            'transport' => $mailSettings['mail_settings']['TRANSPORT'],
            'host' => $mailSettings['mail_settings']['MAIL_HOST'],
            'port' => $mailSettings['mail_settings']['MAIL_PORT'],
            'encryption' => $mailSettings['mail_settings']['MAIL_ENCRYPTION'],
            'username' => $mailSettings['mail_settings']['MAIL_USERNAME'],
            'password' => $mailSettings['mail_settings']['MAIL_PASSWORD'],
            'timeout' => $mailSettings['mail_settings']['MAIL_TIMEOUT'],
        ]);

        \Illuminate\Support\Facades\Config::set('mail.default', $mailSettings['mail_settings']['TRANSPORT']);

        // Resetando as configurações.
        \Illuminate\Support\Facades\Mail::mailer('smtp');

        // Enviando e-mail.
        \Illuminate\Support\Facades\Mail::to($mailSettings['email'])->send(
            (new \App\Mail\Complaints($data))->subject($mailSettings['subject'])
        );


        return true;
    }
}