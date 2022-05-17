<?php
include('functions.php');
$activeSession = getSession();



// check numéro de table
if (isset($_POST['table'])){
    $idTable = $_POST['table'];
}

// Numéro de table
    // Si on a pas défini la table
if (!isset($idTable)){
    ?>
    <form method="POST" action="simulate.php">

        <input type="text" id="table" name="table" placeholder="Numero de table" required>
        <button type="submit" name="idTable" value="call" >Valider</button>
    </form>
<?php
}
else{
    // Si on a défini la table
    //Traitement Formulaire:
    // Envoi formulaire Appel/verif/cancel
    if (isset($_POST['call'])){
        if (processButton(1, $activeSession[0], $idTable )){
            echo "Requête envoyée !<br>";
        }else{
            echo "erreur !<br>";
        }
    }
    else if(isset($_POST['verify'])){
        if(processButton(2, $activeSession[0], $idTable )){
            echo "Requête envoyée !<br>";
        }else{
            echo "erreur !<br>";
        }
    }
    else if(isset($_POST['cancel'])){
        if(processButton(0, $activeSession[0], $idTable )){
            echo "Requête annulée !<br>";
        }
        else{
            echo "erreur !<br>";
        }
    }else{

    }


    // Appel DB pour vérifier si le bouton est déjà activé

    $stateUser = stateUser($activeSession[0],$idTable);
    if ($stateUser == 1){
        echo "Table n° ".$idTable." - Vous avez appelé l'animateur pour une question.";
    }
    else if ($stateUser == 2){
        echo "Table n° ".$idTable." - Vous avez appelé l'animateur pour une vérification.";
    }
    else if ($stateUser == 0){
        echo "Table n° ".$idTable." - Vous pouvez cliquer.";
    }

    if ($stateUser == 1){
        // Appel
        ?>
        <form method="POST" action="simulate.php">

            <input id="table" name="table" type="hidden" value="<?php echo $idTable ?>">
            <button type="submit" name="call" value="call" disabled>Bouton appel (0)</button>
            <button type="submit" name="verify" value="verify" disabled>Bouton verif (1)</button>
            <button type="submit" name="cancel" value="cancel" >Annuler</button>
        </form>
        <?php

    }
    else if ($stateUser == 2){
        // Verification
        ?>
        <form method="POST" action="simulate.php">

            <input id="table" name="table" type="hidden" value="<?php echo $idTable ?>">
            <button type="submit" name="call" value="call" disabled>Bouton appel (0)</button>
            <button type="submit" name="verify" value="verify" disabled>Bouton verif (1)</button>
            <button type="submit" name="cancel" value="cancel" >Annuler</button>
        </form>
        <?php

    }
    else {
        // Rien
        ?>
        <form method="POST" action="simulate.php">

            <input id="table" name="table" type="hidden" value="<?php echo $idTable ?>">
            <button type="submit" name="call" value="call" >Bouton appel (0)</button>
            <button type="submit" name="verify" value="verify" >Bouton verif (1)</button>
            <button type="submit" name="cancel" value="cancel" disabled >Annuler</button>
        </form>
        <?php

    }



}




if (isset($_POST['call'])){
    echo "appel !";
}
else if(isset($_POST['verify'])){
    echo "verification !";
}
else if(isset($_POST['cancel'])){
    echo "annulation !";
}else{
    echo "Cliquez :";
}


?>


