<?php

abstract class GlobalController
{
    public static function addImg($title, $file, $folder)
    {
        if ($file['size'] > 0) {
            $upload = 1;

            //On vérifie si le dossier images/ existe, si non, on le créé
            if (!file_exists($folder)) {
                mkdir($folder, 0777);
            }

            //On stock uniquement l'extension dans $extension
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            //On stock un numéro aléatoire dans $random
            $random = rand(0, 99999);

            //On remplace les espaces du nom du fichier par "_"
            $file['name'] = str_replace(" ", "_", $file['name']);

            //On créé le chemin du nouveau fichier
            $target_file = $folder . $random . "_" . $title . "." . $extension;

            //Ici on vérifie que nous avons bien une image
            if (!getimagesize($file['tmp_name'])) {
                throw new Exception("Erreur ajout : aucune image temporaire");
                $upload = 0;
            }

            //On vérifie si c'est bien un jpg, un jpeg ou un png
            if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png") {
                throw new Exception("Erreur ajout : le format choisi n'est pas autorisé ! (jpg jpeg ou png");
                $upload = 0;
            }

            //On vérifie la taille de l'image
            if ($file['size'] > 1000000) {
                throw new Exception("Erreur ajout : le poids de l'image est trop lourd ! (1mo)");
                $upload = 0;
            }

            //On déplace le fichier uploadé dans notre dossier /images en lui donnant le nom de l'utilisateur
            move_uploaded_file($file['tmp_name'], $target_file);

            if ($upload === 1) {
                // Cela renvoie le nom du fichier complet

                return $random . "_" . $title . "." . $extension;
            }
        }
    }

    public static function manageErrors($type, $message)
    {
        $_SESSION["alert"] = [
            'type' => $type,
            'message' => $message
        ];
    }
}
