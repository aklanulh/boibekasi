<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;
use Carbon\Carbon;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Ahmad Rizki Pratama',
                'email' => 'ahmad.rizki@email.com',
                'nrp' => 'BOI-BKS-001',
                'phone' => '081234567890',
                'bike_type' => 'Benelli TNT 135',
                'bike_year' => '2023',
                'bike_color' => 'Hitam',
                'photo' => 'https://via.placeholder.com/150x150/22c55e/ffffff?text=AR',
                'join_date' => '2023-01-15',
                'status' => 'active',
                'address' => 'Jl. Raya Bekasi Timur No. 123, Bekasi',
                'notes' => 'Member aktif, sering ikut touring'
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'nrp' => 'BOI-BKS-002',
                'phone' => '081234567891',
                'bike_type' => 'Benelli Leoncino 250',
                'bike_year' => '2022',
                'bike_color' => 'Putih',
                'photo' => 'https://via.placeholder.com/150x150/22c55e/ffffff?text=BS',
                'join_date' => '2023-03-20',
                'status' => 'active',
                'address' => 'Jl. Ahmad Yani No. 456, Bekasi Selatan',
                'notes' => 'Koordinator kegiatan baksos'
            ],
            [
                'name' => 'Candra Wijaya',
                'email' => 'candra.wijaya@email.com',
                'nrp' => 'BOI-BKS-003',
                'phone' => '081234567892',
                'bike_type' => 'Benelli TRK 251',
                'bike_year' => '2023',
                'bike_color' => 'Merah',
                'photo' => 'https://via.placeholder.com/150x150/22c55e/ffffff?text=CW',
                'join_date' => '2023-05-10',
                'status' => 'active',
                'address' => 'Jl. Veteran No. 789, Bekasi Utara',
                'notes' => 'Ahli mekanik, sering bantu workshop'
            ],
            [
                'name' => 'Dedi Kurniawan',
                'email' => 'dedi.kurniawan@email.com',
                'nrp' => 'BOI-BKS-004',
                'phone' => '081234567893',
                'bike_type' => 'Benelli TNT 600i',
                'bike_year' => '2021',
                'bike_color' => 'Biru',
                'photo' => 'https://via.placeholder.com/150x150/22c55e/ffffff?text=DK',
                'join_date' => '2023-07-05',
                'status' => 'active',
                'address' => 'Jl. Sudirman No. 321, Bekasi Barat',
                'notes' => 'Leader touring jarak jauh'
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@email.com',
                'nrp' => 'BOI-BKS-005',
                'phone' => '081234567894',
                'bike_type' => 'Benelli Imperiale 400',
                'bike_year' => '2022',
                'bike_color' => 'Hijau',
                'photo' => 'https://via.placeholder.com/150x150/22c55e/ffffff?text=EP',
                'join_date' => '2023-09-12',
                'status' => 'active',
                'address' => 'Jl. Diponegoro No. 654, Bekasi',
                'notes' => 'Fotografer dokumentasi kegiatan'
            ],
            [
                'name' => 'Fajar Nugroho',
                'email' => 'fajar.nugroho@email.com',
                'nrp' => 'BOI-BKS-006',
                'phone' => '081234567895',
                'bike_type' => 'Benelli TNT 135',
                'bike_year' => '2023',
                'bike_color' => 'Kuning',
                'photo' => 'https://via.placeholder.com/150x150/22c55e/ffffff?text=FN',
                'join_date' => '2023-11-08',
                'status' => 'active',
                'address' => 'Jl. Gatot Subroto No. 987, Bekasi',
                'notes' => 'Member baru, antusias tinggi'
            ],
            [
                'name' => 'Galih Pratama',
                'email' => 'galih.pratama@email.com',
                'nrp' => 'BOI-BKS-007',
                'phone' => '081234567896',
                'bike_type' => 'Benelli Leoncino 500',
                'bike_year' => '2023',
                'bike_color' => 'Silver',
                'photo' => 'https://via.placeholder.com/150x150/22c55e/ffffff?text=GP',
                'join_date' => '2024-01-20',
                'status' => 'active',
                'address' => 'Jl. Pahlawan No. 147, Bekasi',
                'notes' => 'Spesialis modifikasi motor'
            ],
            [
                'name' => 'Hendra Saputra',
                'email' => 'hendra.saputra@email.com',
                'nrp' => 'BOI-BKS-008',
                'phone' => '081234567897',
                'bike_type' => 'Benelli TNT 300',
                'bike_year' => '2022',
                'bike_color' => 'Hitam',
                'photo' => 'https://via.placeholder.com/150x150/22c55e/ffffff?text=HS',
                'join_date' => '2024-03-15',
                'status' => 'active',
                'address' => 'Jl. Merdeka No. 258, Bekasi',
                'notes' => 'Koordinator merchandise'
            ]
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
