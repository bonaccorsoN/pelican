<?php


// homepage
$app->get('/', function () use ($app) {
    return $app['twig']->render('homepage.html.twig');
})->bind('home');

// assitant
$app->get('/assistant', function () use ($app) {
    return $app['twig']->render('assistant.html.twig');
})->bind('assistant');

// results
$app->post('/results', function (Symfony\Component\HttpFoundation\Request $request) use ($app) {


    /*
     *      0 - Décalaration des variables
     */

    $finder_gender =$request->get('finder_gender');
    $finder_age = $request->get('finder_age');
    $finder_avis = $request->get('finder_avis');
    $finder_distance = $request->get('finder_distance');
    $finder_climat = $request->get('finder_climat');
    $finder_budget = $request->get('finder_budget');

    /*
    var_dump($finder_gender);
    var_dump($finder_age);
    var_dump($finder_avis);
    var_dump($finder_distance);
    var_dump($finder_climat);
    var_dump($finder_budget);
    */

    /*
     *      1 - On récupère les villes des 6 pays les plus attractifs de notre bdd dans un tab
     *          Canada - Portugal - Espagne - Maroc - Thailande - Indonésie
     */

    $bestCities = array();
    $allCities = $app['dao.cityIndice']->findAll();
    foreach ($allCities as $allCities_key => $allCities_value){

        // Getting cities by countries name
        $allCitiesNames = $allCities_value->getcity_name();
        $allCountriesName = explode(',', $allCitiesNames);
        if(count($allCountriesName) > 1){
            if(count($allCountriesName) === 2){
                if($allCountriesName[1] === ' Canada' || $allCountriesName[1] === ' Portugal' || $allCountriesName[1] === ' Spain' || $allCountriesName[1] === ' Morocco' || $allCountriesName[1] === ' Thailand' || $allCountriesName[1] === ' Indonesia'){

                    $bestCities[$allCities_key]['city_id'] = $allCities_value->getcity_id();
                    $bestCities[$allCities_key]['gmap_id'] = $allCities_value->getgmap_id();
                    $bestCities[$allCities_key]['gmap_formatted_address'] = $allCities_value->getgmap_formatted_address();
                    $bestCities[$allCities_key]['gmap_lat'] = $allCities_value->getgmap_lat();
                    $bestCities[$allCities_key]['gmap_lng'] = $allCities_value->getgmap_lng();
                    $bestCities[$allCities_key]['health_care_index'] = $allCities_value->gethealth_care_index();
                    $bestCities[$allCities_key]['crime_index'] = $allCities_value->getcrime_index();
                    $bestCities[$allCities_key]['traffic_time_index'] = $allCities_value->gettraffic_time_index();
                    $bestCities[$allCities_key]['purchasing_power_incl_rent_index'] = $allCities_value->getpurchasing_power_incl_rent_index();
                    $bestCities[$allCities_key]['cpi_index'] = $allCities_value->getpollution_index();
                    $bestCities[$allCities_key]['traffic_index'] = $allCities_value->gettraffic_index();
                    $bestCities[$allCities_key]['quality_of_life_index'] = $allCities_value->getquality_of_life_index();
                    $bestCities[$allCities_key]['cpi_and_rent_index'] = $allCities_value->getcpi_and_rent_index();
                    $bestCities[$allCities_key]['groceries_index'] = $allCities_value->getgroceries_index();
                    $bestCities[$allCities_key]['safety_index'] = $allCities_value->getsafety_index();
                    $bestCities[$allCities_key]['city_name'] = $allCities_value->getcity_name();
                    $bestCities[$allCities_key]['rent_index'] = $allCities_value->getrent_index();
                    $bestCities[$allCities_key]['traffic_co2_index'] = $allCities_value->gettraffic_co2_index();
                    $bestCities[$allCities_key]['restaurant_price_index'] = $allCities_value->getrestaurant_price_index();
                    $bestCities[$allCities_key]['traffic_inefficiency_index'] = $allCities_value->gettraffic_inefficiency_index();
                    $bestCities[$allCities_key]['property_price_to_income_ratio'] = $allCities_value->getproperty_price_to_income_ratio();

                }
            }elseif (count($allCountriesName) === 3){
                if($allCountriesName[2] === ' Canada' || $allCountriesName[2] === ' Portugal' || $allCountriesName[2] === ' Spain' || $allCountriesName[2] === ' Morocco' || $allCountriesName[2] === ' Thailand' || $allCountriesName[2] === ' Indonesia'){

                    $bestCities[$allCities_key]['city_id'] = $allCities_value->getcity_id();
                    $bestCities[$allCities_key]['gmap_id'] = $allCities_value->getgmap_id();
                    $bestCities[$allCities_key]['gmap_formatted_address'] = $allCities_value->getgmap_formatted_address();
                    $bestCities[$allCities_key]['gmap_lat'] = $allCities_value->getgmap_lat();
                    $bestCities[$allCities_key]['gmap_lng'] = $allCities_value->getgmap_lng();
                    $bestCities[$allCities_key]['health_care_index'] = $allCities_value->gethealth_care_index();
                    $bestCities[$allCities_key]['crime_index'] = $allCities_value->getcrime_index();
                    $bestCities[$allCities_key]['traffic_time_index'] = $allCities_value->gettraffic_time_index();
                    $bestCities[$allCities_key]['purchasing_power_incl_rent_index'] = $allCities_value->getpurchasing_power_incl_rent_index();
                    $bestCities[$allCities_key]['cpi_index'] = $allCities_value->getpollution_index();
                    $bestCities[$allCities_key]['traffic_index'] = $allCities_value->gettraffic_index();
                    $bestCities[$allCities_key]['quality_of_life_index'] = $allCities_value->getquality_of_life_index();
                    $bestCities[$allCities_key]['cpi_and_rent_index'] = $allCities_value->getcpi_and_rent_index();
                    $bestCities[$allCities_key]['groceries_index'] = $allCities_value->getgroceries_index();
                    $bestCities[$allCities_key]['safety_index'] = $allCities_value->getsafety_index();
                    $bestCities[$allCities_key]['city_name'] = $allCities_value->getcity_name();
                    $bestCities[$allCities_key]['rent_index'] = $allCities_value->getrent_index();
                    $bestCities[$allCities_key]['traffic_co2_index'] = $allCities_value->gettraffic_co2_index();
                    $bestCities[$allCities_key]['restaurant_price_index'] = $allCities_value->getrestaurant_price_index();
                    $bestCities[$allCities_key]['traffic_inefficiency_index'] = $allCities_value->gettraffic_inefficiency_index();
                    $bestCities[$allCities_key]['property_price_to_income_ratio'] = $allCities_value->getproperty_price_to_income_ratio();

                }
            }
        }

    }


    /*
    *      2 - Le tri des pays par rapport a la distance & climat
    */


    $bestCitiesDistance = array();

    if($finder_distance == "autour"){

        // reponse = autour de la méditerranée
        // pays = espagne - maroc

        foreach ($bestCities as $bestCities_key => $bestCities_value){

            $allCountriesName = explode(',', $bestCities_value['city_name']);
            $allCountriesNameEnd = end($allCountriesName);


            /*
             *      tri par rapport au climat
             */
            if($finder_climat === 'obligation'){

                //reponse = une obligation , c'est essentiel
                //MOROCCO!

                if($allCountriesNameEnd === ' Morocco'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }


            }elseif ($finder_climat === 'necessite'){

                //reponse = une necessite , mais pas la canicule
                //ESPAGNE!

                if($allCountriesNameEnd === ' Spain'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }

            }elseif ($finder_climat === 'saison'){

                //reponse = uniquement l'été je tiens au saison
                //ESPAGNE!

                if($allCountriesNameEnd === ' Spain'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }

            }elseif ($finder_climat === 'redhibitoire'){

                //reponse = je ne supporte pas la chaleur
                //ESPAGNE!

                if($allCountriesNameEnd === ' Spain'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }


            }

        }

    }elseif ($finder_distance === "loin"){

        // reponse = loin mais pas trop
        // pays = espace - maroc - portugal

        foreach ($bestCities as $bestCities_key => $bestCities_value){

            $allCountriesName = explode(',', $bestCities_value['city_name']);
            $allCountriesNameEnd = end($allCountriesName);


            /*
             *      tri par rapport au climat
             */
            if($finder_climat === 'obligation'){

                //reponse = une obligation , c'est essentiel
                //MOROCCO!

                if($allCountriesNameEnd === ' Morocco'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }


            }elseif ($finder_climat === 'necessite'){

                //reponse = une necessite , mais pas la canicule
                //ESPAGNEouPORTUGAL!

                if($allCountriesNameEnd === ' Spain' || $allCountriesNameEnd === ' Portugal'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }

            }elseif ($finder_climat === 'saison'){

                //reponse = uniquement l'été je tiens au saison
                //ESPAGNEouPORTUGAL!

                if($allCountriesNameEnd === ' Spain'||$allCountriesNameEnd === ' Portugal'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }

            }elseif ($finder_climat === 'redhibitoire'){

                //reponse = je ne supporte pas la chaleur
                //ESPAGNEouPORTUGAL!

                if($allCountriesNameEnd === ' Spain'||$allCountriesNameEnd === ' Portugal'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }


            }

        }

    }elseif ($finder_distance === "tresloin"){

        // reponse = tres loin
        // pays = indonesie - canada - thailande

        foreach ($bestCities as $bestCities_key => $bestCities_value){

            $allCountriesName = explode(',', $bestCities_value['city_name']);
            $allCountriesNameEnd = end($allCountriesName);

            /*
             *      tri par rapport au climat
             */
            if($finder_climat === 'obligation'){

                //reponse = une obligation , c'est essentiel
                //THAILANDEouINDONESIE!

                if($allCountriesNameEnd === ' Thailand' || $allCountriesNameEnd === ' Indonesia'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }


            }elseif ($finder_climat === 'necessite'){

                //reponse = une necessite , mais pas la canicule
                //THAILANDouINDONESIE!

                if($allCountriesNameEnd === ' Thailand' || $allCountriesNameEnd === ' Indonesia'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }

            }elseif ($finder_climat === 'saison'){

                //reponse = uniquement l'été je tiens au saison
                //CANADA!

                if($allCountriesNameEnd === ' Canada'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }

            }elseif ($finder_climat === 'redhibitoire'){

                //reponse = je ne supporte pas la chaleur
                //CANADA!

                if($allCountriesNameEnd === ' Canada'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }


            }


        }

    }elseif ($finder_distance === "peuimporte"){

        // reponse = peut importe
        // on touche pas au tableau
        // pays = Canada - Portugal - Espagne - Maroc - Thailande - Indonésie


        foreach ($bestCities as $bestCities_key => $bestCities_value){

            $allCountriesName = explode(',', $bestCities_value['city_name']);
            $allCountriesNameEnd = end($allCountriesName);

            /*
             *      tri par rapport au climat
             */
            if($finder_climat === 'obligation'){

                //reponse = une obligation , c'est essentiel
                //THAILANDEouINDONESIEouMAROC!

                if($allCountriesNameEnd === ' Thailand' || $allCountriesNameEnd === ' Indonesia' || $allCountriesNameEnd === ' Morocco'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }


            }elseif ($finder_climat === 'necessite'){

                //reponse = une necessite , mais pas la canicule
                //THAILANDouINDONESIEouSPAINouPORTUGAL!

                if($allCountriesNameEnd === ' Thailand' || $allCountriesNameEnd === ' Indonesia' || $allCountriesNameEnd === ' Spain' || $allCountriesNameEnd === ' Portugal'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }

            }elseif ($finder_climat === 'saison'){

                //reponse = uniquement l'été je tiens au saison
                //CANADAouESPAGNEouPORTUGAL!

                if($allCountriesNameEnd === ' Canada' || $allCountriesNameEnd === ' Spain' || $allCountriesNameEnd === ' Portugal'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }

            }elseif ($finder_climat === 'redhibitoire'){

                //reponse = je ne supporte pas la chaleur
                //CANADAouSPAINouPORTUGAL!

                if($allCountriesNameEnd === ' Canada' || $allCountriesNameEnd === ' Spain' || $allCountriesNameEnd === ' Portugal'){

                    $bestCitiesDistance[$bestCities_key]['city_id'] = $bestCities_value['city_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_id'] = $bestCities_value['gmap_id'];
                    $bestCitiesDistance[$bestCities_key]['gmap_formatted_address'] = $bestCities_value['gmap_formatted_address'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lat'] = $bestCities_value['gmap_lat'];
                    $bestCitiesDistance[$bestCities_key]['gmap_lng'] = $bestCities_value['gmap_lng'];
                    $bestCitiesDistance[$bestCities_key]['health_care_index'] = $bestCities_value['health_care_index'];
                    $bestCitiesDistance[$bestCities_key]['crime_index'] = $bestCities_value['crime_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_time_index'] = $bestCities_value['traffic_time_index'];
                    $bestCitiesDistance[$bestCities_key]['purchasing_power_incl_rent_index'] = $bestCities_value['purchasing_power_incl_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_index'] = $bestCities_value['cpi_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_index'] = $bestCities_value['traffic_index'];
                    $bestCitiesDistance[$bestCities_key]['quality_of_life_index'] = $bestCities_value['quality_of_life_index'];
                    $bestCitiesDistance[$bestCities_key]['cpi_and_rent_index'] = $bestCities_value['cpi_and_rent_index'];
                    $bestCitiesDistance[$bestCities_key]['groceries_index'] = $bestCities_value['groceries_index'];
                    $bestCitiesDistance[$bestCities_key]['safety_index'] = $bestCities_value['safety_index'];
                    $bestCitiesDistance[$bestCities_key]['city_name'] = $bestCities_value['city_name'];
                    $bestCitiesDistance[$bestCities_key]['rent_index'] = $bestCities_value['rent_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_co2_index'] = $bestCities_value['traffic_co2_index'];
                    $bestCitiesDistance[$bestCities_key]['restaurant_price_index'] = $bestCities_value['restaurant_price_index'];
                    $bestCitiesDistance[$bestCities_key]['traffic_inefficiency_index'] = $bestCities_value['traffic_inefficiency_index'];
                    $bestCitiesDistance[$bestCities_key]['property_price_to_income_ratio'] = $bestCities_value['property_price_to_income_ratio'];

                }


            }


        }

    }




    /*
     *      3 - Le tri des villes par rapport à la thune
     */


    function getClosest($search, $arr) {
        $closest = null;
        foreach ($arr as $item) {
            if ($closest === null || abs($search - $closest) > abs($item - $search)) {
                $closest = $item;
            }
        }
        return $closest;
    }


    $allcpi = array();
    foreach ($bestCitiesDistance as $bestCitiesDistance_key => $bestCitiesDistance_value){
        if($bestCitiesDistance_value['cpi_index'] != NULL){
            array_push($allcpi, $bestCitiesDistance_value['cpi_index']);
        }
    }

    $citycpi = '';

    $integerBudget = intval($finder_budget);
    //var_dump($integerBudget);

    if($integerBudget === 500){
        //T1
        //var_dump('t1');
        $citycpi = getClosest(25, $allcpi);

    }elseif ($integerBudget > 500 && $integerBudget <= 1500){
        //T2
        //var_dump('t2');
        $citycpi = getClosest(50, $allcpi);

    }elseif ($integerBudget > 1500 && $integerBudget <= 1800){
        //T3
        //var_dump('t3');
        $citycpi = getClosest(75, $allcpi);

    }elseif ($integerBudget > 1800) {
        //T4
        //var_dump('t4');
        $citycpi = getClosest(100, $allcpi);

    }else{}


    $finalCity = array();
    foreach ($bestCitiesDistance as $bestCitiesDistance_key => $bestCitiesDistance_value) {
        if($bestCitiesDistance_value['cpi_index'] === $citycpi){

            $finalCity['city_id'] = $bestCitiesDistance_value['city_id'];
            $finalCity['gmap_id'] = $bestCitiesDistance_value['gmap_id'];
            $finalCity['gmap_formatted_address'] = $bestCitiesDistance_value['gmap_formatted_address'];
            $finalCity['gmap_lat'] = $bestCitiesDistance_value['gmap_lat'];
            $finalCity['gmap_lng'] = $bestCitiesDistance_value['gmap_lng'];
            $finalCity['health_care_index'] = $bestCitiesDistance_value['health_care_index'];
            $finalCity['crime_index'] = $bestCitiesDistance_value['crime_index'];
            $finalCity['traffic_time_index'] = $bestCitiesDistance_value['traffic_time_index'];
            $finalCity['purchasing_power_incl_rent_index'] = $bestCitiesDistance_value['purchasing_power_incl_rent_index'];
            $finalCity['cpi_index'] = $bestCitiesDistance_value['cpi_index'];
            $finalCity['traffic_index'] = $bestCitiesDistance_value['traffic_index'];
            $finalCity['quality_of_life_index'] = $bestCitiesDistance_value['quality_of_life_index'];
            $finalCity['cpi_and_rent_index'] = $bestCitiesDistance_value['cpi_and_rent_index'];
            $finalCity['groceries_index'] = $bestCitiesDistance_value['groceries_index'];
            $finalCity['safety_index'] = $bestCitiesDistance_value['safety_index'];
            $finalCity['city_name'] = $bestCitiesDistance_value['city_name'];
            $finalCity['rent_index'] = $bestCitiesDistance_value['rent_index'];
            $finalCity['traffic_co2_index'] = $bestCitiesDistance_value['traffic_co2_index'];
            $finalCity['restaurant_price_index'] = $bestCitiesDistance_value['restaurant_price_index'];
            $finalCity['traffic_inefficiency_index'] = $bestCitiesDistance_value['traffic_inefficiency_index'];
            $finalCity['property_price_to_income_ratio'] = $bestCitiesDistance_value['property_price_to_income_ratio'];

        }
    }


    return $app['twig']->render('results.html.twig', array(

        'city_id' => $finalCity['city_id'],
        'gmap_id' => $finalCity['gmap_id'],
        'gmap_formatted_address' => $finalCity['gmap_formatted_address'],
        'gmap_lat' => $finalCity['gmap_lat'],
        'gmap_lng' => $finalCity['gmap_lng'],
        'health_care_index' => $finalCity['health_care_index'],
        'crime_index' => $finalCity['crime_index'],
        'traffic_time_index' => $finalCity['traffic_time_index'],
        'purchasing_power_incl_rent_index' => $finalCity['purchasing_power_incl_rent_index'],
        'cpi_index' => $finalCity['cpi_index'],
        'traffic_index' => $finalCity['traffic_index'],
        'quality_of_life_index' => $finalCity['quality_of_life_index'],
        'cpi_and_rent_index' => $finalCity['cpi_and_rent_index'],
        'groceries_index' => $finalCity['groceries_index'],
        'safety_index' => $finalCity['safety_index'],
        'city_name' => $finalCity['city_name'],
        'rent_index' => $finalCity['rent_index'],
        'traffic_co2_index' => $finalCity['traffic_co2_index'],
        'restaurant_price_index' => $finalCity['restaurant_price_index'],
        'traffic_inefficiency_index' => $finalCity['traffic_inefficiency_index'],
        'property_price_to_income_ratio' => $finalCity['property_price_to_income_ratio']

    ));

})->bind('results');