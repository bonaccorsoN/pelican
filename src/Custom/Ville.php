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
     * Ville longitude.
     *
     * @var float
     */
    private $longitude;

    /**
     * Ville latitude.
     *
     * @var float
     */
    private $latitude;

    /**
     * Ville idNumbeo.
     *
     * @var int
     */
    private $idNumbeo;

    /**
     * Ville nomNumbeo.
     *
     * @var string
     */
    private $nomNumbeo;

    /**
     * Ville nomPaysNumbeo.
     *
     * @var string
     */
    private $nomPaysNumbeo;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getlongitude() {
        return $this->longitude;
    }

    public function setlongitude($longitude) {
        $this->longitude = $longitude;
        return $this;
    }

    public function getlatitude() {
        return $this->latitude;
    }

    public function setlatitude($latitude) {
        $this->latitude = $latitude;
        return $this;
    }

    public function getidNumbeo() {
        return $this->idNumbeo;
    }

    public function setidNumbeo($idNumbeo) {
        $this->idNumbeo = $idNumbeo;
        return $this;
    }

    public function getnomNumbeo() {
        return $this->nomNumbeo;
    }

    public function setnomNumbeo($nomNumbeo) {
        $this->nomNumbeo = $nomNumbeo;
        return $this;
    }

    public function getnomPaysNumbeo() {
        return $this->nomPaysNumbeo;
    }

    public function setnomPaysNumbeo($nomPaysNumbeo) {
        $this->nomPaysNumbeo = $nomPaysNumbeo;
        return $this;
    }

}