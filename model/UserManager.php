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

        $data = $req->fetch(PDO::FETCH_OBJ);

        // TODO : gérer ici erreur si $data est vide
        // $newUser = new Users($data->id, $data->name, $data->mail, $data->pwd);

        // return $newUser;
    }
}
