<?php

namespace landingSILEX\DAO;

use Doctrine\DBAL\Connection;
use landingSILEX\Custom\Budget;

class BudgetDAO
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
        $sql = "SELECT * FROM budget";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $budget = array();
        foreach ($result as $row) {
            $budgetID = $row['id'];
            $budget[$budgetID] = $this->buildBudget($row);
        }
        return $budget;
    }

    /**
     * Creates an pays object based on a DB row.
     *
     * @param array $row The DB row containing pays data.
     * @return \landingSILEX\Custom\Budget
     */
    private function buildBudget(array $row) {
        $budget = new Budget();
        $budget->setId($row['id']);
        $budget->setT1($row['T1']);
        $budget->setT2($row['T2']);
        $budget->setT3($row['T3']);
        $budget->setT4($row['T4']);
        return $budget;
    }
}