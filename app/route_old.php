<?php

// gplaces
$app->get('/gplaces', function () use ($app) {


    // request page one
    $curl_places = curl_init();
    curl_setopt_array($curl_places, array(
        CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/nearbysearch/json?type=bar&key=AIzaSyBHKrTMXenHkW-acn_NOt-dGzboSg-p32E&location=48.866667,2.333333&radius=20000",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));
    $response_curl_places = curl_exec($curl_places);
    $err = curl_error($curl_places);
    curl_close($curl_places);

    //reponse page one
    $response_curl_places_decode = json_decode($response_curl_places);
    //var_dump($response_curl_places_decode);

    //var_dump($response_curl_places_decode->next_page_token);

    foreach ($response_curl_places_decode->results as $response_curl_places_decode_key => $response_curl_places_decode_value){

        var_dump($response_curl_places_decode_value->name);

    }

    // request page two

    /*
    $curl_places_second = curl_init();
    curl_setopt_array($curl_places_second, array(
        CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/nearbysearch/json?key=AIzaSyBHKrTMXenHkW-acn_NOt-dGzboSg-p32E&pagetoken=".$response_curl_places_decode->next_page_token,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));
    $response_curl_places_second = curl_exec($curl_places_second);
    $err = curl_error($curl_places_second);
    curl_close($curl_places_second);
    */

    // response page two

    /*
    $response_curl_places_second_decode = json_decode($response_curl_places_second);
    var_dump($response_curl_places_second_decode);
    */


    die();

    //return $app['twig']->render('assistant.html.twig');
})->bind('gplaces');

// insertbis
$app->get('/insertbis', function () use ($app) {

    var_dump('insert');
    die();

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
    */

    /*
    $curl_items_prices = curl_init();
    curl_setopt_array($curl_items_prices, array(
        CURLOPT_URL => "https://www.numbeo.com/api/city_prices?api_key=peumbwlgafjj3y&query=Paris",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));

    $response_curl_items_prices = curl_exec($curl_items_prices);
    $err = curl_error($curl_items_prices);
    curl_close($curl_items_prices);
    $response_curl_items_prices_decode = json_decode($response_curl_items_prices);
    var_dump($response_curl_items_prices_decode);
    die();
    */


    $fiveCountries = $app['dao.ville']->findFiveCountries();
    //var_dump($fiveCountries);

    foreach ($fiveCountries as $fiveCountries_key => $fiveCountries_value){

        //var_dump($fiveCountries_value->getidNumbeo());
        $curl_items_prices = curl_init();
        curl_setopt_array($curl_items_prices, array(
            CURLOPT_URL => "https://www.numbeo.com/api/city_prices?api_key=peumbwlgafjj3y&city_id=".$fiveCountries_value->getidNumbeo(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response_curl_items_prices = curl_exec($curl_items_prices);
        $err = curl_error($curl_items_prices);
        curl_close($curl_items_prices);
        $response_curl_items_prices_decode = json_decode($response_curl_items_prices);

        $data_prices_to_insert = array(

            'city_idNumbeo' => $fiveCountries_value->getidNumbeo(),
            'city_name' => '',
            'city_currency' => '',
            'price_cheap_restaurant' => '',
            'price_expensive_restaurant' => '',
            'price_beer_domestic_restaurant' => '',
            'price_beer_imported_restaurant' => '',
            'price_wine' => '',
            'price_beer_domestic' => '',
            'price_beer_imported' => '',
            'price_transport_one_way' => '',
            'price_transport_monthly' => '',
            'price_taxi_start' => '',
            'price_taxi_one_miles' => '',
            'price_taxi_one_hours_wait' => '',
            'price_basics' => '',
            'price_cinema' => '',
            'price_fitness_club' => '',
            'apartment_one' => '',
            'apartment_three' => '',
            'apartment_square_feet' => '',

        );

        if(!empty($response_curl_items_prices_decode->name)){
            $data_prices_to_insert['city_name'] = $response_curl_items_prices_decode->name;
        }

        if(!empty($response_curl_items_prices_decode->currency)){
            $data_prices_to_insert['city_currency'] = $response_curl_items_prices_decode->currency;
        }


        foreach ($response_curl_items_prices_decode->prices as $response_curl_items_prices_decode_key => $response_curl_items_prices_decode_value){


            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Meal, Inexpensive Restaurant, Restaurants'){
                $data_prices_to_insert['price_cheap_restaurant'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Meal for 2 People, Mid-range Restaurant, Three-course, Restaurants'){
                $data_prices_to_insert['price_expensive_restaurant'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Domestic Beer (0.5 liter draught), Restaurants'){
                $data_prices_to_insert['price_beer_domestic_restaurant'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Imported Beer (0.33 liter bottle), Restaurants'){
                $data_prices_to_insert['price_beer_imported_restaurant'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Bottle of Wine (Mid-Range), Markets'){
                $data_prices_to_insert['price_wine'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Domestic Beer (0.5 liter bottle), Markets'){
                $data_prices_to_insert['price_beer_domestic'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Imported Beer (0.33 liter bottle), Markets'){
                $data_prices_to_insert['price_beer_imported'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'One-way Ticket (Local Transport), Transportation'){
                $data_prices_to_insert['price_transport_one_way'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Monthly Pass (Regular Price), Transportation'){
                $data_prices_to_insert['price_transport_monthly'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Taxi Start (Normal Tariff), Transportation'){
                $data_prices_to_insert['price_taxi_start'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Taxi 1km (Normal Tariff), Transportation'){
                $data_prices_to_insert['price_taxi_one_miles'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Taxi 1hour Waiting (Normal Tariff), Transportation'){
                $data_prices_to_insert['price_taxi_one_hours_wait'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Basic (Electricity, Heating, Water, Garbage) for 85m2 Apartment, Utilities (Monthly)'){
                $data_prices_to_insert['price_basics'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Cinema, International Release, 1 Seat, Sports And Leisure'){
                $data_prices_to_insert['price_cinema'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Fitness Club, Monthly Fee for 1 Adult, Sports And Leisure'){
                $data_prices_to_insert['price_fitness_club'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Apartment (1 bedroom) in City Centre, Rent Per Month'){
                $data_prices_to_insert['apartment_one'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Apartment (3 bedrooms) in City Centre, Rent Per Month'){
                $data_prices_to_insert['apartment_three'] = $response_curl_items_prices_decode_value->average_price;
            }

            if(!empty($response_curl_items_prices_decode_value->item_name) && $response_curl_items_prices_decode_value->item_name === 'Price per Square Meter to Buy Apartment in City Centre, Buy Apartment Price'){
                $data_prices_to_insert['apartment_square_feet'] = $response_curl_items_prices_decode_value->average_price;
            }


        }

        if(!empty($data_prices_to_insert['price_cheap_restaurant'])
            && !empty($data_prices_to_insert['price_expensive_restaurant'])
            && !empty($data_prices_to_insert['price_beer_domestic_restaurant'])
            && !empty($data_prices_to_insert['price_beer_imported_restaurant'])
            && !empty($data_prices_to_insert['price_wine'])
            && !empty($data_prices_to_insert['price_beer_domestic'])
            && !empty($data_prices_to_insert['price_beer_imported'])
            && !empty($data_prices_to_insert['price_transport_one_way'])
            && !empty($data_prices_to_insert['price_transport_monthly'])
            && !empty($data_prices_to_insert['price_taxi_start'])
            && !empty($data_prices_to_insert['price_taxi_one_miles'])
            && !empty($data_prices_to_insert['price_taxi_one_hours_wait'])
            && !empty($data_prices_to_insert['price_basics'])
            && !empty($data_prices_to_insert['price_cinema'])
            && !empty($data_prices_to_insert['price_fitness_club'])
            && !empty($data_prices_to_insert['apartment_one'])
            && !empty($data_prices_to_insert['apartment_three'])
            && !empty($data_prices_to_insert['apartment_square_feet'])){


            //var_dump($data_prices_to_insert);
            //die();


            $app['db']->insert('prices', array(

                    'idNumbeo' => $data_prices_to_insert['city_idNumbeo'],
                    'currency' => $data_prices_to_insert['city_currency'],
                    'price_cheap_restaurant' => $data_prices_to_insert['price_cheap_restaurant'],
                    'price_expensive_restaurant' => $data_prices_to_insert['price_expensive_restaurant'],
                    'price_beer_domestic_restaurant' => $data_prices_to_insert['price_beer_domestic_restaurant'],
                    'price_beer_imported_restaurant' => $data_prices_to_insert['price_beer_imported_restaurant'],
                    'price_wine' => $data_prices_to_insert['price_wine'],
                    'price_beer_domestic' => $data_prices_to_insert['price_beer_domestic'],
                    'price_beer_imported' => $data_prices_to_insert['price_beer_imported'],
                    'price_transport_one_way' => $data_prices_to_insert['price_transport_one_way'],
                    'price_transport_monthly' => $data_prices_to_insert['price_transport_monthly'],
                    'price_taxi_start' => $data_prices_to_insert['price_taxi_start'],
                    'price_taxi_one_miles' => $data_prices_to_insert['price_taxi_one_miles'],
                    'price_taxi_one_hours_wait' => $data_prices_to_insert['price_taxi_one_hours_wait'],
                    'price_basics' => $data_prices_to_insert['price_taxi_one_hours_wait'],
                    'price_cinema' => $data_prices_to_insert['price_cinema'],
                    'price_fitness_club' => $data_prices_to_insert['price_fitness_club'],
                    'apartment_one' => $data_prices_to_insert['apartment_one'],
                    'apartment_three' => $data_prices_to_insert['apartment_three'],
                    'apartment_square_feet' => $data_prices_to_insert['apartment_square_feet']

                )
            );

        }

        //var_dump($data_prices_to_insert);
        //die();


    }

    //die();

});

// recommendation
$app->get('/recommendation', function () use ($app) {
    return $app['twig']->render('recommendation.html.twig');
})->bind('recommendation');

// recommendationResults
$app->post('/recommendationResults', function (Symfony\Component\HttpFoundation\Request $request) use ($app) {


    /*
    var_dump($request->request);
    die();
    */


    //TODO enregistrer les informations du user dans la bdd

    /*
     *      BUILD TABLEAU MOT CLE
     */

    $pillsTAB = array(

        'artvivre' => $request->request->get('artvivre'),
        'solidarite' => $request->request->get('solidarite'),
        'bienetre' => $request->request->get('bienetre'),
        'divertissement' => $request->request->get('divertissement'),
        'histoireculture' => $request->request->get('histoireculture'),
        'amoureux' => $request->request->get('amoureux'),
        'arts' => $request->request->get('arts'),
        'sports' => $request->request->get('sports'),
        'vienocturne' => $request->request->get('vienocturne'),
        'affaires' => $request->request->get('affaires'),
        'aventure' => $request->request->get('aventure'),

    );



    /*
     *      BUILDING USER SCORE
     */

    $user_score_eclater = intval($request->request->get('score_eclate'));
    $user_score_investir = intval($request->request->get('score_investir'));
    $user_score_culture = intval($request->request->get('score_culture'));
    $user_score_humanitaire = intval($request->request->get('score_humanitaire'));

    $user_score_total = $user_score_eclater + $user_score_investir + $user_score_culture + $user_score_humanitaire;

    $user_score_tab = array(

        'éclater' => $user_score_eclater,
        'investir' => $user_score_investir,
        'culture' => $user_score_culture,
        'humanitaire' => $user_score_humanitaire

    );

    $user_score_ratio = array(

        'éclater' => ($user_score_eclater/$user_score_total)*100,
        'investir' => ($user_score_investir/$user_score_total)*100,
        'culture' => ($user_score_culture/$user_score_total)*100,
        'humanitaire' => ($user_score_humanitaire/$user_score_total)*100

    );

    $user_score_maj_numb = max($user_score_tab);
    $user_score_maj_type = array_search(max($user_score_tab), $user_score_tab);

    /*
    var_dump($user_score_tab);
    var_dump($user_score_maj_numb);
    var_dump($user_score_ratio);
    die();
    */

    //var_dump()

    /*
     *      QUERY GLOBALE
     */

    $allPrices = $app['dao.prices']->findAll();
    $cities_scores = array();
    $cities_retained = array();

    foreach ($allPrices as $allPrices_key => $allPrices_value){


        $city_score = array(

            'city_id' => $allPrices_value->getidNumbeo(),
            'eclater' => '',
            'culture' => '',
            'invest' => '',
            'humanitaire' => 0

        );


        /*
         * eclater
         */

        //$score_eclater = 12;
        $score_eclater = 0;
        $score_to_eclater_to_substract = array();

        $currency = $allPrices_value->getcurrency();
        $price_cheap_restaurant = $allPrices_value->getprice_cheap_restaurant();
        $price_beer_domestic_restaurant = $allPrices_value->getprice_beer_domestic_restaurant();
        $price_beer_imported_restaurant = $allPrices_value->getprice_beer_imported_restaurant();
        $price_wine = $allPrices_value->getprice_wine();
        $price_beer_domestic = $allPrices_value->getprice_beer_domestic();
        $price_beer_imported = $allPrices_value->getprice_beer_imported();
        $price_transport_one_way = $allPrices_value->getprice_transport_one_way();
        $price_transport_monthly = $allPrices_value->getprice_transport_monthly();
        $price_taxi_start = $allPrices_value->getprice_taxi_start();
        $price_taxi_one_miles = $allPrices_value->getprice_taxi_one_miles();
        $price_taxi_one_hours_wait = $allPrices_value->getprice_taxi_one_hours_wait();
        $price_fitness_club = $allPrices_value->getprice_fitness_club();

        switch ($currency){
            case 'MAD':
                $price_cheap_restaurant_to_euro = $price_cheap_restaurant*0.0908344;
                $price_beer_domestic_restaurant_to_euro = $price_beer_domestic_restaurant*0.0908344;
                $price_beer_imported_restaurant_to_euro = $price_beer_imported_restaurant*0.0908344;
                $price_wine_to_euro = $price_wine*0.0908344;
                $price_beer_domestic_to_euro = $price_beer_domestic*0.0908344;
                $price_beer_imported_to_euro = $price_beer_imported*0.0908344;
                $price_transport_one_way_to_euro = $price_transport_one_way*0.0908344;
                $price_transport_monthly_to_euro = $price_transport_monthly*0.0908344;
                $price_taxi_start_to_euro = $price_taxi_start*0.0908344;
                $price_taxi_one_miles_to_euro = $price_taxi_one_miles*0.0908344;
                $price_taxi_one_hours_wait_to_euro = $price_taxi_one_hours_wait*0.0908344;
                $price_fitness_club_to_euro = $price_fitness_club*0.0908344;
                break;
            case 'IDR':
                $price_cheap_restaurant_to_euro = $price_cheap_restaurant*0.0000656999;
                $price_beer_domestic_restaurant_to_euro = $price_beer_domestic_restaurant*0.0000656999;
                $price_beer_imported_restaurant_to_euro = $price_beer_imported_restaurant*0.0000656999;
                $price_wine_to_euro = $price_wine*0.0000656999;
                $price_beer_domestic_to_euro = $price_beer_domestic*0.0000656999;
                $price_beer_imported_to_euro = $price_beer_imported*0.0000656999;
                $price_transport_one_way_to_euro = $price_transport_one_way*0.0000656999;
                $price_transport_monthly_to_euro = $price_transport_monthly*0.0000656999;
                $price_taxi_start_to_euro = $price_taxi_start*0.0000656999;
                $price_taxi_one_miles_to_euro = $price_taxi_one_miles*0.0000656999;
                $price_taxi_one_hours_wait_to_euro = $price_taxi_one_hours_wait*0.0000656999;
                $price_fitness_club_to_euro = $price_fitness_club*0.0000656999;
                break;
            case 'CAD':
                $price_cheap_restaurant_to_euro = $price_cheap_restaurant*0.687987;
                $price_beer_domestic_restaurant_to_euro = $price_beer_domestic_restaurant*0.687987;
                $price_beer_imported_restaurant_to_euro = $price_beer_imported_restaurant*0.687987;
                $price_wine_to_euro = $price_wine*0.687987;
                $price_beer_domestic_to_euro = $price_beer_domestic*0.687987;
                $price_beer_imported_to_euro = $price_beer_imported*0.687987;
                $price_transport_one_way_to_euro = $price_transport_one_way*0.687987;
                $price_transport_monthly_to_euro = $price_transport_monthly*0.687987;
                $price_taxi_start_to_euro = $price_taxi_start*0.687987;
                $price_taxi_one_miles_to_euro = $price_taxi_one_miles*0.687987;
                $price_taxi_one_hours_wait_to_euro = $price_taxi_one_hours_wait*0.687987;
                $price_fitness_club_to_euro = $price_fitness_club*0.687987;
                break;
            case 'THB':
                $price_cheap_restaurant_to_euro = $price_cheap_restaurant*0.0258710782;
                $price_beer_domestic_restaurant_to_euro = $price_beer_domestic_restaurant*0.0258710782;
                $price_beer_imported_restaurant_to_euro = $price_beer_imported_restaurant*0.0258710782;
                $price_wine_to_euro = $price_wine*0.0258710782;
                $price_beer_domestic_to_euro = $price_beer_domestic*0.0258710782;
                $price_beer_imported_to_euro = $price_beer_imported*0.0258710782;
                $price_transport_one_way_to_euro = $price_transport_one_way*0.0258710782;
                $price_transport_monthly_to_euro = $price_transport_monthly*0.0258710782;
                $price_taxi_start_to_euro = $price_taxi_start*0.0258710782;
                $price_taxi_one_miles_to_euro = $price_taxi_one_miles*0.0258710782;
                $price_taxi_one_hours_wait_to_euro = $price_taxi_one_hours_wait*0.0258710782;
                $price_fitness_club_to_euro = $price_fitness_club*0.0258710782;
                break;
            default:
                $price_cheap_restaurant_to_euro = $price_cheap_restaurant*1;
                $price_beer_domestic_restaurant_to_euro = $price_beer_domestic_restaurant*1;
                $price_beer_imported_restaurant_to_euro = $price_beer_imported_restaurant*1;
                $price_wine_to_euro = $price_wine*1;
                $price_beer_domestic_to_euro = $price_beer_domestic*1;
                $price_beer_imported_to_euro = $price_beer_imported*1;
                $price_transport_one_way_to_euro = $price_transport_one_way*1;
                $price_transport_monthly_to_euro = $price_transport_monthly*1;
                $price_taxi_start_to_euro = $price_taxi_start*1;
                $price_taxi_one_miles_to_euro = $price_taxi_one_miles*1;
                $price_taxi_one_hours_wait_to_euro = $price_taxi_one_hours_wait*1;
                $price_fitness_club_to_euro = $price_fitness_club*1;
                break;
        }

        if($price_cheap_restaurant_to_euro < 14){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_beer_domestic_restaurant_to_euro < 6){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_beer_imported_restaurant_to_euro < 6){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_wine_to_euro < 6.75){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_beer_domestic_to_euro < 1.89){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_beer_imported_to_euro < 2.14){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_transport_one_way_to_euro < 1.90){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_transport_monthly_to_euro < 73){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_taxi_start_to_euro < 4){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_taxi_one_miles_to_euro < 2.09){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_taxi_one_hours_wait_to_euro < 35){
            array_push($score_to_eclater_to_substract, '1');
        }
        if($price_fitness_club_to_euro < 47.80){
            array_push($score_to_eclater_to_substract, '1');
        }

        $city_final_score_eclater = $score_eclater + count($score_to_eclater_to_substract);

        /*
         * culture
         */

        //$score_culture = 3;
        $score_culture = 0;
        $score_to_substract_to_culture = array();

        $currency = $allPrices_value->getcurrency();
        $price_expensive_restaurant = $allPrices_value->getprice_expensive_restaurant();
        $price_cinema = $allPrices_value->getprice_cinema();
        $price_fitness_club = $allPrices_value->getprice_fitness_club();


        switch ($currency){
            case 'MAD':
                $price_expensive_restaurant_to_euro = $price_expensive_restaurant*0.0908344;
                $price_cinema_to_euro = $price_cinema*0.0908344;
                $price_fitness_club_to_euro = $price_fitness_club*0.0908344;
                break;
            case 'IDR':
                $price_expensive_restaurant_to_euro = $price_expensive_restaurant*0.0000656999;
                $price_cinema_to_euro = $price_cinema*0.0000656999;
                $price_fitness_club_to_euro = $price_fitness_club*0.0000656999;
                break;
            case 'CAD':
                $price_expensive_restaurant_to_euro = $price_expensive_restaurant*0.687987;
                $price_cinema_to_euro = $price_cinema*0.687987;
                $price_fitness_club_to_euro = $price_fitness_club*0.687987;
                break;
            case 'THB':
                $price_expensive_restaurant_to_euro = $price_expensive_restaurant*0.0258710782;
                $price_cinema_to_euro = $price_cinema*0.0258710782;
                $price_fitness_club_to_euro = $price_fitness_club*0.0258710782;
                break;
            default:
                $price_expensive_restaurant_to_euro = $price_expensive_restaurant*1;
                $price_cinema_to_euro = $price_cinema*1;
                $price_fitness_club_to_euro = $price_fitness_club*1;
                break;
        }

        if($price_expensive_restaurant_to_euro < 50){
            array_push($score_to_substract_to_culture, '1');
        }
        if($price_cinema_to_euro < 11){
            array_push($score_to_substract_to_culture, '1');
        }
        if($price_fitness_club_to_euro < 47.80){
            array_push($score_to_substract_to_culture, '1');
        }

        $city_final_score_culture = $score_culture + count($score_to_substract_to_culture);

        /*
         * invest
         */

        //$score_invest = 4;
        $score_invest = 0;
        $score_to_substract_to_invest = array();

        $currency = $allPrices_value->getcurrency();
        $price_basics = $allPrices_value->getprice_basics();
        $apartment_one = $allPrices_value->getapartment_one();
        $apartment_three = $allPrices_value->getapartment_three();
        $apartment_square_feet = $allPrices_value->getapartment_square_feet();

        switch ($currency){
            case 'MAD':
                $price_basics_to_euro = $price_basics*0.0908344;
                $apartment_one_euro = $apartment_one*0.0908344;
                $apartment_three_to_euro = $apartment_three*0.0908344;
                $apartment_square_feet_to_euro = $apartment_square_feet*0.0908344;
                break;
            case 'IDR':
                $price_basics_to_euro = $price_basics*0.0000656999;
                $apartment_one_euro = $apartment_one*0.0000656999;
                $apartment_three_to_euro = $apartment_three*0.0000656999;
                $apartment_square_feet_to_euro = $apartment_square_feet*0.0000656999;
                break;
            case 'CAD':
                $price_basics_to_euro = $price_basics*0.687987;
                $apartment_one_euro = $apartment_one*0.687987;
                $apartment_three_to_euro = $apartment_three*0.687987;
                $apartment_square_feet_to_euro = $apartment_square_feet*0.687987;
                break;
            case 'THB':
                $price_basics_to_euro = $price_basics*0.0258710782;
                $apartment_one_euro = $apartment_one*0.0258710782;
                $apartment_three_to_euro = $apartment_three*0.0258710782;
                $apartment_square_feet_to_euro = $apartment_square_feet*0.0258710782;
                break;
            default:
                $price_basics_to_euro = $price_basics*1;
                $apartment_one_euro = $apartment_one*1;
                $apartment_three_to_euro = $apartment_three*1;
                $apartment_square_feet_to_euro = $apartment_square_feet*1;
                break;
        }


        if($price_basics_to_euro < 160.96){
            array_push($score_to_substract_to_invest, '1');
        }
        if($apartment_one_euro < 1094.62){
            array_push($score_to_substract_to_invest, '1');
        }
        if($apartment_three_to_euro < 2275.00){
            array_push($score_to_substract_to_invest, '1');
        }
        if($apartment_square_feet_to_euro < 894.63){
            array_push($score_to_substract_to_invest, '1');
        }

        $city_final_score_invest = $score_invest + count($score_to_substract_to_invest);




        $city_score['eclater'] = $city_final_score_eclater.'/12';
        $city_score['culture'] = $city_final_score_culture.'/3';
        $city_score['invest'] = $city_final_score_invest.'/5';

        /*
        $city_score['eclater'] = $city_final_score_eclater_ratio = ($city_final_score_eclater/20)*100;
        $city_score['culture'] = $city_final_score_culture_ratio = ($city_final_score_culture/20)*100;
        $city_score['invest'] = $city_final_score_invest_ratio = ($city_final_score_invest/20)*100;
        */

        array_push($cities_scores, $city_score);


    }

    /*
    var_dump($user_score_ratio);
    var_dump($user_score_maj_type);
    var_dump($cities_scores);


    die();
    */

    /*
    var_dump($user_score_tab);
    var_dump($user_score_ratio);
    die();
    */

    //var_dump($cities_scores);


    $cities_to_push = array();

    foreach ($cities_scores as $cities_scores_key => $cities_scores_value){

        //var_dump($cities_scores_value['invest']);

        if($user_score_maj_type === 'éclater'){
            // si c'est un eclater

            if($cities_scores_value['eclater'] === '12/12'){
                // si la ville est parfaite
                array_push($cities_to_push, $cities_scores_value['city_id']);
            }

        }
        if($user_score_maj_type === 'culture'){
            // si c'est un culture

            if($cities_scores_value['culture'] === '3/3'){
                // si la ville est parfaite
                array_push($cities_to_push, $cities_scores_value['city_id']);
            }

        }
        if($user_score_maj_type === 'investir'){
            // si c'est un investir

            if($cities_scores_value['invest'] === '4/5'){
                // si la ville est parfaite
                array_push($cities_to_push, $cities_scores_value['city_id']);
            }

        }
        if($user_score_maj_type === 'humanitaire'){
            // si c'est un humanitaire

            array_push($cities_to_push, $cities_scores_value['city_id']);

        }

    }

    //die();


    /*
    var_dump($cities_to_push);
    die();
    */


    /*
     * divide array in two array
     */

    //var_dump($cities_to_push);

    //var_dump($cities_to_push);
    //die();
    // first array
    $top_five_to_push_key = array_rand($cities_to_push, 10);
    //var_dump($top_five_to_push_key);

    $top_five_to_push_id = array();
    array_push($top_five_to_push_id, $cities_to_push[$top_five_to_push_key[0]]);
    array_push($top_five_to_push_id, $cities_to_push[$top_five_to_push_key[1]]);
    array_push($top_five_to_push_id, $cities_to_push[$top_five_to_push_key[2]]);
    array_push($top_five_to_push_id, $cities_to_push[$top_five_to_push_key[3]]);
    array_push($top_five_to_push_id, $cities_to_push[$top_five_to_push_key[4]]);
    array_push($top_five_to_push_id, $cities_to_push[$top_five_to_push_key[5]]);
    array_push($top_five_to_push_id, $cities_to_push[$top_five_to_push_key[6]]);
    array_push($top_five_to_push_id, $cities_to_push[$top_five_to_push_key[7]]);
    array_push($top_five_to_push_id, $cities_to_push[$top_five_to_push_key[8]]);


    //var_dump($top_five_to_push_id);

    // second array
    unset($cities_to_push[$top_five_to_push_key[0]]);
    unset($cities_to_push[$top_five_to_push_key[1]]);
    unset($cities_to_push[$top_five_to_push_key[2]]);
    unset($cities_to_push[$top_five_to_push_key[3]]);
    unset($cities_to_push[$top_five_to_push_key[4]]);
    unset($cities_to_push[$top_five_to_push_key[5]]);
    unset($cities_to_push[$top_five_to_push_key[6]]);
    unset($cities_to_push[$top_five_to_push_key[7]]);
    unset($cities_to_push[$top_five_to_push_key[8]]);


    //var_dump($cities_to_push);

    //die();

    $cities_top_five_infos_to_push = array();

    $allCities_five = $app['dao.ville']->findAll();
    foreach ($allCities_five as $allCities_key => $allCity_value){

        if(in_array($allCity_value->getidNumbeo(), $top_five_to_push_id)){

            //var_dump($allCity_value);

            $city_infos = array(
                'city_id_numbeo' => $allCity_value->getidNumbeo(),
                'city_name' => $allCity_value->getnomNumbeo(),
                'city_country_name' => $allCity_value->getnomPaysNumbeo()
            );

            array_push($cities_top_five_infos_to_push, $city_infos);

        }

    }

    //die();

    //var_dump($cities_top_five_infos_to_push);


    $cities_infos_to_push = array();

    $allCities = $app['dao.ville']->findAll();
    foreach ($allCities as $allCities_key => $allCity_value){

        if(in_array($allCity_value->getidNumbeo(), $cities_to_push)){

            $city_infos = array(
                'city_id_numbeo' => $allCity_value->getidNumbeo(),
                'city_name' => $allCity_value->getnomNumbeo(),
                'city_country_name' => $allCity_value->getnomPaysNumbeo()
            );

            array_push($cities_infos_to_push, $city_infos);

        }

    }


    //var_dump($cities_infos_to_push);
    //die();



    /*
    $cities_infos = array();
    $city_infos = array(
        'city_id_numbeo' => 6029,
        'city_name' => 'Lisbon',
        'city_country_name' => 'Portugal'
    );
    array_push($cities_infos, $city_infos);
    */

    /*
        var_dump($pillsTAB);
        var_dump(array_rand($cities_infos_to_push));
        var_dump($cities_infos_to_push[array_rand($cities_infos_to_push)]);
        die();

    */

    //var_dump($user_score_maj_type);
    //die();


    return $app['twig']->render('recommendationResults.html.twig', array(
        // on envoie les choix du man
        'pillsTAB'     => $pillsTAB,
        // on envoie son profil
        'user_type' => $user_score_maj_type,
        // on envoie le top 5
        'cities_top_five_to_push' => $cities_top_five_infos_to_push,
        // on envoie les villes
        'cities_infos_to_push' => $cities_infos_to_push
    ));

})->bind('recommendationResults');

// recommendationDetail
$app->post('/recommendationDetail', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {


    //var_dump($request->request);
    //die();


    $user_type = $request->request->get('user_type');
    //var_dump($user_type);

    /*
     *      GETTING INFOS GENERALE
     */
    $city_id = intval($request->request->get('city_id'));
    //var_dump($city_id);
    $thatCityInfos = array(
        'id' => 'id',
        'long' => 'long',
        'lat' => 'lat',
        'idNumbeo' => 'idNumbeo',
        'nomNumbeo' => 'nomNumbeo',
        'nomPaysNumbeo' => 'nomPaysNumbeo'
    );
    $allCities = $app['dao.ville']->findAll();
    foreach ($allCities as $allCities_key => $allCities_value){
        //var_dump($allCities_value->getidNumbeo());
        if(intval($allCities_value->getidNumbeo()) === $city_id){

            $thatCityInfos['id'] = $allCities_value->getId();
            $thatCityInfos['long'] = $allCities_value->getlongitude();
            $thatCityInfos['lat'] = $allCities_value->getlatitude();
            $thatCityInfos['idNumbeo'] = $allCities_value->getidNumbeo();
            $thatCityInfos['nomNumbeo'] = $allCities_value->getnomNumbeo();
            $thatCityInfos['nomPaysNumbeo'] = $allCities_value->getnomPaysNumbeo();

        }
    }

    //var_dump($thatCityInfos);
    //die();


    /*
     *      GETTING PILLS ( PARAMETRE )
     */

    $pillsTAB = array(

        'artvivre' => $request->request->get('artvivre'),
        'solidarite' => $request->request->get('solidarite'),
        'bienetre' => $request->request->get('bienetre'),
        'divertissement' => $request->request->get('divertissement'),
        'histoireculture' => $request->request->get('histoireculture'),
        'amoureux' => $request->request->get('amoureux'),
        'arts' => $request->request->get('arts'),
        'sports' => $request->request->get('sports'),
        'vienocturne' => $request->request->get('vienocturne'),
        'affaires' => $request->request->get('affaires'),
        'aventure' => $request->request->get('aventure'),

    );



    /*
     *      GETTING PLACES ECLATER INFOS
     */

    $url_places_bar = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$thatCityInfos['lat'].','.$thatCityInfos['long'].'&radius=5000&type=bar&key=AIzaSyBHKrTMXenHkW-acn_NOt-dGzboSg-p32E';
    $url_places_casino = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$thatCityInfos['lat'].','.$thatCityInfos['long'].'&radius=5000&type=casino&key=AIzaSyBHKrTMXenHkW-acn_NOt-dGzboSg-p32E';
    $url_places_gym = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$thatCityInfos['lat'].','.$thatCityInfos['long'].'&radius=5000&type=gym&key=AIzaSyBHKrTMXenHkW-acn_NOt-dGzboSg-p32E';
    $url_places_night = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$thatCityInfos['lat'].','.$thatCityInfos['long'].'&radius=5000&type=night_club&key=AIzaSyBHKrTMXenHkW-acn_NOt-dGzboSg-p32E';

    /*
    var_dump($url_places);
    die();
    */

    $places_eclater = array(

        'bar' => '',
        'casino' => '',
        'gym' => '',
        'night_club' => ''

    );

    $barinfostopush = array(
    );

    $casinoinfotopush = array(
    );

    $gyminfostopush = array(
    );

    $nightclubinfostopush = array(
    );

    if($user_type === 'éclater'){

        /*
         *      PUSH UN BAR
         */

        $curl_places_bar = curl_init();
        curl_setopt_array($curl_places_bar, array(
            CURLOPT_URL => $url_places_bar,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response_curl_places_bar = curl_exec($curl_places_bar);
        $err = curl_error($curl_places_bar);
        curl_close($curl_places_bar);
        //var_dump($err);

        $response_curl_places_bar_decode = json_decode($response_curl_places_bar);

        foreach ($response_curl_places_bar_decode->results as $places_results_key => $places_results_value){

//            var_dump($places_results_value);
//            die();

            $barating = '';
            if(property_exists($places_results_value, 'rating')){ $barating = $places_results_value->rating; }else{ $barating ='no info'; }
            $barinfo = array(
                'name' => $places_results_value->name,
                'rating' => $barating,
                'lat' => $places_results_value->geometry->location->lat,
                'lng' => $places_results_value->geometry->location->lng
            );
            array_push($barinfostopush, $barinfo);

        }

        /*
         *      PUSH UN CASINO
         */

        $curl_places_casino = curl_init();
        curl_setopt_array($curl_places_casino, array(
            CURLOPT_URL => $url_places_casino,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response_curl_places_casino = curl_exec($curl_places_casino);
        $err = curl_error($curl_places_casino);
        curl_close($curl_places_casino);
        //var_dump($err);
        $response_curl_places_casino_decode = json_decode($response_curl_places_casino);

        foreach ($response_curl_places_casino_decode->results as $places_results_key => $places_results_value){

            $casrating = '';
            if(property_exists($places_results_value, 'rating')){ $casrating = $places_results_value->rating; }else{ $casrating ='no info'; }

            $casinoinfo = array(
                'name' => $places_results_value->name,
                'rating' => $casrating,
                'lat' => $places_results_value->geometry->location->lat,
                'lng' => $places_results_value->geometry->location->lng
            );
            array_push($casinoinfotopush, $casinoinfo);

        }


        /*
         *      PUSH UN GYM
         */

        $curl_places_gym = curl_init();
        curl_setopt_array($curl_places_gym, array(
            CURLOPT_URL => $url_places_gym,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response_curl_places_gym = curl_exec($curl_places_gym);
        $err = curl_error($curl_places_gym);
        curl_close($curl_places_gym);
        //var_dump($err);
        $response_curl_places_gym_decode = json_decode($response_curl_places_gym);

        foreach ($response_curl_places_gym_decode->results as $places_results_key => $places_results_value){

            $gymrating = '';
            if(property_exists($places_results_value, 'rating')){ $gymrating = $places_results_value->rating; }else{ $gymrating ='no info'; }

            $gyminfo = array(
                'name' => $places_results_value->name,
                'rating' => $gymrating,
                'lat' => $places_results_value->geometry->location->lat,
                'lng' => $places_results_value->geometry->location->lng
            );
            array_push($gyminfostopush, $gyminfo);

        }


        /*
         *      PUSH UN NIGHT CLUB
         */

        $curl_places_night = curl_init();
        curl_setopt_array($curl_places_night, array(
            CURLOPT_URL => $url_places_night,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response_curl_places_night = curl_exec($curl_places_night);
        $err = curl_error($curl_places_night);
        curl_close($curl_places_night);
        //var_dump($err);
        $response_curl_places_night_decode = json_decode($response_curl_places_night);

        foreach ($response_curl_places_night_decode->results as $places_results_key => $places_results_value){

            $nightrating = '';
            if(property_exists($places_results_value, 'rating')){ $nightrating = $places_results_value->rating; }else{ $nightrating ='no info'; }

            $nightinfo = array(
                'name' => $places_results_value->name,
                'rating' => $nightrating,
                'lat' => $places_results_value->geometry->location->lat,
                'lng' => $places_results_value->geometry->location->lng
            );
            array_push($nightclubinfostopush, $nightinfo);

        }

    }

    /*

    var_dump($barinfostopush);
    var_dump($casinoinfotopush);
    var_dump($gyminfostopush);
    var_dump($nightclubinfostopush);

    */

    $places_eclater['bar'] = $barinfostopush;
    $places_eclater['casino'] = $casinoinfotopush;
    $places_eclater['gym'] = $gyminfostopush;
    $places_eclater['night_club'] = $nightclubinfostopush;

    /*

    */



    //var_dump($places_eclater);
    //die();


    /*
     *      GETTING PLACES CULTURE INFOS
     */

    $user_type = $request->request->get('user_type');
    $url_places_art_gallery = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$thatCityInfos['lat'].','.$thatCityInfos['long'].'&radius=5000&type=art_gallery&key=AIzaSyBHKrTMXenHkW-acn_NOt-dGzboSg-p32E';
    $url_places_museum = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$thatCityInfos['lat'].','.$thatCityInfos['long'].'&radius=5000&type=museum&key=AIzaSyBHKrTMXenHkW-acn_NOt-dGzboSg-p32E';
    $url_places_library = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$thatCityInfos['lat'].','.$thatCityInfos['long'].'&radius=5000&type=library&key=AIzaSyBHKrTMXenHkW-acn_NOt-dGzboSg-p32E';
    $url_places_movie_theater = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$thatCityInfos['lat'].','.$thatCityInfos['long'].'&radius=5000&type=movie_theater&key=AIzaSyBHKrTMXenHkW-acn_NOt-dGzboSg-p32E';

    /*
    var_dump($url_places);
    die();
    */

    $places_culture = array(

        'art_gallery' => '',
        'museum' => '',
        'library' => '',
        'movie_theater' => ''

    );

    $art_galleryinfostopush = array(
    );

    $museuminfotopush = array(
    );

    $libraryinfostopush = array(
    );

    $movie_theaterinfostopush = array(
    );


    if($user_type === 'culture'){


        /*
         *      PUSH UN art_gallery
         */

        $curl_places_art = curl_init();
        curl_setopt_array($curl_places_art, array(
            CURLOPT_URL => $url_places_art_gallery,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response_curl_places_art = curl_exec($curl_places_art);
        $err = curl_error($curl_places_art);
        curl_close($curl_places_art);
        //var_dump($err);
        /*
        var_dump($response_curl_places_art);
        die();
        */
        $response_curl_places_art_decode = json_decode($response_curl_places_art);

        foreach ($response_curl_places_art_decode->results as $places_results_key => $places_results_value){

//            var_dump($places_results_value);
//            die();

            $barating = '';
            if(property_exists($places_results_value, 'rating')){ $barating = $places_results_value->rating; }else{ $barating ='no info'; }
            $artinfo = array(
                'name' => $places_results_value->name,
                'rating' => $barating,
                'lat' => $places_results_value->geometry->location->lat,
                'lng' => $places_results_value->geometry->location->lng
            );
            array_push($art_galleryinfostopush, $artinfo);

        }


        /*
         *      PUSH UN museum
         */

        $curl_places_museum = curl_init();
        curl_setopt_array($curl_places_museum, array(
            CURLOPT_URL => $url_places_museum,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response_curl_places_museum = curl_exec($curl_places_museum);
        $err = curl_error($curl_places_museum);
        curl_close($curl_places_museum);
        //var_dump($err);
        /*
        var_dump($response_curl_places_art);
        die();
        */
        $response_curl_places_museum_decode = json_decode($response_curl_places_museum);

        foreach ($response_curl_places_museum_decode->results as $places_results_key => $places_results_value){

//            var_dump($places_results_value);
//            die();

            $barating = '';
            if(property_exists($places_results_value, 'rating')){ $barating = $places_results_value->rating; }else{ $barating ='no info'; }
            $museuminfo = array(
                'name' => $places_results_value->name,
                'rating' => $barating,
                'lat' => $places_results_value->geometry->location->lat,
                'lng' => $places_results_value->geometry->location->lng
            );
            array_push($museuminfotopush, $museuminfo);

        }

        /*
         *      PUSH UN library
         */

        $curl_places_library = curl_init();
        curl_setopt_array($curl_places_library, array(
            CURLOPT_URL => $url_places_library,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response_curl_places_library = curl_exec($curl_places_library);
        $err = curl_error($curl_places_library);
        curl_close($curl_places_library);
        //var_dump($err);
        /*
        var_dump($response_curl_places_art);
        die();
        */
        $response_curl_places_library_decode = json_decode($response_curl_places_library);

        foreach ($response_curl_places_library_decode->results as $places_results_key => $places_results_value){

//            var_dump($places_results_value);
//            die();

            $barating = '';
            if(property_exists($places_results_value, 'rating')){ $barating = $places_results_value->rating; }else{ $barating ='no info'; }
            $libraryinfo = array(
                'name' => $places_results_value->name,
                'rating' => $barating,
                'lat' => $places_results_value->geometry->location->lat,
                'lng' => $places_results_value->geometry->location->lng
            );
            array_push($libraryinfostopush, $libraryinfo);

        }


        /*
         *      PUSH UN movie theatre
         */

        $curl_places_movie = curl_init();
        curl_setopt_array($curl_places_movie, array(
            CURLOPT_URL => $url_places_movie_theater,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response_curl_places_movie = curl_exec($curl_places_movie);
        $err = curl_error($curl_places_movie);
        curl_close($curl_places_movie);
        //var_dump($err);
        /*
        var_dump($response_curl_places_art);
        die();
        */
        $response_curl_places_movie_decode = json_decode($response_curl_places_movie);

        foreach ($response_curl_places_movie_decode->results as $places_results_key => $places_results_value){

//            var_dump($places_results_value);
//            die();

            $barating = '';
            if(property_exists($places_results_value, 'rating')){ $barating = $places_results_value->rating; }else{ $barating ='no info'; }
            $movieinfo = array(
                'name' => $places_results_value->name,
                'rating' => $barating,
                'lat' => $places_results_value->geometry->location->lat,
                'lng' => $places_results_value->geometry->location->lng
            );
            array_push($movie_theaterinfostopush, $movieinfo);

        }



    }


    /*
    var_dump($art_galleryinfostopush);
    var_dump($museuminfotopush);
    var_dump($libraryinfostopush);
    var_dump($movie_theaterinfostopush);
    */


    $places_culture['art_gallery'] = $art_galleryinfostopush;
    $places_culture['museum'] = $museuminfotopush;
    $places_culture['library'] = $libraryinfostopush;
    $places_culture['movie_theater'] = $movie_theaterinfostopush;


    /*
    var_dump($places_culture);
    die();
    */



    /*
     *      GETTING WIKIPEDIA INFOS
     */

    //var_dump($thatCityInfos['nomNumbeo']);
    //die();

    $url_friendly_city_name = '';
    if(preg_match('/\s/',$thatCityInfos['nomNumbeo'])){
        $url_friendly_city_name = str_replace(' ', '%20', $thatCityInfos['nomNumbeo']);
    }else{
        $url_friendly_city_name = $thatCityInfos['nomNumbeo'];
    }

    //$url_friendly_city_name

    $curl_ville_desc = curl_init();
    curl_setopt_array($curl_ville_desc, array(
        CURLOPT_URL => "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=".$url_friendly_city_name,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));
    $response_curl_ville_desc = curl_exec($curl_ville_desc);
    $err = curl_error($curl_ville_desc);
    curl_close($curl_ville_desc);
    $response_curl_ville_desc_decode = json_decode($response_curl_ville_desc);

    $city_desc = '';
    foreach ($response_curl_ville_desc_decode->query->pages as $descpages_key => $descpages_value){
        $city_desc = $descpages_value->extract;
    }
    /*
    var_dump($city_desc);
    die();
    */





    /*
     *      GETTING PRICES
     */


    $eclat_prices = array(

        'price_cheap_restaurant' => '',
        'price_wine' => '',
        'price_beer_domestic' => '',
        'price_taxi_one_miles' => '',
        'price_transport_one_way' => ''

    );

    $culture_prices = array(
        'price_expensive_restaurant' => '',
        'price_cinema' => '',
    );

    //var_dump($thatCityInfos['idNumbeo']);


    $allCitiesPrices = $app['dao.prices']->findAll();
    foreach ($allCitiesPrices as $allCities_key => $allCities_value){

        //var_dump($allCities_value->getidNumbeo());
        //var_dump($allCities_value);

        if($thatCityInfos['idNumbeo'] === $allCities_value->getidNumbeo()){

            //var_dump($allCities_value->getprice_cheap_restaurant);
            //var_dump($allCities_value);

            if($user_type === 'culture'){

                switch ($allCities_value->getcurrency()){
                    case 'MAD':
                        $eclat_prices['price_expensive_restaurant'] = floatval($allCities_value->getprice_expensive_restaurant())*0.0908344;
                        $eclat_prices['price_cinema'] = floatval($allCities_value->getprice_cinema())*0.0908344;
                        break;
                    case 'IDR':
                        $eclat_prices['price_expensive_restaurant'] = floatval($allCities_value->getprice_expensive_restaurant())*0.0000656999;
                        $eclat_prices['price_cinema'] = floatval($allCities_value->getprice_cinema())*0.0000656999;
                        /*
                        $eclat_prices['price_cheap_restaurant'] = floatval($allCities_value->getprice_cheap_restaurant())*0.0000656999;
                        $eclat_prices['price_wine'] = floatval($allCities_value->getprice_wine())*0.0000656999;
                        $eclat_prices['price_beer_domestic'] = floatval($allCities_value->getprice_beer_domestic())*0.0000656999;
                        $eclat_prices['price_taxi_one_miles'] = floatval($allCities_value->getprice_taxi_one_miles())*0.0000656999;
                        $eclat_prices['price_transport_one_way'] = floatval($allCities_value->getprice_transport_one_way())*0.0000656999;
                        */
                        break;
                    case 'CAD':
                        $eclat_prices['price_expensive_restaurant'] = floatval($allCities_value->getprice_expensive_restaurant())*0.687987;
                        $eclat_prices['price_cinema'] = floatval($allCities_value->getprice_cinema())*0.687987;
                        /*
                        $eclat_prices['price_cheap_restaurant'] = floatval($allCities_value->getprice_cheap_restaurant())*0.687987;
                        $eclat_prices['price_wine'] = floatval($allCities_value->getprice_wine())*0.687987;
                        $eclat_prices['price_beer_domestic'] = floatval($allCities_value->getprice_beer_domestic())*0.687987;
                        $eclat_prices['price_taxi_one_miles'] = floatval($allCities_value->getprice_taxi_one_miles())*0.687987;
                        $eclat_prices['price_transport_one_way'] = floatval($allCities_value->getprice_transport_one_way())*0.687987;
                        */
                        /*
                        $price_basics_to_euro = $price_basics*0.687987;
                        $apartment_one_euro = $apartment_one*0.687987;
                        $apartment_three_to_euro = $apartment_three*0.687987;
                        $apartment_square_feet_to_euro = $apartment_square_feet*0.687987;
                        */
                        break;
                    case 'THB':
                        $eclat_prices['price_expensive_restaurant'] = floatval($allCities_value->getprice_expensive_restaurant())*0.0258710782;
                        $eclat_prices['price_cinema'] = floatval($allCities_value->getprice_cinema())*0.0258710782;
                        /*
                                                $eclat_prices['price_cheap_restaurant'] = floatval($allCities_value->getprice_cheap_restaurant())*0.0258710782;
                                                $eclat_prices['price_wine'] = floatval($allCities_value->getprice_wine())*0.0258710782;
                                                $eclat_prices['price_beer_domestic'] = floatval($allCities_value->getprice_beer_domestic())*0.0258710782;
                                                $eclat_prices['price_taxi_one_miles'] = floatval($allCities_value->getprice_taxi_one_miles())*0.0258710782;
                                                $eclat_prices['price_transport_one_way'] = floatval($allCities_value->getprice_transport_one_way())*0.0258710782;
                        */
                        /*
                        $price_basics_to_euro = $price_basics*0.0258710782;
                        $apartment_one_euro = $apartment_one*0.0258710782;
                        $apartment_three_to_euro = $apartment_three*0.0258710782;
                        $apartment_square_feet_to_euro = $apartment_square_feet*0.0258710782;
                        */
                        break;
                    default:
                        $eclat_prices['price_expensive_restaurant'] = floatval($allCities_value->getprice_expensive_restaurant())*1;
                        $eclat_prices['price_cinema'] = floatval($allCities_value->getprice_cinema())*1;
                        /*
                        $eclat_prices['price_cheap_restaurant'] = floatval($allCities_value->getprice_cheap_restaurant())*1;
                        $eclat_prices['price_wine'] = floatval($allCities_value->getprice_wine())*1;
                        $eclat_prices['price_beer_domestic'] = floatval($allCities_value->getprice_beer_domestic())*1;
                        $eclat_prices['price_taxi_one_miles'] = floatval($allCities_value->getprice_taxi_one_miles())*1;
                        $eclat_prices['price_transport_one_way'] = floatval($allCities_value->getprice_transport_one_way())*1;
                        */
                        /*
                                                $price_basics_to_euro = $price_basics*1;
                                                $apartment_one_euro = $apartment_one*1;
                                                $apartment_three_to_euro = $apartment_three*1;
                                                $apartment_square_feet_to_euro = $apartment_square_feet*1;
                        */
                        break;
                }

                //$eclat_prices['curr'] = $allCities_value->getcurrency();


                //$culture_prices['curr'] = $allCities_value->getcurrency();
                //$culture_prices['price_expensive_restaurant'] = $allCities_value->getprice_expensive_restaurant();
                //$culture_prices['price_cinema'] = $allCities_value->getprice_cinema();

            }

            if($user_type === 'éclater'){


                /*
                var_dump($allCities_value->getprice_cheap_restaurant());
                die();
                */

                switch ($allCities_value->getcurrency()){
                    case 'MAD':
                        $eclat_prices['price_cheap_restaurant'] = floatval($allCities_value->getprice_cheap_restaurant())*0.0908344;
                        $eclat_prices['price_wine'] = floatval($allCities_value->getprice_wine())*0.0908344;
                        $eclat_prices['price_beer_domestic'] = floatval($allCities_value->getprice_beer_domestic())*0.0908344;
                        $eclat_prices['price_taxi_one_miles'] = floatval($allCities_value->getprice_taxi_one_miles())*0.0908344;
                        $eclat_prices['price_transport_one_way'] = floatval($allCities_value->getprice_transport_one_way())*0.0908344;
                        break;
                    case 'IDR':
                        $eclat_prices['price_cheap_restaurant'] = floatval($allCities_value->getprice_cheap_restaurant())*0.0000656999;
                        $eclat_prices['price_wine'] = floatval($allCities_value->getprice_wine())*0.0000656999;
                        $eclat_prices['price_beer_domestic'] = floatval($allCities_value->getprice_beer_domestic())*0.0000656999;
                        $eclat_prices['price_taxi_one_miles'] = floatval($allCities_value->getprice_taxi_one_miles())*0.0000656999;
                        $eclat_prices['price_transport_one_way'] = floatval($allCities_value->getprice_transport_one_way())*0.0000656999;
                        break;
                    case 'CAD':
                        $eclat_prices['price_cheap_restaurant'] = floatval($allCities_value->getprice_cheap_restaurant())*0.687987;
                        $eclat_prices['price_wine'] = floatval($allCities_value->getprice_wine())*0.687987;
                        $eclat_prices['price_beer_domestic'] = floatval($allCities_value->getprice_beer_domestic())*0.687987;
                        $eclat_prices['price_taxi_one_miles'] = floatval($allCities_value->getprice_taxi_one_miles())*0.687987;
                        $eclat_prices['price_transport_one_way'] = floatval($allCities_value->getprice_transport_one_way())*0.687987;
                        /*
                        $price_basics_to_euro = $price_basics*0.687987;
                        $apartment_one_euro = $apartment_one*0.687987;
                        $apartment_three_to_euro = $apartment_three*0.687987;
                        $apartment_square_feet_to_euro = $apartment_square_feet*0.687987;
                        */
                        break;
                    case 'THB':
                        $eclat_prices['price_cheap_restaurant'] = floatval($allCities_value->getprice_cheap_restaurant())*0.0258710782;
                        $eclat_prices['price_wine'] = floatval($allCities_value->getprice_wine())*0.0258710782;
                        $eclat_prices['price_beer_domestic'] = floatval($allCities_value->getprice_beer_domestic())*0.0258710782;
                        $eclat_prices['price_taxi_one_miles'] = floatval($allCities_value->getprice_taxi_one_miles())*0.0258710782;
                        $eclat_prices['price_transport_one_way'] = floatval($allCities_value->getprice_transport_one_way())*0.0258710782;
                        /*
                        $price_basics_to_euro = $price_basics*0.0258710782;
                        $apartment_one_euro = $apartment_one*0.0258710782;
                        $apartment_three_to_euro = $apartment_three*0.0258710782;
                        $apartment_square_feet_to_euro = $apartment_square_feet*0.0258710782;
                        */
                        break;
                    default:
                        $eclat_prices['price_cheap_restaurant'] = floatval($allCities_value->getprice_cheap_restaurant())*1;
                        $eclat_prices['price_wine'] = floatval($allCities_value->getprice_wine())*1;
                        $eclat_prices['price_beer_domestic'] = floatval($allCities_value->getprice_beer_domestic())*1;
                        $eclat_prices['price_taxi_one_miles'] = floatval($allCities_value->getprice_taxi_one_miles())*1;
                        $eclat_prices['price_transport_one_way'] = floatval($allCities_value->getprice_transport_one_way())*1;
                        /*
                                                $price_basics_to_euro = $price_basics*1;
                                                $apartment_one_euro = $apartment_one*1;
                                                $apartment_three_to_euro = $apartment_three*1;
                                                $apartment_square_feet_to_euro = $apartment_square_feet*1;
                        */
                        break;
                }

                //$eclat_prices['curr'] = $allCities_value->getcurrency();

                /*
                $eclat_prices['price_cheap_restaurant'] = $allCities_value->getprice_cheap_restaurant();
                $eclat_prices['price_wine'] = $allCities_value->getprice_wine();
                $eclat_prices['price_beer_domestic'] = $allCities_value->getprice_beer_domestic();
                $eclat_prices['price_taxi_one_miles'] = $allCities_value->getprice_taxi_one_miles();
                $eclat_prices['price_transport_one_way'] = $allCities_value->getprice_transport_one_way();
                */

            }

        }

    }


    /*
    var_dump($culture_prices);
    var_dump($eclat_prices);
    die();
    */





    //var_dump($urls_to_push);


    return $app['twig']->render('recommendationDetail.html.twig', array(

        // city info generale
        'thatCityInfos' => $thatCityInfos,
        // user_type
        'user_type' => $user_type,
        //url for background
        //'urls_to_push' => $urls_to_push,
        // pills array
        'pills_array' => $pillsTAB,
        // city desc
        'city_desc' => $city_desc,
        //places eclater
        'places_eclater' => $places_eclater,
        //places culture
        'places_culture' => $places_culture,
        //prices eclater
        'eclat_prices' => $eclat_prices,
        //prices culture
        'culture_prices' => $culture_prices

    ));

})->bind('recommendationDetail');

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