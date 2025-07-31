<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Merchandise;

class MerchandiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merchandise = [
            [
                'name' => 'Kaos BOI Bekasi Official',
                'description' => 'Kaos resmi BOI Bekasi dengan logo komunitas. Bahan cotton combed 30s yang nyaman dan berkualitas tinggi.',
                'price' => 150000,
                'image' => 'https://via.placeholder.com/300x300/000000/22c55e?text=KAOS+BOI',
                'category' => 'kaos',
                'stock' => 50,
                'status' => 'available',
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'colors' => json_encode(['Hitam', 'Putih', 'Hijau'])
            ],
            [
                'name' => 'Jaket Touring BOI Bekasi',
                'description' => 'Jaket touring berkualitas tinggi untuk perjalanan jauh. Tahan angin dan air, dilengkapi dengan reflector untuk keamanan.',
                'price' => 350000,
                'image' => 'https://via.placeholder.com/300x300/000000/22c55e?text=JAKET+BOI',
                'category' => 'jaket',
                'stock' => 25,
                'status' => 'available',
                'sizes' => json_encode(['M', 'L', 'XL', 'XXL']),
                'colors' => json_encode(['Hitam', 'Hijau Army'])
            ],
            [
                'name' => 'Stiker BOI Bekasi Set',
                'description' => 'Set stiker waterproof untuk motor Benelli. Terdiri dari 5 stiker dengan berbagai ukuran dan desain.',
                'price' => 25000,
                'image' => 'https://via.placeholder.com/300x300/000000/22c55e?text=STIKER+BOI',
                'category' => 'stiker',
                'stock' => 100,
                'status' => 'available',
                'sizes' => json_encode(['One Size']),
                'colors' => json_encode(['Full Color'])
            ],
            [
                'name' => 'Topi BOI Bekasi',
                'description' => 'Topi snapback dengan bordir logo BOI Bekasi. Bahan berkualitas dan nyaman digunakan.',
                'price' => 75000,
                'image' => 'https://via.placeholder.com/300x300/000000/22c55e?text=TOPI+BOI',
                'category' => 'topi',
                'stock' => 30,
                'status' => 'available',
                'sizes' => json_encode(['One Size']),
                'colors' => json_encode(['Hitam', 'Hijau', 'Abu-abu'])
            ],
            [
                'name' => 'Tas Ransel BOI Bekasi',
                'description' => 'Tas ransel untuk touring dengan logo BOI Bekasi. Kapasitas 25L dengan banyak kantong dan tahan air.',
                'price' => 250000,
                'image' => 'https://via.placeholder.com/300x300/000000/22c55e?text=TAS+BOI',
                'category' => 'tas',
                'stock' => 15,
                'status' => 'available',
                'sizes' => json_encode(['25L']),
                'colors' => json_encode(['Hitam', 'Hijau Army'])
            ],
            [
                'name' => 'Gantungan Kunci BOI',
                'description' => 'Gantungan kunci metal dengan logo BOI Bekasi. Desain elegan dan tahan lama.',
                'price' => 15000,
                'image' => 'https://via.placeholder.com/300x300/000000/22c55e?text=GANCI+BOI',
                'category' => 'aksesoris',
                'stock' => 75,
                'status' => 'available',
                'sizes' => json_encode(['One Size']),
                'colors' => json_encode(['Silver', 'Gold'])
            ],
            [
                'name' => 'Masker BOI Bekasi',
                'description' => 'Masker kain dengan logo BOI Bekasi. Bahan katun yang nyaman dan dapat dicuci ulang.',
                'price' => 35000,
                'image' => 'https://via.placeholder.com/300x300/000000/22c55e?text=MASKER+BOI',
                'category' => 'aksesoris',
                'stock' => 40,
                'status' => 'available',
                'sizes' => json_encode(['One Size']),
                'colors' => json_encode(['Hitam', 'Hijau'])
            ],
            [
                'name' => 'Polo Shirt BOI Bekasi',
                'description' => 'Polo shirt premium dengan logo bordir BOI Bekasi. Cocok untuk acara formal komunitas.',
                'price' => 180000,
                'image' => 'https://via.placeholder.com/300x300/000000/22c55e?text=POLO+BOI',
                'category' => 'kaos',
                'stock' => 20,
                'status' => 'available',
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'colors' => json_encode(['Hitam', 'Hijau', 'Abu-abu'])
            ]
        ];

        foreach ($merchandise as $item) {
            Merchandise::create($item);
        }
    }
}
