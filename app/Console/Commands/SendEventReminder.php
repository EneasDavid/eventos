<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventReminder;

class SendEventReminder extends Command
{
    protected $signature = 'send:event-reminder';
    protected $description = 'Send email reminders for upcoming events';

    public function handle()
    {
        $events = Event::whereDate('event_date', now()->addDay())->get();

        foreach ($events as $event) {
            Mail::to($event->organizer_email)->send(new EventReminder($event));
            $this->info("Event reminder sent for event ID {$event->id}.");
        }

        $this->info('Event reminders sent successfully.');
    }
}
