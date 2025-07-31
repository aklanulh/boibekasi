<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            // July 2025 Events
            [
                'title' => 'Sunmori Pantai Ancol',
                'description' => 'Sunday Morning Ride ke Pantai Ancol. Menikmati sunrise dan sarapan bersama di tepi pantai.',
                'date' => '2025-07-27',
                'time' => '05:30:00',
                'location' => 'Start: Bekasi - Finish: Ancol',
                'type' => 'sunmori',
                'max_participants' => 25,
                'registered_participants' => 15,
                'status' => 'upcoming',
                'contact_person' => 'Fajar Nugroho',
                'contact_phone' => '081234567895',
                'requirements' => 'Bangun pagi, motor siap, semangat tinggi',
                'fee' => 25000,
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=SUNMORI+ANCOL'
            ],
            [
                'title' => 'Workshop Safety Riding',
                'description' => 'Workshop keselamatan berkendara untuk meningkatkan awareness dan skill riding yang aman.',
                'date' => '2025-07-30',
                'time' => '14:00:00',
                'location' => 'Bengkel Benelli Bekasi',
                'type' => 'workshop',
                'max_participants' => 20,
                'registered_participants' => 8,
                'status' => 'upcoming',
                'contact_person' => 'Candra Wijaya',
                'contact_phone' => '081234567892',
                'requirements' => 'Membawa motor, helm SNI, alat tulis',
                'fee' => 15000,
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=SAFETY+RIDING'
            ],
            
            // August 2025 Events
            [
                'title' => 'Kopdar Rutin BOI Bekasi',
                'description' => 'Kopi darat rutin bulanan untuk semua member BOI Bekasi. Agenda: sharing pengalaman, koordinasi kegiatan mendatang, dan mempererat silaturahmi.',
                'date' => '2025-08-02',
                'time' => '19:00:00',
                'location' => 'Cafe Rider, Bekasi Timur',
                'type' => 'kopdar',
                'max_participants' => 50,
                'registered_participants' => 25,
                'status' => 'upcoming',
                'contact_person' => 'Ahmad Rizki',
                'contact_phone' => '081234567890',
                'requirements' => 'Membawa motor Benelli, berpakaian rapi',
                'fee' => null,
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=KOPDAR+BOI'
            ],
            [
                'title' => 'Touring Puncak Pass',
                'description' => 'Touring santai ke Puncak Pass dengan rute scenic melalui Bogor. Nikmati pemandangan indah pegunungan dan udara sejuk.',
                'date' => '2025-08-10',
                'time' => '06:00:00',
                'location' => 'Start: Bekasi - Finish: Puncak',
                'type' => 'touring',
                'max_participants' => 30,
                'registered_participants' => 18,
                'status' => 'upcoming',
                'contact_person' => 'Dedi Kurniawan',
                'contact_phone' => '081234567893',
                'requirements' => 'Motor dalam kondisi prima, helm SNI, jaket touring, bensin full tank',
                'fee' => 50000,
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=TOURING+PUNCAK'
            ],
            [
                'title' => 'Bakti Sosial Anak Yatim',
                'description' => 'Kegiatan bakti sosial dalam rangka HUT RI ke-80. Memberikan bantuan dan menghibur anak-anak di panti asuhan.',
                'date' => '2025-08-17',
                'time' => '08:00:00',
                'location' => 'Panti Asuhan Harapan, Bekasi',
                'type' => 'baksos',
                'max_participants' => 40,
                'registered_participants' => 35,
                'status' => 'upcoming',
                'contact_person' => 'Budi Santoso',
                'contact_phone' => '081234567891',
                'requirements' => 'Membawa donasi (uang/barang), berpakaian sopan',
                'fee' => null,
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=BAKSOS+BOI'
            ],
            [
                'title' => 'Workshop Maintenance Motor',
                'description' => 'Workshop perawatan dan maintenance motor Benelli. Dipandu oleh mekanik berpengalaman dari bengkel resmi.',
                'date' => '2025-08-24',
                'time' => '14:00:00',
                'location' => 'Bengkel Benelli Bekasi',
                'type' => 'workshop',
                'max_participants' => 20,
                'registered_participants' => 12,
                'status' => 'upcoming',
                'contact_person' => 'Candra Wijaya',
                'contact_phone' => '081234567892',
                'requirements' => 'Membawa motor, buku manual, alat tulis',
                'fee' => 25000,
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=WORKSHOP+BOI'
            ],
            [
                'title' => 'Sunmori Pantai Indah Kapuk',
                'description' => 'Sunday Morning Ride ke Pantai Indah Kapuk. Menikmati sunrise dan sarapan bersama di tepi pantai.',
                'date' => '2025-08-31',
                'time' => '05:30:00',
                'location' => 'Start: Bekasi - Finish: PIK',
                'type' => 'sunmori',
                'max_participants' => 25,
                'registered_participants' => 8,
                'status' => 'upcoming',
                'contact_person' => 'Fajar Nugroho',
                'contact_phone' => '081234567895',
                'requirements' => 'Bangun pagi, motor siap, semangat tinggi',
                'fee' => 30000,
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=SUNMORI+PIK'
            ],
            [
                'title' => 'Anniversary BOI Bekasi ke-4',
                'description' => 'Perayaan anniversary ke-4 BOI Bekasi dengan berbagai acara menarik, doorprize, dan penampilan musik.',
                'date' => '2025-09-15',
                'time' => '16:00:00',
                'location' => 'Lapangan Bekasi Utara',
                'type' => 'kopdar',
                'max_participants' => 100,
                'registered_participants' => 45,
                'status' => 'upcoming',
                'contact_person' => 'Galih Pratama',
                'contact_phone' => '081234567896',
                'requirements' => 'Member BOI Bekasi, berpakaian rapi',
                'fee' => null,
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=ANNIVERSARY+BOI'
            ]
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
