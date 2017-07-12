<?php

namespace landingSILEX\DAO;

use Doctrine\DBAL\Connection;
use landingSILEX\Custom\Indices;

class IndicesDAO
{
    /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
    public function __construct(Connection $db) {
        $this->db = $db;
    }

    /**
     * Return a list of all city indice, sorted by date (most recent first).
     *
     * @return array A list of all city indice.
     */
    public function findAll() {
        $sql = "SELECT * FROM city_indice";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $city_indices = array();
        foreach ($result as $row) {
            $city_indiceID = $row['city_id'];
            $city_indices[$city_indiceID] = $this->buildCityIndice($row);
        }
        return $city_indices;
    }

    /**
     * Creates an pays object based on a DB row.
     *
     * @param array $row The DB row containing pays data.
     * @return \landingSILEX\Custom\Indices
     */
    private function buildCityIndice(array $row) {
        $city_indice = new Indices();
        $city_indice->setcity_id($row['city_id']);
        $city_indice->setgmap_id($row['gmap_id']);
        $city_indice->setgmap_formatted_address($row['gmap_formatted_address']);
        $city_indice->setgmap_lat($row['gmap_lat']);
        $city_indice->setgmap_lng($row['gmap_lng']);
        $city_indice->sethealth_care_index($row['health_care_index']);
        $city_indice->setcrime_index($row['crime_index']);
        $city_indice->settraffic_time_index($row['traffic_time_index']);
        $city_indice->setpurchasing_power_incl_rent_index($row['purchasing_power_incl_rent_index']);
        $city_indice->setcpi_index($row['cpi_index']);
        $city_indice->setpollution_index($row['pollution_index']);
        $city_indice->settraffic_index($row['traffic_index']);
        $city_indice->setquality_of_life_index($row['quality_of_life_index']);
        $city_indice->setcpi_and_rent_index($row['cpi_and_rent_index']);
        $city_indice->setgroceries_index($row['groceries_index']);
        $city_indice->setsafety_index($row['safety_index']);
        $city_indice->setcity_name($row['city_name']);
        $city_indice->setrent_index($row['rent_index']);
        $city_indice->settraffic_co2_index($row['traffic_co2_index']);
        $city_indice->setrestaurant_price_index($row['restaurant_price_index']);
        $city_indice->settraffic_inefficiency_index($row['traffic_inefficiency_index']);
        $city_indice->setproperty_price_to_income_ratio($row['property_price_to_income_ratio']);
        return $city_indice;
    }
}