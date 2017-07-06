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
     * User villeName.
     *
     * @var integer
     */
    private $villeName;

    /**
     * User mailUser.
     *
     * @var string
     */
    private $mailUser;

    /**
     * User resq1.
     *
     * @var string
     */
    private $resq1;

    /**
     * User resq2.
     *
     * @var string
     */
    private $resq2;

    /**
     * User resq3.
     *
     * @var string
     */
    private $resq3;

    /**
     * User resq4.
     *
     * @var string
     */
    private $resq4;

    /**
     * User resq5.
     *
     * @var string
     */
    private $resq5;

    /**
     * User resq6.
     *
     * @var string
     */
    private $resq6;

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

    public function getvilleName() {
        return $this->villeName;
    }

    public function setvilleName($villeName) {
        $this->villeName = $villeName;
        return $this;
    }

    public function getmailUser() {
        return $this->mailUser;
    }

    public function setmailUser($mailUser) {
        $this->mailUser = $mailUser;
        return $this;
    }

    public function getresq1() {
        return $this->resq1;
    }

    public function setresq1($resq1) {
        $this->resq1 = $resq1;
        return $this;
    }

    public function getresq2() {
        return $this->resq2;
    }

    public function setresq2($resq2) {
        $this->resq2 = $resq2;
        return $this;
    }

    public function getresq3() {
        return $this->resq3;
    }

    public function setresq3($resq3) {
        $this->resq3 = $resq3;
        return $this;
    }

    public function getresq4() {
        return $this->resq4;
    }

    public function setresq4($resq4) {
        $this->resq4 = $resq4;
        return $this;
    }

    public function getresq5() {
        return $this->resq5;
    }

    public function setresq5($resq5) {
        $this->resq5 = $resq5;
        return $this;
    }

    public function getresq6() {
        return $this->resq6;
    }

    public function setresq6($resq6) {
        $this->resq6 = $resq6;
        return $this;
    }


}