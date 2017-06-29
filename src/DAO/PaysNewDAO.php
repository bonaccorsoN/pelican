<?php

namespace landingSILEX\DAO;

use Doctrine\DBAL\Connection;
use landingSILEX\Custom\PaysNew;

class PaysNewDAO
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
        $sql = "SELECT * FROM paysnew";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $paysnew = array();
        foreach ($result as $row) {
            $paysnewID = $row['id'];
            $paysnew[$paysnewID] = $this->buildPaysNew($row);
        }
        return $paysnew;
    }

    /**
     * Creates an pays object based on a DB row.
     *
     * @param array $row The DB row containing pays data.
     * @return \landingSILEX\Custom\PaysNew
     */
    private function buildPaysNew(array $row) {
        $paysnew = new PaysNew();
        $paysnew->setId($row['id']);
        $paysnew->setNomPays($row['NomPays']);
        $paysnew->setClimat($row['climat']);
        $paysnew->setDistanceToFrance($row['distanceFrance']);
        $paysnew->setCoutMensuelPays($row['coutMensuelPays']);
        return $paysnew;
    }
}