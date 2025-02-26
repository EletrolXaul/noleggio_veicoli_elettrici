<?php

namespace App\Notifications;

use App\Models\Rental;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentalConfirmationNotification extends Notification implements ShouldQueue
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
        $endDate = $this->rental->end_time->format('d/m/Y H:i');
        
        return (new MailMessage)
            ->subject('Conferma Prenotazione Veicolo')
            ->greeting('Gentile ' . $notifiable->name)
            ->line("La tua prenotazione per il veicolo $vehicleModel è stata confermata.")
            ->line("Periodo di noleggio: dal $startDate al $endDate")
            ->line("Costo totale: €{$this->rental->total_cost}")
            ->action('Visualizza Dettagli', route('user.rentals.show', $this->rental))
            ->line('Grazie per aver scelto il nostro servizio!');
    }
}