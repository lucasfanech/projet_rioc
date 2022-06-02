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
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
$tab = "join";
include ('header.php');
?>

<!-- corps -->
<main>
    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            <a href="" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Télécommande</span>
            </a>
        </header>

        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5 d-flex justify-content-center">


<?php
include('functions.php');
$activeSession = getSession();
if ($activeSession !== null){
    if ($activeSession[0] == ""){
        $error = "<br><div class='alert alert-danger text-center' role='alert'>Aucune session n'est ouverte !<br> Revenez plus tard</div>";
    }

}




// check numéro de table
if (isset($_POST['table'])){
    if ($activeSession !== null) {
        if ($activeSession[0] != "") {
            if ((preg_match('#([0-9]+)#', $_POST['table'])) and (is_numeric($_POST['table']))) {
                $idTable = $_POST['table'];
            } else {
                $error = "<br><div class='alert alert-danger text-center' role='alert'>Le numéro de la table doit être un entier !</div>";
            }
        } else {
            header('Location: simulate.php');
        }
    }
}

// Numéro de table
    // Si on a pas défini la table
if (!isset($idTable)){
    ?>
    <form class="shadow rounded" method="POST" action="simulate.php">
        <div class="card " style="width: 24rem;">
            <div class="card-header d-flex justify-content-center">
                <h3>Numéro de table</h3>
            </div>
            <div class="card-body ">

                <div class="mb-3 d-flex justify-content-center">
                    <input class="form-control" type="text" id="table" name="table" placeholder="Entrez votre numéro de table" required>

                </div>
                <div class="d-flex justify-content-center">

                    <button class="btn btn-primary" type="submit" name="idTable" value="call" >Valider</button>
                </div>
                <?php if (isset($error)){echo $error;}?>


            </div>
            <div class="card-footer text-muted d-flex justify-content-center">
                 <?php
                 if ($activeSession !== null){
                     if($activeSession[0] != ""){
                         echo "Session active: ".$activeSession[2]." (n°".$activeSession[0].")";
                     }
                     else{
                         echo "Aucune session active";
                     }
                 }
                 else{
                     echo "Aucune session active";
                 }

                 ?>
            </div>
        </div>








    </form>
<?php
}
else{
    // Si on a défini la table
    ?>
                <form class="shadow rounded" method="POST" action="simulate.php">
                    <div class="card " style="width: 24rem;">
                        <div class="card-header d-flex justify-content-center">
                            <label for="table" class="form-label">
                <?php

    //Traitement Formulaire:
    // Envoi formulaire Appel/verif/cancel
    if (isset($_POST['call'])){
        if (processButton(1, $activeSession[0], $idTable )){
            $msgInfo = "<div class='alert alert-primary' role='alert'>Requête envoyée !</div>";
        }else{
            $msgInfo = "<div class='alert alert-danger' role='alert'> Erreur dans la requête !</div>";
        }
    }
    else if(isset($_POST['verify'])){
        if(processButton(2, $activeSession[0], $idTable )){
            $msgInfo = "<div class='alert alert-primary' role='alert'>Requête envoyée !</div>";
        }else{
            $msgInfo = "<div class='alert alert-danger' role='alert'> Erreur dans la requête !</div>";
        }
    }
    else if(isset($_POST['cancel'])){
        if(processButton(0, $activeSession[0], $idTable )){
            $msgInfo = "<div class='alert alert-warning' role='alert'>Requête annulée !</div>";
        }
        else{
            $msgInfo = "<div class='alert alert-danger' role='alert'> Erreur dans la requête !</div>";
        }
    }else{

    }


    // Appel DB pour vérifier si le bouton est déjà activé

    $stateUser = stateUser($activeSession[0],$idTable);
    if ($stateUser == 1){
        echo "<h3>Table n°".$idTable."</h3><span>Vous avez appelé l'animateur pour une question.</span>";
    }
    else if ($stateUser == 2){
        echo "<h3>Table n°".$idTable."</h3><span>Vous avez appelé l'animateur pour une vérification.</span>";
    }
    else if ($stateUser == 0){
        echo "<h3>Table n°".$idTable."</h3><span>Vous pouvez choisir d'appeler l'animateur pour une question ou pour une vérification.</span>";
    }


    if ($stateUser == 1){
        // Appel
        ?>
                        </label>
                    </div>
                <div class="card-body d-flex justify-content-center">
                    <div class="d-grid gap-2">
                        <input id="table" name="table" type="hidden" value="<?php echo $idTable ?>">
                        <button class="btn btn-secondary btn-lg " type="submit" name="call" value="call" disabled>Question</button>
                        <button class="btn btn-success btn-lg " type="submit" name="verify" value="verify" disabled>Vérification</button>
                        <button class="btn btn-danger btn-lg " type="submit" name="cancel" value="cancel" >Annuler</button>
                    </div>
                </div>
                <div class="card-footer">

        <?php

    }
    else if ($stateUser == 2){
        // Verification
        ?>
                    </label>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div class="d-grid gap-2">
                        <input id="table" name="table" type="hidden" value="<?php echo $idTable ?>">
                        <button class="btn btn-secondary btn-lg " type="submit" name="call" value="call" disabled>Question</button>
                        <button class="btn btn-success btn-lg " type="submit" name="verify" value="verify" disabled>Vérification</button>
                        <button class="btn btn-danger btn-lg " type="submit" name="cancel" value="cancel" >Annuler</button>
                    </div>
                </div>
                <div class="card-footer ">
        <?php

    }
    else {
        // Rien
        ?>
                    </label>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div class="d-grid gap-2">
                        <input id="table" name="table" type="hidden" value="<?php echo $idTable ?>">
                        <button class="btn btn-secondary btn-lg " type="submit" name="call" value="call" >Question</button>
                        <button class="btn btn-success btn-lg " type="submit" name="verify" value="verify" >Vérification</button>
                        <button class="btn btn-danger btn-lg " type="submit" name="cancel" value="cancel" disabled >Annuler</button>
                    </div>
                </div>
                <div class="card-footer">
        <?php

    }
    if (isset($msgInfo)){
        echo $msgInfo;
    }
    ?>
                </div>
            </div>
        </form>
            <?php



}


?>

                </div>
            </div>
    </header>

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

