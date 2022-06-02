
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- width=device-width aide à définir la largeur de la page, pour qu'elle soit égale à celle de l'écran de votre appareil -->
    <title>CallMeMaybe</title>
    <link rel="icon" href="img/logo_ico.ico" type="icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
</head>
<body>
<?php
$tab = "index";
include ('header.php');
include ('functions.php');
?>

<!-- corps -->
<main>
    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            <a href="" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Accueil</span>
            </a>
        </header>

        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">CMM</h1>
                <p class="col-md-8 fs-4">Une télécommande fournie aux élèves leur permet d'appeler leur enseignant pour toute question ou vérification du travail demandé, tout en favorisant l'équité grâce à un système de file d'attente.</p>
                <button class="btn btn-primary btn-lg" type="button">Découvrir le projet</button>
                <!-- Session en cours -->
                <?php
                if (isSessionExists()){

                    ?>
                <a href="waiting.php" >
                    <button class="btn btn-outline-secondary btn-lg" type="button">Session en cours</button>
                </a>
                <?php
                }
                ?>

            </div>
        </div>

        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-white bg-primary rounded-3">
                    <h2>Accès enseignant</h2>
                    <p>L'enseignant peut se connecter et créer, gérer ou encore terminer une session. Il est aussi possible de récupérer les données des dernières sessions.</p>
                    <a href="admin.php"><button class="btn btn-outline-light" type="button">Accéder</button></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Accès élève</h2>
                    <p>Chaque élève peut, s'il le souhaite, participer à la session en cours s'il ne possède pas de télécommande.</p>
                    <a href="simulate.php"><button class="btn btn-outline-secondary" type="button">Accéder</button></a>
                </div>
            </div>
        </div>

        <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2022 - Jonathan DESNOYERS | Lucas FANECH
        </footer>
    </div>
</main>

<!-- à la fin de votre page html -->
<script src="js/jquery-3.6.0.min.js" ></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>