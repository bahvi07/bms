<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StaffRole;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Insert demo data
     

     StaffRole::create([
             'role' => 'Tailor',
                'description' => 'Responsible for sewing garments as per measurements.'
        ]);
       StaffRole::create([
          'role' => 'Master',
                'description' => 'Supervises tailoring staff and ensures quality stitching.'
        ]);
        // Add more roles data as required
        StaffRole::create(
            [
                'role' => 'Stitcher',
                'description' => 'Handles basic stitching and garment assembly tasks.'
            ]);
        StaffRole::create(
            [
                'role' => 'Designer',
                'description' => 'Creates garment patterns and innovative designs.'
            ]);
        StaffRole::create(
            [
                'role' => 'Helper',
                'description' => 'Assists in cutting, arranging, and supporting tailors.'
            ]);
        StaffRole::create(
            [
                'role' => 'Ironman',
                'description' => 'Responsible for ironing and finishing garments before delivery.'
            ]);
 
    }
}
