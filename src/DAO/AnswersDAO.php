<?php
/**
 * Created by PhpStorm.
 * User: nicola
 * Date: 13/07/2017
 * Time: 15:37
 */

use landingSILEX\Custom\answers;
use Doctrine\DBAL\Connection;

namespace landingSILEX\DAO;


use landingSILEX\Custom\answers;

class AnswersDAO
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
        $sql = "SELECT * FROM answers";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $answers = array();
        foreach ($result as $row) {
            $answersID = $row['id'];
            $answers[$answersID] = $this->buildCityIndice($row);
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
        $answers = new answers();
        $answers->setid($row['id']);
        $answers->setuser_id($row['user_id']);
        $answers->setage($row['age']);
        $answers->setsexe($row['sexe']);
        $answers->setnuage_lifestyle($row['nuage_lifestyle']);
        $answers->setscore_fete($row['score_fete']);
        $answers->setscore_human($row['cscore_human']);
        $answers->setscore_culture($row['score_culture']);
        $answers->setscore_invest($row['score_invest']);
        return $answers;
    }
}