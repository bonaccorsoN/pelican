<?php

// Home page
$app->get('/', function () use ($app) {
    $pays_multiple = $app['dao.pays']->findAll();
    return $app['twig']->render('homepage.html.twig', array('pays_multiple' => $pays_multiple));
});