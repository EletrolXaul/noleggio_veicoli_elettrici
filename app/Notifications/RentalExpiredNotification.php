<?php

namespace App\Notifications;

use App\Models\Rental;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentalExpiredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Rental $rental)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Noleggio Scaduto')
            ->greeting('Gentile ' . $notifiable->name)
            ->line('Il tuo noleggio per il veicolo ' . $this->rental->vehicle->model . ' è scaduto.')
            ->line('Data fine noleggio: ' . $this->rental->end_time)
            ->action('Visualizza Dettagli', route('user.rentals.show', $this->rental))
            ->line('Ti preghiamo di completare il noleggio o rinnovarlo.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'rental_id' => $this->rental->id,
            'end_time' => $this->rental->end_time,
            'vehicle' => $this->rental->vehicle->model
        ];
    }
}
