<?php

// recommendation
$app->get('/recommendation', function () use ($app) {
    return $app['twig']->render('recommendation.html.twig');
})->bind('recommendation');

// recommendationResults
$app->post('/recommendationResults', function (Symfony\Component\HttpFoundation\Request $request) use ($app) {

    /*
     *      BUILDING USER SCORE
     */

    $user_score_eclater = intval($request->request->get('score_eclate'));
    $user_score_investir = intval($request->request->get('score_investir'));
    $user_score_culture = intval($request->request->get('score_culture'));
    $user_score_humanitaire = intval($request->request->get('score_humanitaire'));

    $user_score_total = $user_score_eclater + $user_score_investir + $user_score_culture + $user_score_humanitaire;

    $user_score_ratio = array(

        'éclater' => ($user_score_eclater/$user_score_total)*100,
        'investir' => ($user_score_investir/$user_score_total)*100,
        'culture' => ($user_score_culture/$user_score_total)*100,
        'humanitaire' => ($user_score_humanitaire/$user_score_total)*100

    );

    /*
     *      CITIES WE NEED
     */

    $allcities = $app['dao.ville']->findAll();
    foreach ($allcities as $allcities_key => $allcities_value){
        if($allcities_value->getnomPaysNumbeo() === "Canada"){
            var_dump($allcities_value);
        }
        if($allcities_value->getnomPaysNumbeo() === "Thailand"){
            var_dump($allcities_value);
        }
        if($allcities_value->getnomPaysNumbeo() === "Indonesia"){
            var_dump($allcities_value);
        }
    }

    die();

    return $app['twig']->render('recommendationResults.html.twig', array(

        'user_score_ratio' => $user_score_ratio

    ));

})->bind('recommendationResults');


// insert
$app->get('/insert', function () use ($app) {


    /*
    $curl_ville = curl_init();
    curl_setopt_array($curl_ville, array(
        CURLOPT_URL => "https://www.numbeo.com/api/cities?api_key=peumbwlgafjj3y",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));
    $response_curl_ville = curl_exec($curl_ville);
    $err = curl_error($curl_ville);
    curl_close($curl_ville);

    $response_curl_ville_decode = json_decode($response_curl_ville);
    //var_dump($response_curl_ville_decode->cities);

    foreach ($response_curl_ville_decode->cities as $response_curl_ville_decode_key => $response_curl_ville_decode_value){

        if(isset($response_curl_ville_decode_value->longitude) && isset($response_curl_ville_decode_value->latitude) && isset($response_curl_ville_decode_value->city_id) && isset($response_curl_ville_decode_value->city) && isset($response_curl_ville_decode_value->country)){

        }
    }
    */


    /*
    $curl_ville = curl_init();
    curl_setopt_array($curl_ville, array(
        CURLOPT_URL => "https://www.numbeo.com/api/city_prices?api_key=peumbwlgafjj3y&city_id=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));
    $response_curl_ville = curl_exec($curl_ville);
    $err = curl_error($curl_ville);
    curl_close($curl_ville);

    $response_curl_ville_decode = json_decode($response_curl_ville);
    var_dump($response_curl_ville_decode);
    */


    $allCities = $app['dao.ville']->findAll();
    $party_array = array();

    foreach ($allCities as $allCities_key => $allCities_value){

        //var_dump($allCities_value['']);
        //var_dump($allCities_value->getidNumbeo());

        $curl_ville = curl_init();
        curl_setopt_array($curl_ville, array(
            CURLOPT_URL => "https://www.numbeo.com/api/city_prices?api_key=peumbwlgafjj3y&city_id=".$allCities_value->getidNumbeo(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response_curl_ville = curl_exec($curl_ville);
        $err = curl_error($curl_ville);
        curl_close($curl_ville);
        $response_curl_ville_decode = json_decode($response_curl_ville);

        if(empty($response_curl_ville_decode->prices)){
            //var_dump('no prices');
        }else{



            //var_dump($response_curl_ville_decode);
            //die();



            $idNumbeo = $allCities_value->getId();
            $nomNumbeo = $response_curl_ville_decode->name;
            $currency = $response_curl_ville_decode->currency;
            $price_fastfood = 'no informations';
            $price_beermarket = 'no informations';
            $price_winemarket = 'no informations';
            $price_transportmonthly = 'no informations';
            $price_transportonway = 'no informations';
            $price_taxi = 'no informations';

            foreach ($response_curl_ville_decode->prices as $response_curl_ville_decode_prices_key => $response_curl_ville_decode_prices_value){
                if($response_curl_ville_decode_prices_value->item_name === "Domestic Beer (0.5 liter draught), Restaurants") {
                    $price_beermarket = $response_curl_ville_decode_prices_value->average_price;
                }
                if($response_curl_ville_decode_prices_value->item_name === "McMeal at McDonalds (or Equivalent Combo Meal), Restaurants") {
                    $price_fastfood = $response_curl_ville_decode_prices_value->average_price;
                }
                if($response_curl_ville_decode_prices_value->item_name === "Bottle of Wine (Mid-Range), Markets") {
                    $price_winemarket = $response_curl_ville_decode_prices_value->average_price;
                }
                if($response_curl_ville_decode_prices_value->item_name === "Monthly Pass (Regular Price), Transportation") {
                    $price_transportmonthly = $response_curl_ville_decode_prices_value->average_price;
                }
                if($response_curl_ville_decode_prices_value->item_name === "One-way Ticket (Local Transport), Transportation") {
                    $price_transportonway = $response_curl_ville_decode_prices_value->average_price;
                }
                if($response_curl_ville_decode_prices_value->item_name === "Taxi Start (Normal Tariff), Transportation") {
                    $price_taxi = $response_curl_ville_decode_prices_value->average_price;
                }
            }


            /*
            var_dump($idNumbeo);
            var_dump($nomNumbeo);
            var_dump($currency);
            var_dump($price_fastfood);
            var_dump($price_beermarket);
            var_dump($price_winemarket);
            var_dump($price_transportmonthly);
            var_dump($price_transportonway);
            var_dump($price_taxi);
            */


            $app['db']->insert('prices_party', array(
                    'idNumbeo' => $idNumbeo,
                    'nomNumbeo' => $nomNumbeo,
                    'currency' => $currency,
                    'price_fastfood' => $price_fastfood,
                    'price_beermarket' => $price_beermarket,
                    'price_winemarket' => $price_winemarket,
                    'price_transportmonthly' => $price_transportmonthly,
                    'price_transportonway' => $price_transportonway,
                    'price_taxi' => $price_taxi
                )
            );

            //die();


            /*
            var_dump($response_curl_ville_decode);
            var_dump($response_curl_ville_decode->prices);
            */


        }

    }

    die();


    return 'insert page';

})->bind('insert');

// homepage
$app->get('/manifesto', function () use ($app) {
    return $app['twig']->render('homepage.html.twig');
})->bind('home');

// assitant
$app->get('/', function () use ($app) {
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

        'q1finder_gender' => $finder_gender,
        'q2finder_age' => $finder_age,
        'q3finder_avis' => $request->get('finder_avis'),
        'q4finder_distance' => $request->get('finder_distance'),
        'q5finder_climat' => $request->get('finder_climat'),
        'q6finder_budget' => $request->get('finder_budget'),

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

// city
$app->post('/city', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {


    //var_dump($request);

    /*
     *      ON RENTRE DANS LA BASE
     */

    $app['db']->insert('user', array(
            'villeName' => $request->get('formulairecity_name'),
            'mailUser' => $request->get('formulaireMailClient'),
            'reponseq1' => $request->get('q1finder_gender'),
            'reponseq2' => $request->get('q2finder_age'),
            'reponseq3' => $request->get('q3finder_avis'),
            'reponseq4' => $request->get('q4finder_distance'),
            'reponseq5' => $request->get('q5finder_climat'),
            'reponseq6' => $request->get('q6finder_budget')
        )
    );

    //die();

    // you can fetch the EntityManager via $this->getDoctrine()
    // or you can add an argument to your action: createAction(EntityManagerInterface $em)
    /*
    $em = $app['dao.user']->get('doctrine')->getManager();

    $user = new landingSILEX\Custom\User();

    $user->setvilleName($request->get('formulairecity_name'));
    $user->setmailUser($request->get('formulaireMailClient'));
    $user->setresq1($request->get('q1finder_gender'));
    $user->setresq2($request->get('q2finder_age'));
    $user->setresq3($request->get('q3finder_avis'));
    $user->setresq4($request->get('q4finder_distance'));
    $user->setresq5($request->get('q5finder_climat'));
    $user->setresq6($request->get('q6finder_budget'));

    $em->persist($user);

    $em->flush();
    */



    /*
     *      0 - Décalaration des variables
     */

    $formulaireCityId =$request->get('formulaireCityId');
    $formulaireMailClient = $request->get('formulaireMailClient');
    $formulairehealth_care_index = $request->get('formulairehealth_care_index');
    $formulairecrime_index = $request->get('formulairecrime_index');
    $formulairecpi_index = $request->get('formulairecpi_index');
    $formulairequality_of_life_index = $request->get('formulairequality_of_life_index');
    $formulairegroceries_index = $request->get('formulairegroceries_index');
    $formulairecity_name = $request->get('formulairecity_name');
    $formulairerestaurant_price_index = $request->get('formulairerestaurant_price_index');

    //var_dump($formulairecity_name);
    //die();



    /*
     *      1 - API CALLS
     */


    $formulairecity_namePROPER = explode(',', $formulairecity_name);
    $formulairecity_namePROPERDEUX = str_replace(' ', '%20', $formulairecity_namePROPER[0]);

    //var_dump($formulairecity_name);
    //die();

    $curl_prices_city_one = curl_init();
    curl_setopt_array($curl_prices_city_one, array(
        CURLOPT_URL => "https://www.numbeo.com/api/city_prices?api_key=peumbwlgafjj3y&query=".$formulairecity_namePROPERDEUX,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));
    $response_city_one = curl_exec($curl_prices_city_one);
    $err = curl_error($curl_prices_city_one);
    curl_close($curl_prices_city_one);


    $curl_prices_paris = curl_init();
    curl_setopt_array($curl_prices_paris, array(
        CURLOPT_URL => "https://www.numbeo.com/api/city_prices?api_key=peumbwlgafjj3y&query=Paris",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));
    $response_prices_paris = curl_exec($curl_prices_paris);
    $err = curl_error($curl_prices_paris);
    curl_close($curl_prices_paris);


    $decodePARIS = json_decode($response_prices_paris);
    $decodeCITY = json_decode($response_city_one);


    //var_dump($decodePARIS);
    //var_dump($decodeCITY);
    //var_dump(property_exists($decodeCITY, 'error'));
    //die();



    /*
     *      PREPARE DATA PARIS
     */

    $pricePARIS = array(

        'bred' => 'bred',
        'beer' => 'Beer',
        'resto' => 'Resto',
        'milk' => 'milk',
        'egg' => 'egg',
        'pubtransport' => 'pubtransport',
        'gaso' => 'gaso',
        'appart' => 'appart',
        'jean' => 'jean',
        'shoe' => 'shoe',
        'fitness' => 'fitness',
        'cine' => 'cine',

    );

    foreach ($decodePARIS->prices as $decodePARISprice_key => $decodePARISprice_value){

        switch ($decodePARISprice_value->item_name) {

            case 'Domestic Beer (0.5 liter draught), Restaurants':
                $pricePARIS['beer'] = $decodePARISprice_value->average_price;
                break;
            case 'Meal for 2 People, Mid-range Restaurant, Three-course, Restaurants':
                $pricePARIS['resto'] = $decodePARISprice_value->average_price;
                break;
            case 'Milk (regular), (1 liter), Markets':
                $pricePARIS['milk'] = $decodePARISprice_value->average_price;
                break;
            case 'Loaf of Fresh White Bread (500g), Markets':
                $pricePARIS['bred'] = $decodePARISprice_value->average_price;
                break;
            case 'Eggs (12), Markets':
                $pricePARIS['egg'] = $decodePARISprice_value->average_price;
                break;
            case 'Apartment (1 bedroom) in City Centre, Rent Per Month':
                $pricePARIS['appart'] = $decodePARISprice_value->average_price;
                break;
            case 'Fitness Club, Monthly Fee for 1 Adult, Sports And Leisure':
                $pricePARIS['fitness'] = $decodePARISprice_value->average_price;
                break;
            case '1 Pair of Jeans (Levis 501 Or Similar), Clothing And Shoes':
                $pricePARIS['jean'] = $decodePARISprice_value->average_price;
                break;
            case '1 Pair of Men Leather Business Shoes, Clothing And Shoes':
                $pricePARIS['shoe'] = $decodePARISprice_value->average_price;
                break;
            case 'Cinema, International Release, 1 Seat, Sports And Leisure':
                $pricePARIS['cine'] = $decodePARISprice_value->average_price;
                break;
            case 'Gasoline (1 liter), Transportation':
                $pricePARIS['gaso'] = $decodePARISprice_value->average_price;
                break;
            case 'One-way Ticket (Local Transport), Transportation':
                $pricePARIS['pubtransport'] = $decodePARISprice_value->average_price;
                break;
        }

    }


    /*
     *      PREPARE DATA VILLE RANDOM
     */

    if(property_exists($decodeCITY, 'error')){

        $nameRANDOM = $formulairecity_name;
        $currRANDOM = 'no informations';
        $priceRANDOM = array(

            'bred' => 'no informations',
            'beer' => 'no informations',
            'resto' => 'no informations',
            'milk' => 'no informations',
            'egg' => 'no informations',
            'pubtransport' => 'no informations',
            'gaso' => 'no informations',
            'appart' => 'no informations',
            'jean' => 'no informations',
            'shoe' => 'no informations',
            'fitness' => 'no informations',
            'cine' => 'no informations',

        );

    }else{

        $nameRANDOM = $formulairecity_name;
        $currRANDOM = $decodeCITY->currency;

        $priceRANDOM = array(

            'bred' => 'bred',
            'beer' => 'Beer',
            'resto' => 'Resto',
            'milk' => 'milk',
            'egg' => 'egg',
            'pubtransport' => 'pubtransport',
            'gaso' => 'gaso',
            'appart' => 'appart',
            'jean' => 'jean',
            'shoe' => 'shoe',
            'fitness' => 'fitness',
            'cine' => 'cine',

        );

        foreach ($decodeCITY->prices as $priceRANDOMprice_key => $priceRANDOMprice_value){

            switch ($priceRANDOMprice_value->item_name) {

                case 'Domestic Beer (0.5 liter draught), Restaurants':
                    $priceRANDOM['beer'] = $priceRANDOMprice_value->average_price;
                    break;
                case 'Meal for 2 People, Mid-range Restaurant, Three-course, Restaurants':
                    $priceRANDOM['resto'] = $priceRANDOMprice_value->average_price;
                    break;
                case 'Milk (regular), (1 liter), Markets':
                    $priceRANDOM['milk'] = $priceRANDOMprice_value->average_price;
                    break;
                case 'Loaf of Fresh White Bread (500g), Markets':
                    $priceRANDOM['bred'] = $priceRANDOMprice_value->average_price;
                    break;
                case 'Eggs (12), Markets':
                    $priceRANDOM['egg'] = $priceRANDOMprice_value->average_price;
                    break;
                case 'Apartment (1 bedroom) in City Centre, Rent Per Month':
                    $priceRANDOM['appart'] = $priceRANDOMprice_value->average_price;
                    break;
                case 'Fitness Club, Monthly Fee for 1 Adult, Sports And Leisure':
                    $priceRANDOM['fitness'] = $priceRANDOMprice_value->average_price;
                    break;
                case '1 Pair of Jeans (Levis 501 Or Similar), Clothing And Shoes':
                    $priceRANDOM['jean'] = $priceRANDOMprice_value->average_price;
                    break;
                case '1 Pair of Men Leather Business Shoes, Clothing And Shoes':
                    $priceRANDOM['shoe'] = $priceRANDOMprice_value->average_price;
                    break;
                case 'Cinema, International Release, 1 Seat, Sports And Leisure':
                    $priceRANDOM['cine'] = $priceRANDOMprice_value->average_price;
                    break;
                case 'Gasoline (1 liter), Transportation':
                    $priceRANDOM['gaso'] = $priceRANDOMprice_value->average_price;
                    break;
                case 'One-way Ticket (Local Transport), Transportation':
                    $priceRANDOM['pubtransport'] = $priceRANDOMprice_value->average_price;
                    break;
            }

        }

    }



    //var_dump($pricePARIS);
    //var_dump($priceRANDOM);
    //die();


    /*
     * THROWING THE TPL
     */

    return $app['twig']->render('city.html.twig', array(

        //random
        'random_name' => $nameRANDOM,
        'random_curr' => $currRANDOM,
        'random_prices' => $priceRANDOM,
        //paris
        'paris_prices' => $pricePARIS

    ));


})->bind('city');