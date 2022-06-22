<?php

require_once "model/UserManager.php";
require_once "GlobalController.php";

class UserController
{
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager;
    }

    public function displayFormConnection()
    {
        require "view/formConnection.php";
    }

    public function checkUserInfos()
    {
        // var_dump($_POST);
        if (isset($_POST["submitConnection"])) {
            $userInfos = $this->userManager->getUserByMail([$_POST["mailConnection"]]);
        } else {
            throw new Exception("Formulaire de connexion non envoyé correctement");
        }
    }
}
