<?php

namespace landingSILEX\Custom;


class prices
{
    /**
     * Prices id.
     *
     * @var integer
     */
    private $id;

    /**
     * Prices idNumbeo.
     *
     * @var integer
     */
    private $idNumbeo;

    /**
     * Prices currency.
     *
     * @var string
     */
    private $currency;

    /**
     * Prices 	price_cheap_restaurant.
     *
     * @var float
     */
    private $price_cheap_restaurant;

    /**
     * Prices 	price_expensive_restaurant.
     *
     * @var float
     */
    private $price_expensive_restaurant;

    /**
     * Prices 	price_beer_domestic_restaurant.
     *
     * @var float
     */
    private $price_beer_domestic_restaurant;

    /**
     * Prices 	price_beer_imported_restaurant.
     *
     * @var float
     */
    private $price_beer_imported_restaurant;

    /**
     * Prices   price_wine.
     *
     * @var float
     */
    private $price_wine;

    /**
     * Prices 	price_beer_domestic.
     *
     * @var float
     */
    private $price_beer_domestic;

    /**
     * Prices 	price_beer_imported.
     *
     * @var float
     */
    private $price_beer_imported;

    /**
     * Prices 	price_transport_one_way.
     *
     * @var float
     */
    private $price_transport_one_way;

    /**
     * Prices 	price_transport_monthly.
     *
     * @var float
     */
    private $price_transport_monthly;

    /**
     * Prices 	price_taxi_start.
     *
     * @var float
     */
    private $price_taxi_start;

    /**
     * Prices 	price_taxi_one_miles.
     *
     * @var float
     */
    private $price_taxi_one_miles;

    /**
     * Prices 	price_taxi_one_hours_wait.
     *
     * @var float
     */
    private $price_taxi_one_hours_wait;

    /**
     * Prices 	price_basics.
     *
     * @var float
     */
    private $price_basics;

    /**
     * Prices 	price_cinema.
     *
     * @var float
     */
    private $price_cinema;

    /**
     * Prices 	price_fitness_club.
     *
     * @var float
     */
    private $price_fitness_club;

    /**
     * Prices 	apartment_one.
     *
     * @var float
     */
    private $apartment_one;

    /**
     * Prices 	apartment_three.
     *
     * @var float
     */
    private $apartment_three;

    /**
     * Prices 	apartment_square_feet.
     *
     * @var float
     */
    private $apartment_square_feet;


    public function getId() {
        return $this->id;
    }

    public function setid($id) {
        $this->id = $id;
        return $this;
    }

    public function getidNumbeo() {
        return $this->idNumbeo;
    }

    public function setidNumbeo($idNumbeo) {
        $this->idNumbeo = $idNumbeo;
        return $this;
    }

    public function getcurrency() {
        return $this->currency;
    }

    public function setcurrency($currency) {
        $this->currency = $currency;
        return $this;
    }

    public function getprice_cheap_restaurant() {
        return $this->price_cheap_restaurant;
    }

    public function setprice_cheap_restaurant($price_cheap_restaurant) {
        $this->price_cheap_restaurant = $price_cheap_restaurant;
        return $this;
    }

    public function getprice_expensive_restaurant() {
        return $this->price_expensive_restaurant;
    }

    public function setprice_expensive_restaurant($price_expensive_restaurant) {
        $this->price_expensive_restaurant = $price_expensive_restaurant;
        return $this;
    }

    public function getprice_beer_domestic_restaurant() {
        return $this->price_beer_domestic_restaurant;
    }

    public function setprice_beer_domestic_restaurant($price_beer_domestic_restaurant) {
        $this->price_beer_domestic_restaurant = $price_beer_domestic_restaurant;
        return $this;
    }

    public function getprice_beer_imported_restaurant() {
        return $this->price_beer_imported_restaurant;
    }

    public function setprice_beer_imported_restaurant($price_beer_imported_restaurant) {
        $this->price_beer_imported_restaurant = $price_beer_imported_restaurant;
        return $this;
    }

    public function getprice_wine() {
        return $this->price_wine;
    }

    public function setprice_wine($price_wine) {
        $this->price_wine = $price_wine;
        return $this;
    }

    public function getprice_beer_domestic() {
        return $this->price_beer_domestic;
    }

    public function setprice_beer_domestic($price_beer_domestic) {
        $this->price_beer_domestic = $price_beer_domestic;
        return $this;
    }

    public function getprice_beer_imported() {
        return $this->price_beer_imported;
    }

    public function setprice_beer_imported($price_beer_imported) {
        $this->price_beer_imported = $price_beer_imported;
        return $this;
    }

    public function getprice_transport_one_way() {
        return $this->price_transport_one_way;
    }

    public function setprice_transport_one_way($price_transport_one_way) {
        $this->price_transport_one_way = $price_transport_one_way;
        return $this;
    }

    public function getprice_transport_monthly() {
        return $this->price_transport_monthly;
    }

    public function setprice_transport_monthly($price_transport_monthly) {
        $this->price_transport_monthly = $price_transport_monthly;
        return $this;
    }

    public function getprice_taxi_start() {
        return $this->price_taxi_start;
    }

    public function setprice_taxi_start($price_taxi_start) {
        $this->price_taxi_start = $price_taxi_start;
        return $this;
    }

    public function getprice_taxi_one_miles() {
        return $this->price_taxi_one_miles;
    }

    public function setprice_taxi_one_miles($price_taxi_one_miles) {
        $this->price_taxi_one_miles = $price_taxi_one_miles;
        return $this;
    }

    public function getprice_taxi_one_hours_wait() {
        return $this->price_taxi_one_hours_wait;
    }

    public function setprice_taxi_one_hours_wait($price_taxi_one_hours_wait) {
        $this->price_taxi_one_hours_wait = $price_taxi_one_hours_wait;
        return $this;
    }

    public function getprice_basics() {
        return $this->price_basics;
    }

    public function setprice_basics($price_basics) {
        $this->price_basics = $price_basics;
        return $this;
    }

    public function getprice_cinema() {
        return $this->price_cinema;
    }

    public function setprice_cinema($price_cinema) {
        $this->price_cinema = $price_cinema;
        return $this;
    }

    public function getprice_fitness_club() {
        return $this->price_fitness_club;
    }

    public function setprice_fitness_club($price_fitness_club) {
        $this->price_fitness_club = $price_fitness_club;
        return $this;
    }



    public function getapartment_one() {
        return $this->apartment_one;
    }

    public function setapartment_one($apartment_one) {
        $this->apartment_one = $apartment_one;
        return $this;
    }

    public function getapartment_three() {
        return $this->apartment_three;
    }

    public function setapartment_three($apartment_three) {
        $this->apartment_three = $apartment_three;
        return $this;
    }

    public function getapartment_square_feet() {
        return $this->apartment_square_feet;
    }

    public function setapartment_square_feet($apartment_square_feet) {
        $this->apartment_square_feet = $apartment_square_feet;
        return $this;
    }

}