
<?php
$interval = "";
include('functions.php');
if (isset ($_GET['connect'])){
    if ($_GET['connect'] == 1){
        $isConnected = true;
    }else{
        $isConnected = false;
    }
}
else{
    $isConnected = false;
}
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

            <div class="card text-bg-light" >

                <div class="card-header">
                    <h4>Questions</h4>
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

                                                echo  $row['waiting_time'];?>
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
                    <h4>Validations</h4>
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

                                                echo  $row['waiting_time'];?>
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

            <div class="card text-bg-primary" >

                <div class="card-header">
                    <h4>File d'attente</h4>
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
                                            <td><button type="button" onclick="openModal(<?php echo $row['id_waiting'].",".$row['call_type'].",".$row['user_id'].",'".$interval."'";?>)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-square-check fa-2x"></i></button></td>
                                        <?php } ?>
                                    </tr>
                                    <?php

                                    // Modal
                                    ?>

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

            <div class="card text-bg-warning" >

                <div class="card-header">
                    <h4>Notes</h4>
                </div>
                <ul class="list-group list-group-flush ">
                    <li class="list-group-item">
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">n° Table</th>
                                    <th scope="col">Note moyenne</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $ratesList = getRates($sessionId);
                                foreach ($ratesList as $row) {
                                    ?>
                                    <tr class="table table-light">

                                        <td><?php
                                            echo $row['user_id'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo round($row['rates'],1)."/5";
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col">

            <div class="card text-bg-danger" >

                <div class="card-header">
                    <h4>Traités</h4>
                </div>
                <ul class="list-group list-group-flush ">
                    <li class="list-group-item">
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">n° Table</th>
                                    <th scope="col">type d'appel</th>
                                    <th scope="col">date d'appel</th>
                                    <th scope="col">date de résolution</th>
                                    <th scope="col">commentaire</th>
                                    <th scope="col">note</th>

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

                                            echo  $row['waiting_time'];?>
                                        </td>
                                        <td>
                                            <?php

                                            echo  $row['solved_date'];?>
                                        </td>
                                        <td>
                                            <?php

                                            echo  $row['comment'];?>
                                        </td>
                                        <td>
                                            <?php for ($i =0; $i < $row['rate']; $i++){
                                                echo "<i class='fa-solid fa-star text-warning'></i>";
                                            };?>
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
    <?php
} else {
    echo "Aucune session définie";
}
?>


