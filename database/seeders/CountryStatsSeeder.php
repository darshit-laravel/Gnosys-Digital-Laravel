<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountryStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = public_path('assets/json/countries-states-cities.json');

        if (!File::exists($path)) {
            return;
        }

        $json = File::get($path);
        $countriesData = json_decode($json, true);

        $data = collect($countriesData)->map(function ($country) {

            return [
                'id' => $country['id'],
                'name' => $country['name'],
                'iso3' => $country['iso3'],
                'iso2' => $country['iso2'],
                'currency' => $country['currency'],
                'currency_name' => $country['currency_name'],
                'currency_symbol' => $country['currency_symbol'],
                'region' => $country['region'],

                'states' => collect($country['states'])->map(function ($state) {

                    return [
                        'id' => $state['id'],
                        'name' => $state['name'],
                        'iso2' => $state['iso2'],
                        'iso3' => $state['iso3166_2'],
                    ];

                })->values()->toArray(),
            ];

        })->toArray();

        foreach ($data as $countryData) {

            $country = Country::create([
                'name' => $countryData['name'],
                'iso3' => $countryData['iso3'],
                'iso2' => $countryData['iso2'],
                'currency' => $countryData['currency'],
                'currency_name' => $countryData['currency_name'],
                'currency_symbol' => $countryData['currency_symbol'],
                'region' => $countryData['region'],
            ]);

            $states = collect($countryData['states'])->map(function ($stateData) use ($country) {

                return [
                    'country_id' => $country->id,
                    'name' => $stateData['name'],
                    'iso2' => $stateData['iso2'],
                    'iso3' => $stateData['iso3'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

            })->toArray();

            State::insert($states);
        }
    }
}
