<?php
/**
 * Created by ElMagnifico.
 * User: nicola
 * Date: 12/07/2017
 * Time: 19:27
 */

namespace landingSILEX\Custom;


class answers
{
    /**
     * Indices id.
     *
     * @var float
     */
    private $id;

    /**
     * Indices user_id.
     *
     * @var float
     */
    private $user_id;

    /**
     * Indices age.
     *
     * @var float
     */
    private $age;

    /**
     * Indices sexe.
     *
     * @var float
     */
    private $sexe;

    /**
     * Indices nuage_lifestyle.
     *
     * @var string
     */
    private $nuage_lifestyle;

    /**
    * Indices score_fete.
    *
    * @var float
    */
    private $score_fete;

    /**
     * Indices score_culture.
     *
     * @var float
     */
    private $score_culture;

    /**
     * Indices score_invest.
     *
     * @var float
     */
    private $score_invest;

    /**
     * Indices score_human.
     *
     * @var string
     */
    private $score_human;

    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getuser_id()
    {
        return $this->user_id;
    }

    public function setuser_id($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getage()
    {
        return $this->age;
    }

    public function setage($age)
    {
        $this->age = $age;
        return $this;
    }

    public function getsexe()
{
    return $this->sexe;
}

    public function setsexe($sexe)
    {
        $this->sexe = $sexe;
        return $this;
    }

    public function getnuage_lifestyle()
    {
        return $this->nuage_lifestyle;
    }

    public function setnuage_lifestyle($nuage_lifestyle)
    {
        $this->nuage_lifestyle = $nuage_lifestyle;
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