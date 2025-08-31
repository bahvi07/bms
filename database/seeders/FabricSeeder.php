<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fabric;

class FabricSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data (optional, prevents duplicates)
        Fabric::truncate();

        // Insert predefined fabric data
        $fabrics = [
            ['fabric' => 'Cotton', 'description' => 'Soft, breathable, and versatile natural fabric.'],
            ['fabric' => 'Linen', 'description' => 'Lightweight, breathable fabric made from flax.'],
            ['fabric' => 'Silk', 'description' => 'Luxurious, smooth fabric with a natural sheen.'],
            ['fabric' => 'Wool', 'description' => 'Warm, insulating fabric from sheep fleece.'],
            ['fabric' => 'Denim', 'description' => 'Durable cotton fabric, commonly used for jeans.'],
            ['fabric' => 'Velvet', 'description' => 'Soft, plush fabric with a dense pile.'],
            ['fabric' => 'Polyester', 'description' => 'Strong, wrinkle-resistant synthetic fabric.'],
            ['fabric' => 'Rayon', 'description' => 'Semi-synthetic fabric that mimics silk.'],
            ['fabric' => 'Chiffon', 'description' => 'Lightweight, sheer fabric with a flowy drape.'],
            ['fabric' => 'Tweed', 'description' => 'Rough, woolen fabric often used in jackets.'],
        ];

        Fabric::insert($fabrics);
    }
}
