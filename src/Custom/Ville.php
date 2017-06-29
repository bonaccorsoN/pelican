<?php

/*
 * class pays
 */

namespace landingSILEX\Custom;

class Ville
{

    /**
     * Ville id.
     *
     * @var integer
     */
    private $id;

    /**
     * Ville IdPays.
     *
     * @var integer
     */
    private $IdPays;

    /**
     * Ville nomVille.
     *
     * @var string
     */
    private $nomVille;

    /**
     * Ville coutMensuelVille.
     *
     * @var float
     */
    private $coutMensuelVille;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getIdPays() {
        return $this->IdPays;
    }

    public function setIdPays($IdPays) {
        $this->IdPays = $IdPays;
        return $this;
    }

    public function getnomVille() {
        return $this->nomVille;
    }

    public function setnomVille($nomVille) {
        $this->nomVille = $nomVille;
        return $this;
    }

    public function getcoutMensuelVille() {
        return $this->coutMensuelVille;
    }

    public function setcoutMensuelVille($coutMensuelVille) {
        $this->coutMensuelVille = $coutMensuelVille;
        return $this;
    }

}