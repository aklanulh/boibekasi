<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Holiday
{
    /**
     * Data hari libur nasional Indonesia 2025
     */
    private static array $holidays2025 = [
        [
            'name' => 'Hari Kemerdekaan Republik Indonesia',
            'date' => '2025-08-17',
            'type' => 'national',
            'description' => 'Hari kemerdekaan Indonesia yang ke-80'
        ],
        [
            'name' => 'Maulid Nabi Muhammad SAW',
            'date' => '2025-09-05',
            'type' => 'religious',
            'description' => 'Hari kelahiran Nabi Muhammad SAW'
        ],
        [
            'name' => 'Hari Raya Natal',
            'date' => '2025-12-25',
            'type' => 'religious',
            'description' => 'Hari Raya Natal umat Kristiani'
        ],
        [
            'name' => 'Cuti Bersama Hari Raya Natal',
            'date' => '2025-12-26',
            'type' => 'cuti_bersama',
            'description' => 'Cuti bersama setelah Hari Raya Natal'
        ]
    ];

    /**
     * Mendapatkan semua hari libur untuk tahun tertentu
     */
    public static function getByYear(int $year): Collection
    {
        $holidays = match ($year) {
            2025 => self::$holidays2025,
            default => []
        };

        return collect($holidays)->map(function ($holiday) {
            return (object) [
                'name' => $holiday['name'],
                'date' => Carbon::parse($holiday['date']),
                'type' => $holiday['type'],
                'description' => $holiday['description'],
                'type_color' => self::getTypeColor($holiday['type']),
                'type_label' => self::getTypeLabel($holiday['type']),
                'formatted_date' => Carbon::parse($holiday['date'])->locale('id')->isoFormat('dddd, D MMMM YYYY')
            ];
        });
    }

    /**
     * Mendapatkan hari libur untuk bulan tertentu
     */
    public static function getByMonth(int $year, int $month): Collection
    {
        return self::getByYear($year)
            ->filter(fn($holiday) => $holiday->date->month === $month)
            ->groupBy(fn($holiday) => $holiday->date->format('j'));
    }

    /**
     * Cek apakah tanggal tertentu adalah hari libur
     */
    public static function isHoliday(Carbon $date): bool
    {
        return self::getByYear($date->year)
            ->contains(function ($holiday) use ($date) {
                return $holiday->date->isSameDay($date);
            });
    }

    /**
     * Mendapatkan info hari libur untuk tanggal tertentu
     */
    public static function getHolidayInfo(Carbon $date): ?object
    {
        return self::getByYear($date->year)
            ->first(function ($holiday) use ($date) {
                return $holiday->date->isSameDay($date);
            });
    }

    /**
     * Mendapatkan warna berdasarkan tipe
     */
    private static function getTypeColor(string $type): string
    {
        return match ($type) {
            'national' => '#dc3545', // Merah untuk hari nasional
            'religious' => '#28a745', // Hijau untuk hari keagamaan
            'regional' => '#007bff', // Biru untuk hari regional
            'cuti_bersama' => '#ffc107', // Kuning untuk cuti bersama
            default => '#6c757d'
        };
    }

    /**
     * Mendapatkan label tipe
     */
    private static function getTypeLabel(string $type): string
    {
        return match ($type) {
            'national' => 'Hari Nasional',
            'religious' => 'Hari Keagamaan',
            'regional' => 'Hari Regional',
            'cuti_bersama' => 'Cuti Bersama',
            default => 'Lainnya'
        };
    }

    /**
     * Mendapatkan semua hari libur dalam format calendar events
     */
    public static function getCalendarEvents(int $year): array
    {
        return self::getByYear($year)->map(function ($holiday) {
            return [
                'title' => $holiday->name,
                'start' => $holiday->date->format('Y-m-d'),
                'color' => $holiday->type_color,
                'description' => $holiday->description,
                'type' => $holiday->type_label,
                'allDay' => true,
                'className' => 'holiday-event'
            ];
        })->toArray();
    }
}
