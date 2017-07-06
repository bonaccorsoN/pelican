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
        $user->setvilleName($row['villeName']);
        $user->setmailUser($row['mailUser']);
        $user->setresq1($row['reponseq1']);
        $user->setresq2($row['reponseq2']);
        $user->setresq3($row['reponseq3']);
        $user->setresq4($row['reponseq4']);
        $user->setresq5($row['reponseq5']);
        $user->setresq6($row['reponseq6']);
        return $user;

    }

    /*
    /**
     * Saves a comment into the database.
     *
     * @param \landingSILEX\Custom\User $user the user to save
     */
    /*
    public function save(User $user) {
        $userData= array(
            'user_mail' => $user->getmailUser(),
            'city_name' => $user->getvilleName()
        );

        /*
        if ($comment->getId()) {
            // The comment has already been saved : update it
            $this->getDb()->update('t_comment', $commentData, array('com_id' => $comment->getId()));
        } else {
            // The comment has never been saved : insert it
            $this->getDb()->insert('t_comment', $commentData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $comment->setId($id);
        }
        */
    /*}
    */

}