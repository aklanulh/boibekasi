<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Holiday;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Get current month and year from request or use current date
        $currentMonth = $request->get('month', date('n'));
        $currentYear = $request->get('year', date('Y'));

        // Ambil data event dari database untuk bulan yang dipilih
        $query = Event::whereIn('status', ['upcoming', 'ongoing'])
            ->whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->orderBy('date', 'asc');

        // Filter berdasarkan tipe event jika ada
        if ($request->has('type') && $request->type != 'all') {
            $query->where('type', $request->type);
        }

        $events = $query->get();

        // Ambil semua events untuk calendar view (support multiple events per day)
        $allEvents = Event::whereIn('status', ['upcoming', 'ongoing'])
            ->whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->get()
            ->groupBy(function ($event) {
                return Carbon::parse($event->date)->format('j');
            });

        // Ambil hari libur nasional untuk bulan ini
        $holidays = Holiday::getByMonth($currentYear, $currentMonth);



        // Ambil daftar tipe event yang unik dari database
        $eventTypes = Event::whereIn('status', ['upcoming', 'ongoing'])
            ->distinct()
            ->pluck('type')
            ->filter()
            ->sort()
            ->values()
            ->toArray();

        // Generate calendar data
        $calendarData = $this->generateCalendar($currentMonth, $currentYear, $allEvents, $holidays);

        return view('events', compact('events', 'eventTypes', 'calendarData', 'currentMonth', 'currentYear', 'holidays'));
    }

    private function generateCalendar($month, $year, $events, $holidays = null)
    {
        $firstDay = Carbon::create($year, $month, 1);
        $lastDay = $firstDay->copy()->endOfMonth();
        $startOfWeek = $firstDay->copy()->startOfWeek(Carbon::SUNDAY);
        $endOfWeek = $lastDay->copy()->endOfWeek(Carbon::SATURDAY);

        $calendar = [];
        $current = $startOfWeek->copy();

        while ($current <= $endOfWeek) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $day = $current->format('j');
                $isCurrentMonth = $current->month == $month;
                $dayEvents = $isCurrentMonth && isset($events[$day]) ? $events[$day] : collect();
                $dayHolidays = $isCurrentMonth && $holidays && isset($holidays[$day]) ? $holidays[$day] : collect();
                $hasEvents = $dayEvents->count() > 0;
                $hasHolidays = $dayHolidays->count() > 0;

                $week[] = [
                    'day' => $day,
                    'date' => $current->format('Y-m-d'),
                    'isCurrentMonth' => $isCurrentMonth,
                    'events' => $dayEvents,
                    'holidays' => $dayHolidays,
                    'hasEvents' => $hasEvents,
                    'hasHolidays' => $hasHolidays,
                    'eventCount' => $dayEvents->count(),
                    'holidayCount' => $dayHolidays->count()
                ];

                $current->addDay();
            }
            $calendar[] = $week;
        }

        return [
            'weeks' => $calendar,
            'monthName' => $firstDay->format('F Y'),
            'prevMonth' => $firstDay->copy()->subMonth(),
            'nextMonth' => $firstDay->copy()->addMonth()
        ];
    }
}
