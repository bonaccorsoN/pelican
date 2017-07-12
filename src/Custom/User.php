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
     * User idAnswer.
     *
     * @var integer
     */
    private $idAnswer;

    /**
     * User mail.
     *
     * @var string
     */
    private $mail;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getmailUser() {
        return $this->mail;
    }

    public function setmailUser($mailUser) {
        $this->mail = $mailUser;
        return $this;
    }


    public function getidAnswer() {
        return $this->id;
    }

    public function setidAnswer($idAnswer) {
        $this->id = $idAnswer;
        return $this;
    }
}