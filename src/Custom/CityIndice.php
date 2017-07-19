<?php

/*
 * class pays
 */

namespace landingSILEX\Custom;

class CityIndice
{

    /**
     * CityIndice city_id.
     *
     * @var integer
     */
    private $city_id;

    /**
     * CityIndice gmap_id.
     *
     * @var string
     */
    private $gmap_id;

    /**
     * CityIndice gmap_formatted_address.
     *
     * @var string
     */
    private $gmap_formatted_address;

    /**
     * CityIndice gmap_lat.
     *
     * @var float
     */
    private $gmap_lat;

    /**
     * CityIndice gmap_lng.
     *
     * @var float
     */
    private $gmap_lng;

    /**
     * CityIndice health_care_index.
     *
     * @var float
     */
    private $health_care_index;

    /**
     * CityIndice crime_index.
     *
     * @var float
     */
    private $crime_index;

    /**
     * CityIndice traffic_time_index.
     *
     * @var float
     */
    private $traffic_time_index;

    /**
     * CityIndice purchasing_power_incl_rent_index.
     *
     * @var float
     */
    private $purchasing_power_incl_rent_index;

    /**
     * CityIndice cpi_index.
     *
     * @var float
     */
    private $cpi_index;

    /**
     * CityIndice pollution_index.
     *
     * @var float
     */
    private $pollution_index;

    /**
     * CityIndice traffic_index.
     *
     * @var float
     */
    private $traffic_index;

    /**
     * CityIndice quality_of_life_index.
     *
     * @var float
     */
    private $quality_of_life_index;

    /**
     * CityIndice cpi_and_rent_index.
     *
     * @var float
     */
    private $cpi_and_rent_index;

    /**
     * CityIndice groceries_index.
     *
     * @var float
     */
    private $groceries_index;

    /**
     * CityIndice safety_index.
     *
     * @var float
     */
    private $safety_index;

    /**
     * CityIndice city_name.
     *
     * @var string
     */
    private $city_name;

    /**
     * CityIndice rent_index.
     *
     * @var float
     */
    private $rent_index;

    /**
     * CityIndice traffic_co2_index.
     *
     * @var float
     */
    private $traffic_co2_index;

    /**
     * CityIndice restaurant_price_index.
     *
     * @var float
     */
    private $restaurant_price_index;

    /**
     * CityIndice traffic_inefficiency_index.
     *
     * @var float
     */
    private $traffic_inefficiency_index;

    /**
     * CityIndice property_price_to_income_ratio.
     *
     * @var float
     */
    private $property_price_to_income_ratio;



    public function getcity_id() {
        return $this->city_id;
    }

    public function setcity_id($city_id) {
        $this->city_id = $city_id;
        return $this;
    }


    public function getgmap_id() {
        return $this->gmap_id;
    }

    public function setgmap_id($gmap_id) {
        $this->gmap_id = $gmap_id;
        return $this;
    }

    public function getgmap_formatted_address() {
        return $this->gmap_formatted_address;
    }

    public function setgmap_formatted_address($gmap_formatted_address) {
        $this->gmap_formatted_address = $gmap_formatted_address;
        return $this;
    }

    public function getgmap_lat() {
        return $this->gmap_lat;
    }

    public function setgmap_lat($gmap_lat) {
        $this->gmap_lat = $gmap_lat;
        return $this;
    }

    public function getgmap_lng() {
        return $this->gmap_lng;
    }

    public function setgmap_lng($gmap_lng) {
        $this->gmap_lng = $gmap_lng;
        return $this;
    }

    public function gethealth_care_index() {
        return $this->health_care_index;
    }

    public function sethealth_care_index($health_care_index) {
        $this->health_care_index = $health_care_index;
        return $this;
    }

    public function getcrime_index() {
        return $this->crime_index;
    }

    public function setcrime_index($crime_index) {
        $this->crime_index = $crime_index;
        return $this;
    }

    public function gettraffic_time_index() {
        return $this->traffic_time_index;
    }

    public function settraffic_time_index($traffic_time_index) {
        $this->traffic_time_index = $traffic_time_index;
        return $this;
    }

    public function getpurchasing_power_incl_rent_index() {
        return $this->purchasing_power_incl_rent_index;
    }

    public function setpurchasing_power_incl_rent_index($purchasing_power_incl_rent_index) {
        $this->purchasing_power_incl_rent_index = $purchasing_power_incl_rent_index;
        return $this;
    }

    public function getcpi_index() {
        return $this->cpi_index;
    }

    public function setcpi_index($cpi_index) {
        $this->cpi_index = $cpi_index;
        return $this;
    }
    public function getpollution_index() {
        return $this->pollution_index;
    }

    public function setpollution_index($pollution_index) {
        $this->pollution_index = $pollution_index;
        return $this;
    }
    public function gettraffic_index() {
        return $this->traffic_index;
    }

    public function settraffic_index($traffic_index) {
        $this->traffic_index = $traffic_index;
        return $this;
    }
    public function getquality_of_life_index() {
        return $this->quality_of_life_index;
    }

    public function setquality_of_life_index($quality_of_life_index) {
        $this->quality_of_life_index = $quality_of_life_index;
        return $this;
    }
    public function getcpi_and_rent_index() {
        return $this->cpi_and_rent_index;
    }

    public function setcpi_and_rent_index($cpi_and_rent_index) {
        $this->cpi_and_rent_index = $cpi_and_rent_index;
        return $this;
    }
    public function getgroceries_index() {
        return $this->groceries_index;
    }

    public function setgroceries_index($groceries_index) {
        $this->groceries_index = $groceries_index;
        return $this;
    }
    public function getsafety_index() {
        return $this->safety_index;
    }

    public function setsafety_index($safety_index) {
        $this->safety_index = $safety_index;
        return $this;
    }

    public function getcity_name() {
        return $this->city_name;
    }

    public function setcity_name($city_name) {
        $this->city_name = $city_name;
        return $this;
    }

    public function getrent_index() {
        return $this->rent_index;
    }

    public function setrent_index($rent_index) {
        $this->rent_index = $rent_index;
        return $this;
    }

    public function gettraffic_co2_index() {
        return $this->traffic_co2_index;
    }

    public function settraffic_co2_index($traffic_co2_index) {
        $this->traffic_co2_index = $traffic_co2_index;
        return $this;
    }

    public function getrestaurant_price_index() {
        return $this->restaurant_price_index;
    }

    public function setrestaurant_price_index($restaurant_price_index) {
        $this->restaurant_price_index = $restaurant_price_index;
        return $this;
    }

    public function gettraffic_inefficiency_index() {
        return $this->traffic_inefficiency_index;
    }

    public function settraffic_inefficiency_index($traffic_inefficiency_index) {
        $this->traffic_inefficiency_index = $traffic_inefficiency_index;
        return $this;
    }

    public function getproperty_price_to_income_ratio() {
        return $this->property_price_to_income_ratio;
    }

    public function setproperty_price_to_income_ratio($property_price_to_income_ratio) {
        $this->property_price_to_income_ratio = $property_price_to_income_ratio;
        return $this;
    }


}