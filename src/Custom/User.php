<?php

/*
 * class pays
 */

namespace landingSILEX\Custom;

class User
{

    /**
     * User id.
     *
     * @var integer
     */
    private $id;

    /**
     * User idVille.
     *
     * @var integer
     */
    private $idVille;

    /**
     * User mailUser.
     *
     * @var string
     */
    private $mailUser;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getidVille() {
        return $this->idVille;
    }

    public function setidVille($idVille) {
        $this->idVille = $idVille;
        return $this;
    }

    public function getmailUser() {
        return $this->mailUser;
    }

    public function setmailUser($mailUser) {
        $this->mailUser = $mailUser;
        return $this;
    }

}