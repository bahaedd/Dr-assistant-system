<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            'name' => 'John Doe',
            'email' => 'JohnDoe@gmail.com',
            'gender' => 'homme',
            'birthday' => now(),
            'phone' => '064569873',
            'adress' => 'Adress',
            'image' => '/storage/image'
        ]);
    }
}
