<?php

use Illuminate\Database\Seeder;
use App\City;
use App\Barangay;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = glob('C:\xampp\htdocs\capitol_app\public\data-need\cities\municipal.csv');
        $data = file_get_contents($data[0]);
        $data = array_filter(explode("\n", $data));

        foreach($data as $city) {
            list($province_code, $code, $name, $type, $classification, $ruralOrUrban, $population) = explode(",", $city);

            City::create([
                'province_code'         => $province_code,
                'code'                  => $code,
                'name'                  => (string) $name,
                'income_classification' => $classification,
                'population'            => str_replace("\r", "", $population)
            ]);
        }

    }
}
