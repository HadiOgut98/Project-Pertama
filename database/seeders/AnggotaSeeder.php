<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('anggotas')->insert([
            'nama' => 'HadiOgut',
            'jenis_kelamin' => 'cowo',
            'no_telp' => '085773501560',
            'alamat' => 'Kp Surianeun'
        ]);
    }
}
