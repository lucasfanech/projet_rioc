<?php
$tab = "admin";
include('db.php');
include('functions.php'); // Fonctions PHP
$isConnected = false;
include('checkLogin.php'); // nous renvoie $isConnected true ou false
if (isset($_GET['session'])) {
    $sessionId = $_GET['session'];
}

// Traitement Rating
if (isset($_POST['sendRate'])){
    if (isset($_POST['star-5'])){
        $rate = 5;
    }
    else if (isset($_POST['star-4'])){
        $rate = 4;
    }
    else if (isset($_POST['star-3'])){
        $rate = 3;
    }
    else if (isset($_POST['star-2'])){
        $rate = 2;
    }
    else if (isset($_POST['star-1'])){
        $rate = 1;
    }
    else{
        $rate = "NULL";
    }
    if (isset($_POST['whichCall'])){
        $whichCall = $_POST['whichCall'];
    }
    if (isset($_POST['comment'])){
        $comment = $_POST['comment'];
    }else{
        $comment = "";
    }
    validateCall($whichCall,$rate ,$comment);
    $messageRate = "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
       Vous avez noté de: <strong>".$rate." <i class='fa-solid fa-star'></i> </strong> ce groupe.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
}
//
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
    <script type="text/javascript">
        function openModal(idMsg, callType, userId, interval){

            document.getElementById("senderModal").value = idMsg;
            if (callType == 0){
                document.getElementById("modalLabel").innerHTML = "<i class='fa-solid fa-hand'></i>"+userId+" | Question";
            }else{
                document.getElementById("modalLabel").innerHTML = "<i class='fa-solid fa-check'></i>"+userId+" | Vérification";
            }

        };
    </script>
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


<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="session.php?session=<?php echo $sessionId; if ($isConnected){echo "&id=".$_GET['id'];}?>">
                <div class="modal-body">

                    <div class="container d-flex justify-content-center ">


                        <div class="row">

                            <div class="col-md-12">

                                <div class="stars">

                                    <input class="star star-5" id="star-5" type="radio" name="star-5"/>

                                    <label class="star star-5" for="star-5"></label>

                                    <input class="star star-4" id="star-4" type="radio" name="star-4"/>

                                    <label class="star star-4" for="star-4"></label>

                                    <input class="star star-3" id="star-3" type="radio" name="star-3"/>

                                    <label class="star star-3" for="star-3"></label>

                                    <input class="star star-2" id="star-2" type="radio" name="star-2"/>

                                    <label class="star star-2" for="star-2"></label>

                                    <input class="star star-1" id="star-1" type="radio" name="star-1"/>

                                    <label class="star star-1" for="star-1"></label>

                                    <input id="senderModal" type="hidden" name="whichCall" value=""/>


                                </div>



                            </div>



                        </div>

                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <input class="form-control" type="text" id="comment" name="comment" placeholder="Insérez un commentaire">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button class="btn btn-primary" type="submit" name="sendRate">Noter</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- à la fin de votre page html -->
<script src="js/jquery-3.6.0.min.js" ></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">

    $(document).ready(function($) {
        $('#dataRefresh').load("process_session.php<?php if (isset($sessionId)){
            echo "?session=".$sessionId;
            if ($isConnected){
                echo "&connect=1&id=".$_GET['id'];
            }
        } ?>");

        // refresh auto
        var auto_refresh = setInterval(
            (function () {
                $('#dataRefresh').load("process_session.php<?php if (isset($sessionId)){
                    echo "?session=".$sessionId;
                    if ($isConnected){
                        echo "&connect=1&id=".$_GET['id'];
                    }
                } ?>");
            }), 1000);

    });
</script>
</body>
</html>
