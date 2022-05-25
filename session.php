<?php

include('db.php');
include('functions.php'); // Fonctions PHP
$isConnected = false;
include('checkLogin.php'); // nous renvoei $isConneected true ou false

// Traitement Rating
if (isset($_POST['sendRate'])){
    if (isset($_POST['star-5'])){
        $rate = 5;
    }
    if (isset($_POST['star-4'])){
        $rate = 4;
    }
    if (isset($_POST['star-3'])){
        $rate = 3;
    }
    if (isset($_POST['star-2'])){
        $rate = 2;
    }
    if (isset($_POST['star-1'])){
        $rate = 1;
    }
    if (isset($_POST['whichCall'])){
        $whichCall = $_POST['whichCall'];
    }
    validateCall($whichCall,$rate);
    $messageRate = "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
       Vous avez noté de: <strong>".$rate." <i class='fa-solid fa-star'></i> </strong> la pertinence de la question.
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
    <title>TP-BOX</title>
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
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
                    <span class="fs-4">Session <?php if (isset($_GET['session'])) {
        $sessionId = $_GET['session'];
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
            <div class="container-fluid">
<?php
if ($isConnected) {
}else{
    echo "Vous n'êtes pas connecté<br>";
}

if (isset($_GET['session'])) {
    $sessionId = $_GET['session'];

    $waitingList = getWaitingList($sessionId);

    ?>
    <div class="row">
        <div class="col-md-3">
            <h3>Question/Validation</h3>
            <div class="card text-bg-light" >

                <div class="card-header">
                    Questions
                </div>
                <ul class="list-group list-group-flush ">
                    <li class="list-group-item">
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">n° Table</th>
                                    <th scope="col">type d'appel</th>
                                    <th scope="col">date</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($waitingList as $row) {
                                    if ($row['call_type'] == 0){
                                    ?>
                                    <tr <?php if ($row['call_type'] == 0){echo "class='table-light'";}else{echo "class='table-success'";}?>>
                                        <td><?php
                                            if ($row['call_type'] == 0){
                                                echo "<i class='fa-solid fa-hand fa-2x'></i>";
                                            }else{
                                                echo "<i class='fa-solid fa-check fa-2x'></i>";
                                            }
                                            echo $row['user_id']?></td>
                                        <td><?php
                                            if ($row['call_type'] == 0){
                                                echo "Question";
                                            }else{
                                                echo "Vérification";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php

                                            //$debut = new DateTime($row['waiting_time']);

                                            // Execution de code
                                            //$fin = new DateTime('now');
                                            $interval = getInterval($row['waiting_time']);
                                            //$interval = $debut->diff($fin)->format('%r%y years, %m months, %d days, %h hours, %i minutes, %s seconds');

                                            echo  $interval?>
                                        </td>

                                    </tr>
                                    <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>

            </div>
            <!-- Validations -->
            <div class="card text-bg-success" >

                <div class="card-header">
                    Validations
                </div>
                <ul class="list-group list-group-flush ">
                    <li class="list-group-item">
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">n° Table</th>
                                    <th scope="col">type d'appel</th>
                                    <th scope="col">date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($waitingList as $row) {
                                    if ($row['call_type'] == 1){
                                    ?>
                                    <tr <?php if ($row['call_type'] == 0){echo "class='table-light'";}else{echo "class='table-success'";}?>>
                                        <td><?php
                                            if ($row['call_type'] == 0){
                                                echo "<i class='fa-solid fa-hand fa-2x'></i>";
                                            }else{
                                                echo "<i class='fa-solid fa-check fa-2x'></i>";
                                            }
                                            echo $row['user_id']?></td>
                                        <td><?php
                                            if ($row['call_type'] == 0){
                                                echo "Question";
                                            }else{
                                                echo "Vérification";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php

                                            //$debut = new DateTime($row['waiting_time']);

                                            // Execution de code
                                            //$fin = new DateTime('now');
                                            $interval = getInterval($row['waiting_time']);
                                            //$interval = $debut->diff($fin)->format('%r%y years, %m months, %d days, %h hours, %i minutes, %s seconds');

                                            echo  $interval?>
                                        </td>

                                    </tr>
                                    <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
        <div class="col-md-6">
            <h3>File d'attente</h3>
            <div class="card text-bg-primary" >

                <div class="card-header">
                    File d'attente
                </div>
                <ul class="list-group list-group-flush ">
                    <li class="list-group-item">
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">n° Table</th>
                                    <th scope="col">type d'appel</th>
                                    <th scope="col">date</th>
                                    <?php if ($isConnected) { ?>
                                    <th scope="col">résoudre</th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($waitingList as $row) {
                                    ?>
                                    <tr <?php if ($row['call_type'] == 0){echo "class='table-light'";}else{echo "class='table-success'";}?>>
                                        <td><?php
                                            if ($row['call_type'] == 0){
                                                echo "<i class='fa-solid fa-hand fa-2x'></i>";
                                            }else{
                                                echo "<i class='fa-solid fa-check fa-2x'></i>";
                                            }
                                            echo $row['user_id']?></td>
                                        <td><?php
                                            if ($row['call_type'] == 0){
                                                echo "Question";
                                            }else{
                                                echo "Vérification";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php

                                            //$debut = new DateTime($row['waiting_time']);

                                            // Execution de code
                                            //$fin = new DateTime('now');
                                            $interval = getInterval($row['waiting_time']);
                                            //$interval = $debut->diff($fin)->format('%r%y years, %m months, %d days, %h hours, %i minutes, %s seconds');

                                            echo  $interval?>
                                        </td>
                                        <?php if ($isConnected) { ?>
                                            <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['id_waiting']; ?>"><i class="fa-solid fa-square-check fa-2x"></i></button></td>
                                        <?php } ?>
                                    </tr>
                                    <?php

                                        // Modal
                                        ?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal<?php echo $row['id_waiting']; ?>" tabindex="-1" aria-labelledby="#modal<?php echo $row['id_waiting']; ?>Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#modal<?php echo $row['id_waiting']; ?>Label">
                                                            <?php
                                                            if ($row['call_type'] == 0){
                                                                echo "<i class='fa-solid fa-hand'></i>";
                                                            }else{
                                                                echo "<i class='fa-solid fa-check'></i>";
                                                            }
                                                            echo $row['user_id'];
                                                            if ($row['call_type'] == 0){
                                                                echo " | Question";
                                                            }else{
                                                                echo " | Vérification";
                                                            }
                                                            ?>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="session.php?session=<?php echo $sessionId; if ($isConnected){echo "&id=".$_GET['id'];}?>">
                                                    <div class="modal-body">
                                                        <?php echo  $interval;?>
                                                        <div class="container d-flex justify-content-center ">


                                                            <div class="row">

                                                                <div class="col-md-12">

                                                                    <div class="stars">

                                                                            <input class="star star-5" id="star-5-<?php echo $row['id_waiting']; ?>" type="radio" name="star-5"/>

                                                                            <label class="star star-5" for="star-5-<?php echo $row['id_waiting']; ?>"></label>

                                                                            <input class="star star-4" id="star-4-<?php echo $row['id_waiting']; ?>" type="radio" name="star-4"/>

                                                                            <label class="star star-4" for="star-4-<?php echo $row['id_waiting']; ?>"></label>

                                                                            <input class="star star-3" id="star-3-<?php echo $row['id_waiting']; ?>" type="radio" name="star-3"/>

                                                                            <label class="star star-3" for="star-3-<?php echo $row['id_waiting']; ?>"></label>

                                                                            <input class="star star-2" id="star-2-<?php echo $row['id_waiting']; ?>" type="radio" name="star-2"/>

                                                                            <label class="star star-2" for="star-2-<?php echo $row['id_waiting']; ?>"></label>

                                                                            <input class="star star-1" id="star-1-<?php echo $row['id_waiting']; ?>" type="radio" name="star-1"/>

                                                                            <label class="star star-1" for="star-1-<?php echo $row['id_waiting']; ?>"></label>

                                                                            <input type="hidden" name="whichCall" value="<?php echo $row['id_waiting']; ?>"/>


                                                                    </div>



                                                                </div>


                                                            </div>

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
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
        <div class="col-md-3">
            <h3>Traités</h3>
            <div class="card text-bg-danger" >

                <div class="card-header">
                    Traités
                </div>
                <ul class="list-group list-group-flush ">
                    <li class="list-group-item">
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">n° Table</th>
                                    <th scope="col">type d'appel</th>
                                    <th scope="col">date</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $doneList = getDoneList($sessionId);
                                foreach ($doneList as $row) {
                                        ?>
                                        <tr <?php if ($row['call_type'] == 0){echo "class='table-light'";}else{echo "class='table-success'";}?>>
                                            <td><?php
                                                if ($row['call_type'] == 0){
                                                    echo "<i class='fa-solid fa-hand fa-2x'></i>";
                                                }else{
                                                    echo "<i class='fa-solid fa-check fa-2x'></i>";
                                                }
                                                echo $row['user_id']?></td>
                                            <td><?php
                                                if ($row['call_type'] == 0){
                                                    echo "Question";
                                                }else{
                                                    echo "Vérification";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                //$debut = new DateTime($row['waiting_time']);

                                                // Execution de code
                                                //$fin = new DateTime('now');
                                                $interval = getInterval($row['waiting_time']);
                                                //$interval = $debut->diff($fin)->format('%r%y years, %m months, %d days, %h hours, %i minutes, %s seconds');

                                                echo  $interval?>
                                            </td>

                                        </tr>
                                        <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
    <div>
        <h3>Commentaires</h3>
    </div>
                <?php
} else {
    echo "Aucune session définie";
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
