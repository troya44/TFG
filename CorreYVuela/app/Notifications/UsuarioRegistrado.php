<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Usuario;

class UsuarioRegistrado extends Notification
{
    use Queueable;

    public $usuario;

    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
{
    $esEmpresa = $notifiable instanceof \Illuminate\Notifications\AnonymousNotifiable;

    $subject = $esEmpresa
        ? 'Nuevo usuario registrado en Corre y Vuela'
        : '¡Bienvenido/a a Corre y Vuela!';

    return (new MailMessage)
        ->subject($subject)
        ->view('emails.usuario_registrado', [
            'usuario' => $this->usuario,
            'esEmpresa' => $esEmpresa,
        ]);
}

}
