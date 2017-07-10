<?php

namespace landingSILEX\DAO;

use Doctrine\DBAL\Connection;
use landingSILEX\Custom\Ville;

class VilleDAO
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
        $sql = "SELECT * FROM ville";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $ville = array();
        foreach ($result as $row) {
            $villeID = $row['id'];
            $ville[$villeID] = $this->buildVille($row);
        }
        return $ville;
    }

    /**
     * Creates an pays object based on a DB row.
     *
     * @param array $row The DB row containing pays data.
     * @return \landingSILEX\Custom\Ville
     */
    private function buildVille(array $row) {

        $ville = new Ville();
        $ville->setId($row['id']);
        $ville->setlongitude($row['longitude']);
        $ville->setlatitude($row['latitude']);
        $ville->setidNumbeo($row['idNumbeo']);
        $ville->setnomNumbeo($row['nomNumbeo']);
        $ville->setnomPaysNumbeo($row['nomPaysNumbeo']);
        return $ville;

    }
}