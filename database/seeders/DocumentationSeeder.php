<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Documentation;

class DocumentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentations = [
            [
                'title' => 'Touring Bandung 2024',
                'description' => 'Dokumentasi touring ke Bandung bersama 25 member BOI Bekasi. Perjalanan 2 hari 1 malam dengan rute Bekasi-Bandung-Lembang.',
                'type' => 'touring',
                'date' => '2024-12-15',
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=TOURING+BANDUNG',
                'video_url' => 'https://youtube.com/watch?v=example1',
                'event_id' => null,
                'views' => 125,
                'status' => 'published',
                'photographer' => 'Eko Prasetyo',
                'tags' => json_encode(['touring', 'bandung', '2024', 'weekend'])
            ],
            [
                'title' => 'Kopdar Anniversary BOI',
                'description' => 'Perayaan anniversary ke-3 BOI Bekasi dengan 50+ member. Acara berlangsung meriah dengan doorprize dan penampilan musik.',
                'type' => 'event',
                'date' => '2024-11-20',
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=ANNIVERSARY+BOI',
                'video_url' => 'https://youtube.com/watch?v=example2',
                'event_id' => null,
                'views' => 89,
                'status' => 'published',
                'photographer' => 'Galih Pratama',
                'tags' => json_encode(['anniversary', 'kopdar', 'celebration', '2024'])
            ],
            [
                'title' => 'Sunmori Ancol',
                'description' => 'Sunday morning ride santai ke Ancol. Menikmati sunrise dan sarapan bersama di tepi pantai Jakarta.',
                'type' => 'sunmori',
                'date' => '2024-10-27',
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=SUNMORI+ANCOL',
                'video_url' => null,
                'event_id' => null,
                'views' => 67,
                'status' => 'published',
                'photographer' => 'Fajar Nugroho',
                'tags' => json_encode(['sunmori', 'ancol', 'sunrise', 'jakarta'])
            ],
            [
                'title' => 'Baksos Banjir Jakarta',
                'description' => 'Kegiatan bakti sosial membantu korban banjir Jakarta. BOI Bekasi menyalurkan bantuan dan tenaga untuk membantu sesama.',
                'type' => 'baksos',
                'date' => '2024-09-10',
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=BAKSOS+BANJIR',
                'video_url' => 'https://youtube.com/watch?v=example3',
                'event_id' => null,
                'views' => 156,
                'status' => 'published',
                'photographer' => 'Budi Santoso',
                'tags' => json_encode(['baksos', 'banjir', 'jakarta', 'bantuan'])
            ],
            [
                'title' => 'Touring Yogyakarta',
                'description' => 'Touring kemerdekaan ke Yogyakarta dan sekitarnya. Mengunjungi Candi Borobudur, Malioboro, dan kuliner khas Jogja.',
                'type' => 'touring',
                'date' => '2024-08-17',
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=TOURING+JOGJA',
                'video_url' => 'https://youtube.com/watch?v=example4',
                'event_id' => null,
                'views' => 198,
                'status' => 'published',
                'photographer' => 'Dedi Kurniawan',
                'tags' => json_encode(['touring', 'yogyakarta', 'kemerdekaan', 'budaya'])
            ],
            [
                'title' => 'Workshop Safety Riding',
                'description' => 'Workshop safety riding bersama instruktur bersertifikat. Materi meliputi teknik berkendara aman dan perawatan motor.',
                'type' => 'workshop',
                'date' => '2024-07-22',
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=SAFETY+RIDING',
                'video_url' => null,
                'event_id' => null,
                'views' => 78,
                'status' => 'published',
                'photographer' => 'Candra Wijaya',
                'tags' => json_encode(['workshop', 'safety', 'riding', 'edukasi'])
            ],
            [
                'title' => 'Kopdar Ramadan 2024',
                'description' => 'Kopdar spesial bulan Ramadan dengan agenda buka puasa bersama dan sharing pengalaman spiritual.',
                'type' => 'event',
                'date' => '2024-04-05',
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=KOPDAR+RAMADAN',
                'video_url' => null,
                'event_id' => null,
                'views' => 92,
                'status' => 'published',
                'photographer' => 'Ahmad Rizki',
                'tags' => json_encode(['kopdar', 'ramadan', 'bukber', 'spiritual'])
            ],
            [
                'title' => 'Touring Pantai Selatan',
                'description' => 'Eksplorasi pantai-pantai selatan Jawa Barat. Mengunjungi Pantai Pelabuhan Ratu dan sekitarnya.',
                'type' => 'touring',
                'date' => '2024-06-30',
                'image' => 'https://via.placeholder.com/400x300/22c55e/ffffff?text=PANTAI+SELATAN',
                'video_url' => 'https://youtube.com/watch?v=example5',
                'event_id' => null,
                'views' => 134,
                'status' => 'published',
                'photographer' => 'Hendra Saputra',
                'tags' => json_encode(['touring', 'pantai', 'selatan', 'alam'])
            ]
        ];

        foreach ($documentations as $doc) {
            Documentation::create($doc);
        }
    }
}
