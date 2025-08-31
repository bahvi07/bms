<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Measurements;

class MeasurementSeeder extends Seeder
{
    public function run()
    {
        
        $measurements = [
            ['label' => 'Neck', 'description' => 'Around the base of the neck', 'unit' => 'inch'],
            ['label' => 'Sleeve', 'description' => 'Length from shoulder to wrist', 'unit' => 'inch'],
            ['label' => 'Waist', 'description' => 'Around the narrowest part of the torso', 'unit' => 'inch'],
            ['label' => 'Chest', 'description' => 'Around the fullest part of the chest', 'unit' => 'inch'],
            ['label' => 'Shoulder', 'description' => 'Width from one shoulder tip to another', 'unit' => 'inch'],
            ['label' => 'Hip', 'description' => 'Around the fullest part of hips', 'unit' => 'inch'],
            ['label' => 'Length', 'description' => 'Full garment length from shoulder to hem', 'unit' => 'inch'],
            ['label' => 'Bicep', 'description' => 'Around the widest part of the upper arm', 'unit' => 'inch'],
            ['label' => 'Cuff', 'description' => 'Around the wrist/arm opening', 'unit' => 'inch'],
            ['label' => 'Back Width', 'description' => 'Distance across back from one armhole to another', 'unit' => 'inch'],
        ];

        Measurements::insert($measurements);
    }
}
