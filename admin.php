<?php
$tab = "admin";
include ('db.php');
include ('functions.php'); // Fonctions PHP
$isConnected = false;
include ('checkLogin.php'); // nous renvoei $isConneected true ou false

//Traitement formulaire connexion
if(isset($_POST['connect'])) {
    $pseudoconnect = htmlspecialchars($_POST['pseudo']);
    $mdpconnect = sha1($_POST['mdp']);
    if(!empty($pseudoconnect) AND !empty($mdpconnect)) {
        $requser = $bdd->prepare("SELECT * FROM identification WHERE user = ? AND password = ?");
        $requser->execute(array($pseudoconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id_identification'];
            $_SESSION['pseudo'] = $userinfo['user'];
            $pseudo = $_SESSION['pseudo'];
            $isConnected = true;
        } else {
            $erreur = "Mauvais pseudo ou mot de passe !";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}

// ==
?>
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
    include ('header.php');
    ?>

    <!-- corps -->
    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <a href="" class="d-flex align-items-center text-dark text-decoration-none">
                    <span class="fs-4">Accès enseignant</span>
                </a>
            </header>

            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <div class="row">
<?php

// Si l'utilisateur est connecté
if ($isConnected){
    ?>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-center">
                                <h3>Bonjour <?php echo $pseudo;?> !</h3>
                            </div>
                            <div class="d-flex justify-content-center">
                                <i class="fa-solid fa-user-lock fa-6x"></i>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-center">

                                <a href="disconnect.php"><i class="fa-solid fa-right-from-bracket"></i> Se déconnecter</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3>Session</h3>
    <?php
    // Vérifier si une session est déjà active
    $isActive = isSessionExists();
    if ($isActive){
        $getSession = getSession();

        ?>
        <div class="row">
            <div class="col-md-6">
                <a href="session.php?session=<?php echo $getSession[0]."&id=".$_SESSION['id'] ?>" >
                    <button type="button" class="btn btn-primary position-relative">
                        <i class="fa-solid fa-circle-chevron-right"></i>
                        Session n°<?php echo $getSession[0]." | ".$getSession[2]?>

                        <?php
                        $nbCalls = nbCalls($getSession[0]);
                        if ($nbCalls > 0){
                            ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo $nbCalls;?>
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            <?php
                        }
                        ?>
                    </button>
                </a>
            </div>
            <div class="col-md-6">
                <form method="POST" action="endSession.php?idSession=<?php echo $getSession[0]."&id=".$_SESSION['id'] ?>">
                    <button class="btn btn-danger position-relative" type="submit" name="endSession" value="X"><i class="fa-solid fa-square-xmark"></i> Terminer la session</button>
                </form>
            </div>
        </div>


        <?php
    }
    else{
        ?>
                        <h3>Créez une session:</h3>
                        <form class="row g-3" method="POST" action="createSession.php?id=<?php echo $_SESSION['id'] ?>">
                            <div class="col-auto">
                                <input class="form-control" type="text"  id="session" name="session" placeholder="Nom de session" required>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-success" type="submit" name="submitSession" value="Session" >Créer la session</button>
                            </div>
                        </form>

        <?php
    }
    ?>
                            <!-- accordion -->
                            <hr>
                            <h3>Historique</h3>
                            <div class="accordion" id="accordionExample">
                                <?php
                                $sessionsList = getSessionsList();
                                foreach ($sessionsList as $row) {
                                    ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?php echo $row['id_session'];?>">
                                        <?php if ($row['active'] == 1){
                                            ?>
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $row['id_session'];?>" aria-expanded="true" aria-controls="collapse<?php echo $row['id_session'];?>">

                                        <?php
                                        }else{
                                            ?>
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $row['id_session'];?>" aria-expanded="false" aria-controls="collapse<?php echo $row['id_session'];?>">
                                                    <?php
                                        }
                                        ?>
                                            Session n°<?php echo $row['id_session'];?> - <?php echo $row['session_name'];?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?php echo $row['id_session'];?>" class="accordion-collapse collapse <?php if ($row['active'] == 1){echo"show";}?>" aria-labelledby="heading<?php echo $row['id_session'];?>" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                <h5>Informations:</h5>
                                                    <?php
                                                    if ($row['active'] == 1){
                                                        ?>
                                                        <span class="badge text-bg-success">Session active</span><br>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <span class="badge text-bg-danger">Session inactive</span><br>
                                                        <?php
                                                    }

                                                    ?>
                                                    <span>Appels en attente: <strong><?php echo nbCalls($row['id_session']);?></strong></span><br>
                                                    <span>Appels traités: <strong><?php echo nbCallsDone($row['id_session']);?></strong></span>


                                                </div>
                                                <div class="col-md-6">
                                                    <a href="session.php?session=<?php echo $row['id_session']."&id=".$_SESSION['id'] ?>" >
                                                        <button type="button" class="btn btn-primary">
                                                            Accéder
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                    <?php
                                }
                                ?>

                            </div>
                            <!-- Fin accordion -->
                        </div>
                    </div>

<?php
}
// Si l'utilisateur n'est pas connecté
else{
?>
    <form method="POST" action="">
        <div class="row">
            <div class="col-md-6">
                <div class="h-100 p-5 text-white bg-primary rounded-3">
                    <h2>Accès enseignant</h2>
                    <p>L'enseignant peut se connecter et créer, gérer ou encore terminer une session. Il est aussi possible de récupérer les données des dernières sessions.</p>
                </div>
            </div>
            <div class="col-md-6 align-items-center">
                <h1>Connexion</h1>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="user">Utilisateur</span>
                    <input type="text"  class="form-control" id="pseudo" name="pseudo" placeholder="Utilisateur" aria-describedby="user" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="password">Mot de passe</span>
                    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe" aria-describedby="password" required>
                </div>
                <div class="input-group mb-3">

                    <button type="submit" class="btn btn-primary" id="inscription" name="connect" value="Inscription" >Connexion</button>
                </div>
            </div>
        </div>

    </form>

    <?php

}

?>
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
