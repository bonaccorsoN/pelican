<?php

namespace landingSILEX\DAO;

use Doctrine\DBAL\Connection;
use landingSILEX\Custom\Destination;

class DestinationDAO
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
        $sql = "SELECT * FROM destination";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $destination = array();
        foreach ($result as $row) {
            $destinationID = $row['id'];
            $destination[$destinationID] = $this->buildDestination($row);
        }
        return $destination;
    }

    /**
     * Creates an pays object based on a DB row.
     *
     * @param array $row The DB row containing pays data.
     * @return \landingSILEX\Custom\Destination
     */
    private function buildDestination(array $row) {
        $destination = new Destination();
        $destination->setId($row['id']);
        $destination->setidUser($row['idUser']);
        $destination->setnomVille($row['nomVille']);
        return $destination;
    }
}