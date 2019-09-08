<header class="mb-2 mt-1">
    <ul class="nav nav-pills justify-content-center">
        <!-- <li class="navbar-brand logoPSE">
            <img src="images\logoPSE.png" alt="logoPSE" id="logoPSE">
        </li> -->
        <li class="nav-item">
            <a id="home" class="nav-link" href="index.php?page=acceuil">Acceuil</a>
        </li>
        <li class="nav-item">
            <a id="liste" class="nav-link" href="index.php?page=listestartup">Les Startups</a>
        </li>
        <?php
        if (isset($_SESSION['username']) and isset($_SESSION['usermail'])) {
        ?>
        <li class="nav-item">
            <a id="ident" class="nav-link" href="index.php?page=identification">Identification</a>
        </li>
        <?php
        }
        ?>
        <li class="nav-item">
            <a id="formal" class="nav-link" href="index.php?page=formalisation">Comment se formaliser</a>
        </li>
        <?php
        if (isset($_GET['page']) and $_GET['page'] === 'listestartup') {
            ?>
        <li class="nav-item">
            <form action="#" method="POST" class="form-inline">
                <input type="text" name="rech" id="rech" placeholder="Ex: Niang&Co" class="form-control mr-1">
                <input type="submit" value="Rechercher" class="btn btn-primary">
            </form>
        </li>
        <?php
        }
        if (!isset($_SESSION['username']) and !isset($_SESSION['usermail'])) {
            ?>
        <li class="nav-item">
            <a href="index.php?page=signin" class="nav-link">Se Connecter</a>
        </li>
        <li class="nav-item">
            <a href="index.php?page=signup" class="nav-link">S'Inscrire</a>
        </li>
        <?php
        } else {
            ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?= utf8_encode($_SESSION['username']) ?></a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="signout.php">Deconnection</a>
                <!-- <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a> -->
            </div>
        </li>
        <?php
        }
        ?>
        <!-- <li class="nav-item logoSEN"></li> -->
    </ul>
</header>