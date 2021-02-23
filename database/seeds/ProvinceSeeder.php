<?php

use Illuminate\Database\Seeder;
use App\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $provinces = glob('C:\xampp\htdocs\capitol_app\public\data-need\province\province.csv');
        $provinces = file_get_contents($provinces[0]);
        $provinces = array_filter(explode("\n", $provinces));


        // generate for sqlite database.
        foreach($provinces as $province) {
            list($code, $name, $inter_level, $classification, $urban_or_rural, $population) = explode("|", $province);
            Province::create([
                'code'                  => $code,
                'name'                  => $name,
                'income_classification' => $classification,
                'population'            => str_replace("\r", "", $population),
            ]);
        }


    }
}
