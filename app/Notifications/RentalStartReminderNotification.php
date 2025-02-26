<?php

namespace App\Notifications;

use App\Models\Rental;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentalStartReminderNotification extends Notification implements ShouldQueue
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
        $startDate = $this->rental->start_time->format('d/m/Y H:i');
        
        return (new MailMessage)
            ->subject('Il tuo noleggio inizia a breve')
            ->greeting('Gentile ' . $notifiable->name)
            ->line("Ti ricordiamo che il tuo noleggio del veicolo $vehicleModel inizia il $startDate.")
            ->line("Ti aspettiamo presso la nostra sede per consegnarti le chiavi.")
            ->action('Visualizza Dettaglio Noleggio', route('user.rentals.show', $this->rental))
            ->line('Se hai bisogno di assistenza, non esitare a contattarci.');
    }
}