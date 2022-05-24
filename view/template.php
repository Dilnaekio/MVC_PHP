<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/sketchy/bootstrap.min.css">

    <title>TP MVC</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= URL ?>accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= URL ?>livres">Livres</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-info"><?= $title ?></h1>
        </div>
    </header>

    <!-- Si une action a initialisée une super globale SESSION "alert", celle-ci va afficher le message et modifier sa couleur en fonction du type défini dans ManageErrors (définie dans GlobalController.php, utilisée dans BookController.php) -->
    <?php if (isset($_SESSION["alert"])) { ?>
        <div class="alert alert-<?= $_SESSION["alert"]["type"] ?>" role="alert">
            <p class="text-align"> <?= $_SESSION["alert"]["message"]; ?> </p>
        </div>
    <?php unset($_SESSION["alert"]);
    }
    echo $content ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>