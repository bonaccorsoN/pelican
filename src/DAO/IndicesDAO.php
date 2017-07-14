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
        $sql = "SELECT * FROM indices";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $indices = array();
        foreach ($result as $row) {
            $indicesID = $row['id'];
            $indices[$indicesID] = $this->buildCityIndice($row);
        }
        return $indices;
    }

    /**
     * Creates an pays object based on a DB row.
     *
     * @param array $row The DB row containing pays data.
     * @return \landingSILEX\Custom\Indices
     */
    private function buildCityIndice(array $row) {
        $indices = new Indices();
        $indices->setid($row['id']);
        $indices->setidNumbeo($row['idNumbeo']);
        $indices->sethealth_care_index($row['health_care_index']);
        $indices->setcrime_index($row['crime_index']);
        $indices->setdrinking_water_quality_accessibility($row['drinking_water_quality_accessibility']);
        $indices->setwater_pollution($row['water_pollution']);
        $indices->setcpi_index($row['cpi_index']);
        $indices->setpollution_index($row['pollution_index']);
        $indices->setair_quality($row['air_quality']);
        return $indices;
    }
}