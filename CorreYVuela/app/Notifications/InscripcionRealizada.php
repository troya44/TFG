<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Carrera;
use App\Models\Usuario;

class InscripcionRealizada extends Notification
{
    use Queueable;

    public $carrera;
    public $usuario;

    public function __construct(Carrera $carrera, Usuario $usuario)
    {
        $this->carrera = $carrera;
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
        ? 'Nueva inscripción en ' . $this->carrera->nombre
        : 'Confirmación de inscripción en ' . $this->carrera->nombre;

    return (new MailMessage)
        ->subject($subject)
        ->view(
            'emails.inscripcion_realizada',
            [
                'carrera' => $this->carrera,
                'usuario' => $this->usuario,
                'esEmpresa' => $esEmpresa,
            ]
        );
    }

}
