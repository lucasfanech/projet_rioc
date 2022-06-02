<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="img/logo_200px.png"  alt="logo" height="50px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link<?php if (isset($tab)){if ($tab == "index" ){ echo " active";}}?>" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if (isset($tab)){if ($tab == "join" ){ echo " active";}}?>" href="simulate.php">Rejoindre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if (isset($tab)){if ($tab == "waiting" ){ echo " active";}}?>" href="waiting.php">Liste d'attente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if (isset($tab)){if ($tab == "admin" ){ echo " active";}}?>" href="admin.php">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>