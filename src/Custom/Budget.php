<?php

/*
 * class pays
 */

namespace landingSILEX\Custom;

class Budget
{

    /**
     * PaysNew id.
     *
     * @var integer
     */
    private $id;

    /**
     * Budget T1.
     *
     * @var integer
     */
    private $T1;

    /**
     * Budget T2.
     *
     * @var integer
     */
    private $T2;

    /**
     * Budget T3.
     *
     * @var integer
     */
    private $T3;

    /**
     * Budget T4.
     *
     * @var integer
     */
    private $T4;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getT1() {
        return $this->T1;
    }

    public function setT1($T1) {
        $this->T1 = $T1;
        return $this;
    }

    public function getT2() {
    return $this->T2;
    }

    public function setT2($T2) {
        $this->T2 = $T2;
        return $this;
    }

    public function getT3() {
        return $this->T3;
    }

    public function setT3($T3) {
        $this->T3 = $T3;
        return $this;
    }

    public function getT4() {
        return $this->T4;
    }

    public function setT4($T4) {
        $this->T4 = $T4;
        return $this;
    }

}