<?php

/*
 * class pays
 */

namespace landingSILEX\Custom;

class Pays
{

    /**
     * Pays id.
     *
     * @var integer
     */
    private $id;

    /**
     * Pays name.
     *
     * @var string
     */
    private $name;

    /**
     * Pays climat.
     *
     * @var string
     */
    private $climat;

    /**
     * Pays distanceToFrance.
     *
     * @var integer
     */
    private $distanceToFrance;

    /**
     * Pays indice.
     *
     * @var integer
     */
    private $indice;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
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

    public function getIndice() {
        return $this->indice;
    }

    public function setIndice($indice) {
        $this->indice = $indice;
        return $this;
    }

}