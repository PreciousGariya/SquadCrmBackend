<?php

use Illuminate\Database\Seeder;

/**
 * GeoNames Gazetteer importer
 * Queries http://www.geonames.org/childrenJSON?geonameId={LOCATIONCODE}&callback=listPlaces&style=long
 * and import it into the Coutries, States and Cities for each continent
 *
 * Continent (highest level) codes
 * 6255146 - Africa
 * 6255147 - Asia
 * 6255148 - Europe
 * 6255149 - North America
 * 6255150 - South America
 * 6255151 - Oceania
 * 6255152 - Antarctica
 *
 * fcode list
 * PCL* = Country
 * ADM1 = State / Province
 * ADM2 = County / Region
 * PPL* = City / Village
 */
class CountryStateCitySeeder extends Seeder
{
    /**
     * URL to retrieve data from
     */
    protected $url = "http://www.geonames.org/childrenJSON?geonameId={LOCATION_CODE}&style=short&username={USERNAME}";

    protected $username = ['demo', 'asdf', 'qwer', 'zxcv', 'sadf', 'wqer', 'xzcv', 'vcxz', 'fdsa', 'rewq', 'mode'];

    protected $currUserIndex = 0;

    /**
     * Continent codes (continents are not imported)
     */
    protected $contCodes = [
        //6255146, // Africa
        //6255147, // Asia
        6255148, // Europe
        //6255149, // North America
        //6255150, // South America
        //6255151, // Oceania
        //6255152, // Antarctica
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ds       = DIRECTORY_SEPARATOR;
        $path     = base_path() . $ds .
            'database' . $ds .
            'seeds' . $ds .
            'data' . $ds;
        $filename = $path . 'geonames_gazeteer.tgz';
        if (file_exists($filename)) {
            exec('tar -zxvf ' . $filename . ' -C ' . $path);
            sleep(10);
        }

        foreach ($this->contCodes as $code) {
            $countries = $this->getList($code, 'country');
            if (isset($countries->geonames)) {
                foreach ($countries->geonames as $country) {

                    try {
                        $countryDb            = new \App\Models\Country();
                        $countryDb->id        = $country->geonameId;
                        $countryDb->name      = $country->name;
                        $countryDb->latitude  = $country->lat;
                        $countryDb->longitude = $country->lng;
                        $countryDb->code      = $country->countryCode;
                        $countryDb->save();
                    } catch (\Exception $e) {
                    };

                    echo "Added country " . $country->name . "\n";

                    $states = $this->getList($country->geonameId, 'state');
                    if (isset($states->geonames)) {
                        foreach ($states->geonames as $state) {

                            try {
                                if (strstr($state->fcode, 'PPL')) {
                                    $stateDb = new \App\Models\City();
                                } else {
                                    $stateDb = new \App\Models\State();
                                }
                                $stateDb->id         = $state->geonameId;
                                $stateDb->name       = $state->name;
                                $stateDb->latitude   = $state->lat;
                                $stateDb->longitude  = $state->lng;
                                $stateDb->country_id = $countryDb->id;
                                $stateDb->save();
                            } catch (\Exception $e) {
                            };

                            if (strstr($state->fcode, 'PPL')) {
                                echo "Added city " . $state->name . " into country " . $country->name . "\n";
                            } else {
                                echo "Added state " . $state->name . " into country " . $country->name . "\n";
                            }

                            $regions = $this->getList($state->geonameId, 'region');
                            if (isset($regions->geonames)) {
                                foreach ($regions->geonames as $region) {

                                    try {
                                        if (strstr($region->fcode, 'PPL')) {
                                            $regionDb = new \App\Models\City();
                                        } else {
                                            $regionDb = new \App\Models\Region();
                                        }
                                        $regionDb->id         = $region->geonameId;
                                        $regionDb->name       = $region->name;
                                        $regionDb->latitude   = $region->lat;
                                        $regionDb->longitude  = $region->lng;
                                        $regionDb->state_id   = $stateDb->id;
                                        $regionDb->country_id = $countryDb->id;
                                        $regionDb->save();
                                    } catch (\Exception $e) {
                                    };

                                    if (strstr($region->fcode, 'PPL')) {
                                        echo "Added city " . $region->name . " into state " . $state->name . " into country " . $country->name . "\n";
                                    } else {
                                        echo "Added region " . $region->name . " into state " . $state->name . " into country " . $country->name . "\n";
                                    }

                                    $cities = $this->getList($region->geonameId, 'city');

                                    if (isset($cities->geonames)) {
                                        foreach ($cities->geonames as $city) {

                                            echo "Added city " . $city->name . " into region " . $region->name . " state " . $state->name . " into country " . $country->name . "\n";

                                            try {
                                                $cityDb             = new \App\Models\City();
                                                $cityDb->id         = $city->geonameId;
                                                $cityDb->name       = $city->name;
                                                $cityDb->latitude   = $city->lat;
                                                $cityDb->longitude  = $city->lng;
                                                $cityDb->region_id  = $regionDb->id;
                                                $cityDb->state_id   = $stateDb->id;
                                                $cityDb->country_id = $countryDb->id;
                                                $cityDb->save();
                                            } catch (\Exception $e) {
                                            };
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function getList($code, $type)
    {
        $ds       = DIRECTORY_SEPARATOR;
        $filename = base_path() . $ds .
            'database' . $ds .
            'seeds' . $ds .
            'data' . $ds .
            'geonames.org' . $ds .
            'geonames_gazeteer_'
            . $code
            . '.json';
        if (file_exists($filename)) {
            $places = json_decode(file_get_contents($filename));
        } else {
            $url    = str_replace('{LOCATION_CODE}', $code, $this->url);
            $url    = str_replace('{USERNAME}', $this->username[$this->currUserIndex], $url);
            $places = file_get_contents($url);

            $places = json_decode($places);
            if (isset($places->status) && $places->status->value == 19) {
                $this->currUserIndex++;
                $this->currUserIndex = ($this->currUserIndex < count($this->username)) ? $this->currUserIndex : 0;
                echo "Resting until API is freed again: $url\n";
                return $this->getList($code, $type);
            }

            file_put_contents($filename, json_encode($places));

        }

        return $places;
    }
}