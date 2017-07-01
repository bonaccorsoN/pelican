<?php


// homepage
$app->get('/', function () use ($app) {
    //$pays_multiple = $app['dao.pays']->findAll();
    //return $app['twig']->render('homepage.html.twig', array('pays_multiple' => $pays_multiple));
    return $app['twig']->render('homepage.html.twig');
})->bind('home');

// assitant
$app->get('/assistant', function () use ($app) {
    return $app['twig']->render('assistant.html.twig');
})->bind('assistant');

// results
$app->post('/results', function (Symfony\Component\HttpFoundation\Request $request) use ($app) {

    // declaration de variables
    $finder_gender =$request->get('finder_gender');
    $finder_age = $request->get('finder_age');
    $finder_avis = $request->get('finder_avis');
    $finder_distance = $request->get('finder_distance');
    $finder_climat = $request->get('finder_climat');
    $finder_budget = $request->get('finder_budget');

    /*
     * TRIER PAR RAPPORT AU BUDGET -> 1ERE ETAPE
     */

    $paysToPushBudget = array();

    // setup des tranches budget

    $budget_tranches = '';

        // tranches budgets
        if ( $finder_budget <= 500) {
            // T1
            $budget_tranches = 'T1';
        } elseif ($finder_budget > 500 && $finder_budget <= 1000){
            // T2
            $budget_tranches = 'T2';
        } elseif ($finder_budget > 1000 && $finder_budget <= 1500){
            // T3
            $budget_tranches = 'T3';
        } elseif ($finder_budget > 1500 && $finder_budget <= 1800){
            // T4
            $budget_tranches = 'T4';
        } else {
            // budget de dinguo
            $budget_tranches = 'DEGLINGUO';
        }

        // request indice ( cpi_and_rent_index ) par rapport aux tranches

        $city_indice = $app['dao.cityIndice']->findAll();
        foreach ($city_indice as $city_indice_key => $city_indice_value){

            if($city_indice_value->getcpi_and_rent_index() === NULL){

                //if NULL

            }else{


                if($budget_tranches === 'T1'){

                    if(floatval($city_indice_value->getcpi_and_rent_index()) >= 0 && floatval($city_indice_value->getcpi_and_rent_index()) < 32) {


                        $paysToPushBudget[$city_indice_key]['city_id'] = $city_indice_value->getcity_id();
                        $paysToPushBudget[$city_indice_key]['city_name'] = $city_indice_value->getcity_name();
                        //var_dump($paysToPushBudget);
                        //var_dump('JE SUIS T1');
                        //var_dump(floatval($city_indice_value->getcpi_and_rent_index()));
                    }

                }elseif($budget_tranches === 'T2'){

                    if(floatval($city_indice_value->getcpi_and_rent_index()) >= 32 && floatval($city_indice_value->getcpi_and_rent_index()) < 64) {

                        $paysToPushBudget[$city_indice_key]['city_id'] = $city_indice_value->getcity_id();
                        $paysToPushBudget[$city_indice_key]['city_name'] = $city_indice_value->getcity_name();
                        //var_dump($paysToPushBudget);
                        //var_dump('JE SUIS T2');
                        //var_dump(floatval($city_indice_value->getcpi_and_rent_index()));
                    }

                }elseif($budget_tranches === 'T3'){

                    if (floatval($city_indice_value->getcpi_and_rent_index()) >= 64 && floatval($city_indice_value->getcpi_and_rent_index()) < 96) {

                        $paysToPushBudget[$city_indice_key]['city_id'] = $city_indice_value->getcity_id();
                        $paysToPushBudget[$city_indice_key]['city_name'] = $city_indice_value->getcity_name();
                        //var_dump($paysToPushBudget);
                        //var_dump('JE SUIS T3');
                        //var_dump(floatval($city_indice_value->getcpi_and_rent_index()));
                    }

                }elseif($budget_tranches === 'T4'){

                    if (floatval($city_indice_value->getcpi_and_rent_index()) >= 96) {

                        $paysToPushBudget[$city_indice_key]['city_id'] = $city_indice_value->getcity_id();
                        $paysToPushBudget[$city_indice_key]['city_name'] = $city_indice_value->getcity_name();
                        //var_dump($paysToPushBudget);
                        //var_dump('JE SUIS T4');
                        //var_dump(floatval($city_indice_value->getcpi_and_rent_index()));
                    }

                }

            }

        }

    // tableau des villes qui rentre dans la catégorie de prix 
    var_dump($paysToPushBudget);
    die();



    /*
     * TRIER PAR RAPPORT A LA DISTANCE 2EME ETAPE
     */

    // calcul kilom

/*
    class POI {
        private $latitude;
        private $longitude;
        public function __construct($latitude, $longitude) {
            $this->latitude = deg2rad($latitude);
            $this->longitude = deg2rad($longitude);
        }
        public function getLatitude(){return $this->latitude;}
        public function getLongitude(){return $this->longitude;}
        public function getDistanceInMetersTo(POI $other) {
            $radiusOfEarth = 6371000;// Earth's radius in meters.
            $diffLatitude = $other->getLatitude() - $this->latitude;
            $diffLongitude = $other->getLongitude() - $this->longitude;
            $a = sin($diffLatitude / 2) * sin($diffLatitude / 2) +
                cos($this->latitude) * cos($other->getLatitude()) *
                sin($diffLongitude / 2) * sin($diffLongitude / 2);
            $c = 2 * asin(sqrt($a));
            $distance = $radiusOfEarth * $c;
            return $distance;
        }
    }
*/

    /*
    foreach ($paysToPushBudget as $paysToPushBudget_key => $paysToPushBudget_value){
        if($city_indice->getcity_id() === $paysToPushBudget_value['city_id']){
            var_dump($city_indice->getcity_id());
        }
    }
    */

    //var_dump($city_indice);
    //var_dump($paysToPushBudget);

    // setup distance tranche

    //$paysToPushBudgetDistance = array();

    /*
    var_dump($finder_distance);
    die();
    */

    //$distance_tranches;

/*

    foreach ($paysToPushBudget as $paysToPushBudget_key => $paysToPushBudget_value){


        $bdd = new POI($city_indice[$paysToPushBudget_key]->getgmap_lat(), $city_indice[$paysToPushBudget_key]->getgmap_lng());
        $paris = new POI(48,86471, 2.34901);

        if($finder_distance === 'pasloin'){

            if(($bdd->getDistanceInMetersTo($paris) / 1000) < 2000){
                var_dump($paysToPushBudget_value);
            }

        }elseif($finder_distance === 'loin'){

            if(($bdd->getDistanceInMetersTo($paris) / 1000) >= 2000){
                var_dump($paysToPushBudget_value);
            }

        }else{

            var_dump('else');

        }

    }

*/

    /*
    $bdd = new POI(50.454660, 30.523800);
    $paris = new POI(48,86471, 2.34901);
    var_dump($bdd->getDistanceInMetersTo($paris) / 1000);
    */

    /*
    foreach ($city_indice as $city_indice_key => $city_indice_value){
        var_dump($city_indice_value->getgmap_lat());
        die();
    }
    */




    //echo $user->getDistanceInMetersTo($poi);


    // setup des tranches distance




    /*
    foreach ($paysToPushBudget as $paysToPushBudget_key => $paysToPushBudget_value) {

        $city_name_array = explode(',', $paysToPushBudget_value['city_name']);

        $curl_city_data = curl_init();
        curl_setopt_array($curl_city_data, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?address=".$city_name_array[0]."&key=AIzaSyBHINkbrm1lT1QyomQpM_X6qcYVJEnoR3c",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response_city_data = curl_exec($curl_city_data);
        $err = curl_error($curl_city_data);
        curl_close($curl_city_data);

        var_dump(json_decode($response_city_data));
        die();

    }
    */



    //var_dump($paysToPushBudget);

    //API call for prices of the first city

    /*
    $curl_city_data = curl_init();
    curl_setopt_array($curl_city_data, array(
        CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=YOUR_API_KEY",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));
    $response_city_data = curl_exec($curl_city_data);
    $err = curl_error($curl_city_data);
    curl_close($curl_city_data);
    */





    //return new \Symfony\Component\HttpFoundation\Response();

})->bind('results');