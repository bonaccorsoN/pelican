<?php

namespace landingSILEX\DAO;

use Doctrine\DBAL\Connection;
use landingSILEX\Custom\User;

class UserDAO
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
        $sql = "SELECT * FROM user";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $user = array();
        foreach ($result as $row) {
            $userID = $row['id'];
            $user[$userID] = $this->buildUser($row);
        }
        return $user;
    }

    /**
     * Creates an pays object based on a DB row.
     *
     * @param array $row The DB row containing pays data.
     * @return \landingSILEX\Custom\User
     */
    private function buildUser(array $row) {
        $user = new User();
        $user->setId($row['id']);
        $user->setidVille($row['idVille']);
        $user->setmailUser($row['mailUser']);
        return $user;
    }
}