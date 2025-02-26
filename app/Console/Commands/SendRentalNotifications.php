<?php

namespace App\Console\Commands;

use App\Models\Rental;
use App\Notifications\RentalStartReminderNotification;
use App\Notifications\RentalEndingNotification;
use App\Notifications\RentalExpiredNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendRentalNotifications extends Command
{
    protected $signature = 'rentals:send-notifications';
    protected $description = 'Invia notifiche per i noleggi in corso, imminenti e scaduti';

    public function handle()
    {
        $this->sendStartReminders();
        $this->sendEndingReminders();
        $this->sendExpiredNotifications();
        
        $this->info('Notifiche inviate con successo.');
    }

    protected function sendStartReminders()
    {
        $tomorrow = Carbon::tomorrow();
        
        $upcomingRentals = Rental::with('user', 'vehicle')
            ->where('status', 'active')
            ->whereBetween('start_time', [
                $tomorrow->copy()->startOfDay(),
                $tomorrow->copy()->endOfDay()
            ])
            ->get();
            
        foreach ($upcomingRentals as $rental) {
            $rental->user->notify(new RentalStartReminderNotification($rental));
            $this->info("Promemoria inizio inviato per noleggio #{$rental->id}");
        }
    }

    protected function sendEndingReminders()
    {
        $tomorrow = Carbon::tomorrow();
        
        $endingRentals = Rental::with('user', 'vehicle')
            ->where('status', 'active')
            ->whereBetween('end_time', [
                $tomorrow->copy()->startOfDay(),
                $tomorrow->copy()->endOfDay()
            ])
            ->get();
            
        foreach ($endingRentals as $rental) {
            $rental->user->notify(new RentalEndingNotification($rental));
            $this->info("Promemoria fine inviato per noleggio #{$rental->id}");
        }
    }

    protected function sendExpiredNotifications()
    {
        $now = Carbon::now();
        
        $expiredRentals = Rental::with('user', 'vehicle')
            ->where('status', 'active')
            ->where('end_time', '<', $now)
            ->get();
            
        foreach ($expiredRentals as $rental) {
            $rental->user->notify(new RentalExpiredNotification($rental));
            $this->info("Notifica scadenza inviata per noleggio #{$rental->id}");
        }
    }
}
