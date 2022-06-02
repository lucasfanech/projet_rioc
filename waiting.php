<?php
$tab = "waiting";
include('db.php');
include('functions.php'); // Fonctions PHP
$isConnected = false;
include('checkLogin.php'); // nous renvoie $isConnected true ou false
if (isSessionExists()) {
    $getSession = getSession();
    $sessionId = $getSession[0];
}


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
    <link rel="stylesheet" href="css/main.css">

</head>
<body>
<?php
include ('header.php');
?>

<!-- corps -->
<main>
    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            <div class="row">
                <div class="col-auto">
                    <a href="" class="d-flex align-items-center text-dark text-decoration-none">
                        <span class="fs-4">Session <?php if (isset($sessionId)) {

                                echo "n°".$sessionId;} ?></span>
                    </a>
                </div>

                <div class="col">
                    <?php if (isset($messageRate)){
                        echo $messageRate;
                    } ?>
                </div>
            </div>
        </header>

        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid" id="dataRefresh">
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
<script type="text/javascript">

    $(document).ready(function($) {
        $('#dataRefresh').load("process_waiting.php<?php if (isset($sessionId)){
            echo "?session=".$sessionId;
        } ?>");

        // refresh auto
        var auto_refresh = setInterval(
            (function () {
                $('#dataRefresh').load("process_waiting.php<?php if (isset($sessionId)){
                    echo "?session=".$sessionId;
                } ?>");
            }), 1000);

    });
</script>
</body>
</html>
