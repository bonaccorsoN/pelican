<?php

/*
 * class pays
 */

namespace landingSILEX\Custom;

class PaysNew
{

    /**
     * PaysNew id.
     *
     * @var integer
     */
    private $id;

    /**
     * PaysNew nomPays.
     *
     * @var string
     */
    private $nomPays;

    /**
     * Pays climat.
     *
     * @var string
     */
    private $climat;

    /**
     * Pays distanceToFrance.
     *
     * @var float
     */
    private $distanceToFrance;

    /**
     * Pays coutMensuelPays.
     *
     * @var float
     */
    private $coutMensuelPays;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getNomPays() {
        return $this->nomPays;
    }

    public function setNomPays($nomPays) {
        $this->nomPays = $nomPays;
        return $this;
    }

    public function getClimat() {
        return $this->climat;
    }

    public function setClimat($climat) {
        $this->climat = $climat;
        return $this;
    }

    public function getDistanceToFrance() {
        return $this->distanceToFrance;
    }

    public function setDistanceToFrance($distanceToFrance) {
        $this->distanceToFrance = $distanceToFrance;
        return $this;
    }

    public function getCoutMensuelPays() {
        return $this->coutMensuelPays;
    }

    public function setCoutMensuelPays($coutMensuelPays) {
        $this->coutMensuelPays = $coutMensuelPays;
        return $this;
    }

}