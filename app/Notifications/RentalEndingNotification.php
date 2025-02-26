<?php

namespace App\Notifications;

use App\Models\Rental;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentalEndingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected Rental $rental)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $vehicleModel = $this->rental->vehicle->model;
        $endDate = $this->rental->end_time->format('d/m/Y H:i');
        
        return (new MailMessage)
            ->subject('Il tuo noleggio termina a breve')
            ->greeting('Gentile ' . $notifiable->name)
            ->line("Ti ricordiamo che il tuo noleggio del veicolo $vehicleModel termina il $endDate.")
            ->line("Ti preghiamo di riportare il veicolo presso la nostra sede entro l'orario stabilito.")
            ->action('Visualizza Dettaglio Noleggio', route('user.rentals.show', $this->rental))
            ->line('Grazie per aver scelto il nostro servizio.');
    }
}