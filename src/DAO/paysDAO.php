<?php

namespace landingSILEX\DAO;

use Doctrine\DBAL\Connection;
use landingSILEX\Custom\Pays;

class PaysDAO
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
     * Return a list of all pays, sorted by date (most recent first).
     *
     * @return array A list of all pays.
     */
    public function findAll() {
        $sql = "SELECT * FROM pays";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $pays = array();
        foreach ($result as $row) {
            $paysID = $row['pays_id'];
            $pays[$paysID] = $this->buildPays($row);
        }
        return $pays;
    }

    /**
     * Creates an pays object based on a DB row.
     *
     * @param array $row The DB row containing pays data.
     * @return \landingSILEX\Custom\Pays
     */
    private function buildPays(array $row) {
        $pays = new Pays();
        $pays->setId($row['pays_id']);
        $pays->setName($row['pays_name']);
        $pays->setClimat($row['pays_climat']);
        $pays->setDistanceToFrance($row['pays_distanceToFrance']);
        $pays->setIndice($row['pays_indice']);
        return $pays;
    }
}