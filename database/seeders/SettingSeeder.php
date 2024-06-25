<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->truncate();
        Setting::updateOrCreate([ 'id' => 1 ], [
            'app_name'    => 'IMJOL',
            'favicon' => asset('favicon.ico'),
            'logo'    => asset('assets/img/logo.png'),
            'colors'  => [
                'primary'=> [
                    "h"=>211,
                    "s"=>100,
                    "l"=>50
                ]
            ],
         ]);
    }
}
