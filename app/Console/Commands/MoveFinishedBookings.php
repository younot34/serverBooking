<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\History;
use Carbon\Carbon;

class MoveFinishedBookings extends Command
{
    protected $signature = 'bookings:move-finished';
    protected $description = 'Pindahkan booking yang sudah selesai ke tabel history';

    public function handle()
    {
        $now = Carbon::now();

        $finishedBookings = Booking::all()->filter(function ($b) use ($now) {
            $endTime = Carbon::parse("{$b->date} {$b->time}")
                        ->addMinutes((int) $b->duration);
            return $endTime->isPast();
        });

        foreach ($finishedBookings as $booking) {
            History::create($booking->toArray());
            $booking->delete();
        }

        $this->info(count($finishedBookings) . ' booking(s) moved to history.');
    }
}
