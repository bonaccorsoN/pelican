<?php

namespace landingSILEX\DAO;

use landingSILEX\Custom\Prices;
use Doctrine\DBAL\Connection;


class PricesDAO
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
        $sql = "SELECT * FROM prices";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $prices = array();
        foreach ($result as $row) {
            $pricesID = $row['id'];
            $prices[$pricesID] = $this->buildPrices($row);
        }
        return $prices;
    }

    /**
     * Creates an pays object based on a DB row.
     *
     * @param array $row The DB row containing pays data.
     * @return \landingSILEX\Custom\Prices
     */
    private function buildPrices(array $row) {

        $prices = new Prices();
        $prices->setid($row['id']);
        $prices->setidNumbeo($row['idNumbeo']);
        $prices->setcurrency($row['currency']);
        $prices->setprice_cheap_restaurant($row['price_cheap_restaurant']);
        $prices->setprice_expensive_restaurant($row['price_expensive_restaurant']);
        $prices->setprice_beer_domestic_restaurant($row['price_beer_domestic_restaurant']);
        $prices->setprice_beer_imported_restaurant($row['price_beer_imported_restaurant']);
        $prices->setprice_wine($row['price_wine']);
        $prices->setprice_beer_domestic($row['price_beer_domestic']);
        $prices->setprice_beer_imported($row['price_beer_imported']);
        $prices->setprice_transport_one_way($row['price_transport_one_way']);
        $prices->setprice_transport_monthly($row['price_transport_monthly']);
        $prices->setprice_taxi_start($row['price_taxi_start']);
        $prices->setprice_taxi_one_miles($row['price_taxi_one_miles']);
        $prices->setprice_taxi_one_hours_wait($row['price_taxi_one_hours_wait']);
        $prices->setprice_basics($row['price_basics']);
        $prices->setprice_cinema($row['price_cinema']);
        $prices->setprice_fitness_club($row['price_fitness_club']);

        $prices->setapartment_one($row['apartment_one']);
        $prices->setapartment_three($row['apartment_three']);
        $prices->setapartment_square_feet($row['apartment_square_feet']);


        return $prices;

    }
}