<?php

/*
 * class pays
 */

namespace landingSILEX\Custom;

class Indices
{

    /**
     * Indices id.
     *
     * @var integer
     */
    private $id;

    /**
     * Indices idNumbeo.
     *
     * @var integer
     */
    private $idNumbeo;

    /**
     * Indices crime_index.
     *
     * @var float
     */
    private $crime_index;

    /**
     * Indices pollution_index.
     *
     * @var float
     */
    private $pollution_index;

    /**
     * Indices health_care_index.
     *
     * @var float
     */
    private $health_care_index;

    /**
     * Indices cpi_index.
     *
     * @var float
     */
    private $cpi_index;

    /**
     * Indices drinking_water_quality_accessibility.
     *
     * @var float
     */
    private $drinking_water_quality_accessibility;

    /**
     * Indices water_pollution.
     *
     * @var float
     */
    private $water_pollution;

    /**
     * Indices air_quality.
     *
     * @var float
     */
    private $air_quality;

    public function getid() {
        return $this->id;
    }

    public function setid($id) {
        $this->id = $id;
        return $this;
    }


    public function getidNumbeo() {
        return $this->idNumbeo;
    }

    public function setidNumbeo($idNumbeo) {
        $this->idNumbeo = $idNumbeo;
        return $this;
    }

    public function getcpi_index() {
        return $this->cpi_index;
    }

    public function setcpi_index($cpi_index) {
        $this->cpi_index = $cpi_index;
        return $this;
    }

    public function getcrime_index() {
        return $this->crime_index;
    }

    public function setcrime_index($crime_index) {
        $this->crime_index = $crime_index;
        return $this;
    }

    public function getpollution_index() {
        return $this->pollution_index;
    }

    public function setpollution_index($pollution_index) {
        $this->pollution_index = $pollution_index;
        return $this;
    }

    public function gethealth_care_index() {
        return $this->health_care_index;
    }

    public function sethealth_care_index($health_care_index) {
        $this->health_care_index = $health_care_index;
        return $this;
    }

    public function getdrinking_water_quality_accessibility() {
        return $this->drinking_water_quality_accessibility;
    }

    public function setdrinking_water_quality_accessibility($drinking_water_quality_accessibility) {
        $this->drinking_water_quality_accessibility = $drinking_water_quality_accessibility;
        return $this;
    }

    public function getwater_pollution() {
        return $this->water_pollution;
    }

    public function setwater_pollution($water_pollution) {
        $this->water_pollution = $water_pollution;
        return $this;
    }

    public function getair_quality() {
        return $this->air_quality;
    }

    public function setair_quality($air_quality) {
        $this->air_quality = $air_quality;
        return $this;
    }
}