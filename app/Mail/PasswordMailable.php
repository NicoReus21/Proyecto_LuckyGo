<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Class PasswordMailable
 * 
 * Mailable para enviar contraseñas por correo electrónico.
 */
class PasswordMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * La contraseña que se enciará por correo electrónico.
     * 
     * @var string
     */
    public $password;

    /**
     * Crea una nueva instancia del mensaje.
     * 
     * @param string pwd La contraseña a enviar por correo electrónico.
     */
    public function __construct(string $pwd)
    {
        $this->password = $pwd;
    }

    /**
     * Obtiene el mensaje.
     * 
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Envio Contraseña',
        );
    }

    /**
     * Obtiene los archivos adjuntos para el mensaje.
     * 
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.sendPassword',
        );
    }

    /**
     * 
     *
     * @return 
     */
    public function attachments(): array
    {
        return [];
    }
}
