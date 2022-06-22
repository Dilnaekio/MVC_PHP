<?php

require_once "ModelClass.php";
require_once "UserClass.php";

class UserManager extends Model
{
    // Méthode pour charger les utilisateurs
    public function getUserByMail($mail)
    {
        $sql = "SELECT * FROM users where mail = :mail";
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            ":mail" => $mail
        ]);

        $result = $req->fetch(PDO::FETCH_OBJ);

        if (!empty($result)) {
            $user = new Users($result->id, $result->name, $result->mail, $result->pwd, $result->role);

            return $user;
        } else {
            return null;
        }
    }
}
