<?php

use Illuminate\Database\Seeder;
use App\PersonLog;
use App\Person;

class LogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $persons = Person::get();
        foreach($persons as $person) {
            PersonLog::create([
                'person_id'        => $person->id,
                'location'         => 'Tandag City Jolibee',
                'body_temperature' => 36.4,
                'time'             => Carbon\Carbon::now(),
            ]);
        }
    }
}
