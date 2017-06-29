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
    return $request;
})->bind('results');