<?php

/*
 * class pays
 */

namespace landingSILEX\Custom;

class Destination
{

    /**
     * Destination id.
     *
     * @var integer
     */
    private $id;

    /**
     * Destination idUser.
     *
     * @var integer
     */
    private $idUser;

    /**
     * Destination nomVille.
     *
     * @var string
     */
    private $nomVille;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getidUser() {
        return $this->idUser;
    }

    public function setidUser($idUser) {
        $this->idUser = $idUser;
        return $this;
    }

    public function getnomVille() {
        return $this->nomVille;
    }

    public function setnomVille($nomVille) {
        $this->nomVille = $nomVille;
        return $this;
    }

}