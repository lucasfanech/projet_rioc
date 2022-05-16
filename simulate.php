<?php
// check numéro de table
if (isset($_POST['idTable'])){
    $idTable = $_POST['idTable'];
}

// Numéro de table
    // Si on a pas défini la table
if (!isset($idTable)){
    ?>
    <form method="POST" action="simulate.php">

        <input type="text" id="simulate" name="simulate" placeholder="Numero de table" required>
        <button type="submit" name="idTable" value="call" >Valider</button>
    </form>
<?php
}
else{
    // Si on a défini la table
    ?>
    <form method="POST" action="simulate.php">

        <input id="idTable" name="idTable" type="hidden" value="<?php echo $idTable ?>">
        <button type="submit" name="call" value="call" >Bouton appel (1)</button>
        <button type="submit" name="verify" value="verify" >Bouton verif (2)</button>
        <button type="submit" name="cancel" value="cancel" disabled >Annuler</button>
    </form>
<?php
}

// Appel DB pour vérifier si le bouton est déjà activé


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


