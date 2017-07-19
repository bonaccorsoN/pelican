<?php

// homepage
$app->get('/', function () use ($app) {
    return $app['twig']->render('homepage.html.twig');
})->bind('home');

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

// v0
$app->get('/v0', function () use ($app) {
    return $app['twig']->render('v0.html.twig');
})->bind('v0');

// v1
$app->get('/v1', function () use ($app) {
    return $app['twig']->render('v1.html.twig');
})->bind('v1');

// v2
$app->get('/v2', function () use ($app) {
    return $app['twig']->render('v2.html.twig');
})->bind('v2');