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
        if (isset($_POST["submitConnection"])) {
            $userInfos = $this->userManager->getUserByMail($_POST["mailConnection"]);

            if (!empty($userInfos) && password_verify($_POST["pwdConnection"], $userInfos->getPwd())) {
                $_SESSION["user"]["name"] = $userInfos->getName();
                $_SESSION["user"]["role"] = $userInfos->getRole();
                $_SESSION["user"]["mail"] = $userInfos->getMail();
                $_SESSION["user"]["id"] = $userInfos->getId();

                if ($_POST["rememberCheck"] === true) {
                    setcookie("UserName", $userInfos->getName(), time()+(10*365*24*60*60));
                    setcookie("UserRole", $userInfos->getRole(), time()+(10*365*24*60*60));
                    setcookie("UserMail", $userInfos->getMail(), time()+(10*365*24*60*60));
                }
                GlobalController::manageErrors("success", "Connexion réussie !");
                header("Location: " . URL);
            } else {
                GlobalController::manageErrors("danger", "Hum... Il semblerait qu'il y ait un soucis d' ID/MDP :(");
                header("Location: " . URL . "connexion");
            }
        } else {
            throw new Exception("Formulaire de connexion non envoyé correctement");
        }
    }

    public function disconnection()
    {
        if (isset($_COOKIE["user"])) {
            unset($_COOKIE["user"]);
        }

        session_destroy();
        header("Location: " . URL);
    }
}
