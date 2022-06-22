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
}