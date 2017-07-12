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

    /**
     * Ville score_fete.
     *
     * @var float
     */
    private $score_fete;

    /**
     * Ville score_culture.
     *
     * @var float
     */
    private $score_culture;

    /**
     * Ville score_human.
     *
     * @var float
     */
    private $score_human;

    /**
     * Ville score_invest.
     *
     * @var float
     */
    private $score_invest;

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

    public function getscore_fete() {
        return $this->score_fete;
    }

    public function setscore_fete($score_fete) {
        $this->score_fete = $score_fete;
        return $this;
    }

    public function getscore_culture() {
        return $this->score_culture;
    }

    public function setscore_culture($score_culture) {
        $this->score_culture = $score_culture;
        return $this;
    }

    public function getscore_human() {
        return $this->score_human;
    }

    public function setscore_human($score_human) {
        $this->score_human = $score_human;
        return $this;
    }
        public function getscore_invest() {
            return $this->score_invest;
        }

        public function setscore_invest($score_invest) {
            $this->score_invest = $score_invest;
            return $this;
        }
}