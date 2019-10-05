<header class="mb-2 mt-0">
    <nav class="navbar navbar-expand-lg navbar-light align-content-center">
        <a class="navbar-brand" href="index.php?page=acceuil"><i class="fas fa-home fa-1x"></i> sen-startups </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="home" class="nav-link" href="index.php?page=acceuil">Acceuil</a>
                </li>
                <li class="nav-item dropdown">
                    <!-- <a id="liste" class="nav-link dropdown-toggle" href="index.php?page=listestartup">Les Startups</a> -->
                    <a class="nav-link dropdown-toggle" href="#" id="liste" role="button" data-toggle="dropdown" data-trigger="hover" aria-haspopup="true" aria-expanded="false">
                        Entreprises
                    </a>
                    <div class="dropdown-menu" aria-labelledby="liste">
                        <a class="dropdown-item" href="index.php?page=listestartup&p=1">Liste complete</a>
                        <div class="dropdown-divider"></div>
                        <form action="index.php?page=listestartup" method="POST">
                            <button class="dropdown-item" type="submit" name="sf">Domaine Software</button>
                            <button class="dropdown-item" type="submit" name="hd">Domaine Hardware</button>
                            <button class="dropdown-item" type="submit" name="nt">Domaine ICT Network</button>
                            <button class="dropdown-item" type="submit" name="sc">Domaine ICT Service</button>
                            <button class="dropdown-item" type="submit" name="ad">Domaine ICT Advance</button>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-trigger="hover" data-toggle="dropdown" id="labelisation">
                        Labellisation
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?page=labelProcessus">Processus de labellisation</a>
                        <a class="dropdown-item" href="index.php?page=labelEnrStartups">Startups Enregistrés</a>
                        <a class="dropdown-item" href="index.php?page=labelLabStartups">Startups Labellisés</a>
                    </div>
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
                    <a id="formal" class="nav-link disabled" href="index.php?page=formalisation">Comment se formaliser</a>
                </li>
            </ul>
            <?php
            if (isset($_GET['page']) and $_GET['page'] === 'listestartup') {
                ?>
                <form id="rechForm" class="form-inline my-2 my-lg-0" action="index.php?page=listestartup&p=1" method="POST">
                    <input class="form-control mr-sm-2" type="search" placeholder="nom de startup" aria-label="Rechercher" name="rech" id="rech">
                    <button type="submit" class="btn btn-outline-primary">Rechercher</button> 
                </form>
            <?php
            }
            if (!isset($_SESSION['username']) and !isset($_SESSION['usermail'])) {
                ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.php?page=signin" class="nav-link" id="signin">Connection</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=signup" class="nav-link"id="signup">Inscription</a>
                    </li>
                </ul>
            <?php
            } else {
                ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?= utf8_encode($_SESSION['username']) ?></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="signout.php">Deconnexion</a>
                        </div>
                    </li>
                </ul>
            <?php
            }
            ?>
        </div>
    </nav>
</header>