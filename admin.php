<?php

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


// Si l'utilisateur est connecté
if ($isConnected){
    echo "Bonjour ".$pseudo;
    ?>
    <br>

    <?php
    // Vérifier si une session est déjà active
    $isActive = isSessionExists();
    if ($isActive){
        $getSession = getSession();

        ?>
        <a href="session.php?session=<?php echo $getSession[0]."&id=".$_SESSION['id'] ?>" ><button >Session n°<?php echo $getSession[0]." | ".$getSession[2]?></button></a>
        <form method="POST" action="endSession.php?idSession=<?php echo $getSession[0]."&id=".$_SESSION['id'] ?>">
            <button type="submit" name="endSession" value="X">X</button>
        </form>
        <?php
    }
    else{
        ?>
        <h3>Créez une session:</h3>
        <form method="POST" action="createSession.php?id=<?php echo $_SESSION['id'] ?>">
            <input type="text"  id="session" name="session" placeholder="Nom de session" required>
            <button type="submit" name="submitSession" value="Session" >Créer la session</button>
        </form>
        <?php
    }
    ?>



    <br>
    <a href="disconnect.php">Se déconnecter</a>
<?php
}
// Si l'utilisateur n'est pas connecté
else{
?>
    <form method="POST" action="">
        <input type="text"  id="pseudo" name="pseudo" placeholder="Utilisateur" required>
        <input type="password"  id="mdp" name="mdp" placeholder="Mot de passe" required>
        <button type="submit" name="connect" value="Inscription" >Connexion</button>
    </form>

    <?php

}

?>