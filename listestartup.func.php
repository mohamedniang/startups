<?php

$secteurActive = false;
$filter = "";
$nombreMax = 15;
$p = (isset($_GET['p']) && is_numeric($_GET['p'])) ? $_GET['p'] : 1;

if (isset($_POST['dc'])) {
    $totalCountQuest = "SELECT COUNT(date_creation) FROM listestartups ";
    if ($totalCount = $bdd->query($totalCountQuest)) {
        $totalCount = $totalCount->fetch_row()[0];
    } else {
        echo "error dc";
    }
    if ($req = $bdd->prepare('SELECT denomination, adresse, id, description FROM listestartups ORDER BY date_creation DESC LIMIT ?,?')) {
        // Calculate the page to get the results we need from our table.
        $calc_page = ($p - 1) * $nombreMax;
        $req->bind_param('ii', $calc_page, $nombreMax);
        $req->execute();
        // Get the results...
        $res = $req->get_result();
        $req->close();
        $secteurActive = false;
        $filter = "dc";
    }
} else if (isset($_POST['nt'])) {
    $totalCountQuest = "SELECT COUNT(*) FROM listestartups WHERE ict_network = 1";
    if ($totalCount = $bdd->query($totalCountQuest)) {
        $totalCount = $totalCount->fetch_row()[0];
    } else {
        echo "error nt";
    }
    if ($req = $bdd->prepare('SELECT denomination, adresse, id, description FROM listestartups WHERE ict_network = 1 ORDER BY date_creation DESC LIMIT ?,?')) {
        // Calculate the page to get the results we need from our table.
        $calc_page = ($p - 1) * $nombreMax;
        $req->bind_param('ii', $calc_page, $nombreMax);
        $req->execute();
        // Get the results...
        $res = $req->get_result();
        $req->close();
        $secteurActive = true;
        $filter = "nt";
    }
} else if (isset($_POST['sc'])) {
    $totalCountQuest = "SELECT COUNT(*) FROM listestartups WHERE ict_service = 1";
    if ($totalCount = $bdd->query($totalCountQuest)) {
        $totalCount = $totalCount->fetch_row()[0];
    } else {
        echo "error sc";
    }
    if ($req = $bdd->prepare('SELECT denomination, adresse, id, description FROM listestartups WHERE ict_service = 1 ORDER BY date_creation DESC LIMIT ?,?')) {
        // Calculate the page to get the results we need from our table.
        $calc_page = ($p - 1) * $nombreMax;
        $req->bind_param('ii', $calc_page, $nombreMax);
        $req->execute();
        // Get the results...
        $res = $req->get_result();
        $req->close();
        $secteurActive = true;
        $filter = "sc";
    } else {
        echo "error" . $bdd->error_get_last();
    }
} else if (isset($_POST['ad'])) {
    $totalCountQuest = "SELECT COUNT(*) FROM listestartups WHERE ict_advance = 1";
    if ($totalCount = $bdd->query($totalCountQuest)) {
        $totalCount = $totalCount->fetch_row()[0];
    } else {
        echo "error ad";
    }
    if ($req = $bdd->prepare('SELECT denomination, adresse, id, description FROM listestartups WHERE ict_advance = 1 ORDER BY date_creation DESC LIMIT ?,?')) {
        // Calculate the page to get the results we need from our table.
        $calc_page = ($p - 1) * $nombreMax;
        $req->bind_param('ii', $calc_page, $nombreMax);
        $req->execute();
        // Get the results...
        $res = $req->get_result();
        $req->close();
        $secteurActive = true;
        $filter = "ad";
    }
} else if (isset($_POST['sf']) || (isset($_GET['filter']) && !empty($_GET['filter']) && $_GET['filter'] == "sf")) {
    $totalCountQuest = "SELECT COUNT(*) FROM listestartups WHERE software = 1";
    if ($totalCount = $bdd->query($totalCountQuest)) {
        $totalCount = $totalCount->fetch_row()[0];
    } else {
        echo "error sf";
    }
    if ($req = $bdd->prepare('SELECT denomination, adresse, id, description FROM listestartups WHERE software = 1 ORDER BY date_creation DESC LIMIT ?,?')) {
        // Calculate the page to get the results we need from our table.
        $calc_page = ($p - 1) * $nombreMax;
        $req->bind_param('ii', $calc_page, $nombreMax);
        $req->execute();
        // Get the results...
        $res = $req->get_result();
        $req->close();
        $secteurActive = true;
        $filter = "sf";
    }
} else if (isset($_POST['hd'])) {
    $totalCountQuest = "SELECT COUNT(*) FROM listestartups WHERE hardware = 1";
    if ($totalCount = $bdd->query($totalCountQuest)) {
        $totalCount = $totalCount->fetch_row()[0];
    } else {
        echo "error hd";
    }
    if ($req = $bdd->prepare('SELECT denomination, adresse, id, description FROM listestartups WHERE hardware = 1 ORDER BY date_creation DESC LIMIT ?, ?')) {
        // Calculate the page to get the results we need from our table.
        $calc_page = ($p - 1) * $nombreMax;
        $req->bind_param('ii', $calc_page, $nombreMax);
        $req->execute();
        // Get the results...
        $res = $req->get_result();
        $req->close();
        $secteurActive = true;
        $filter = "hd";
    }
} else if (isset($_POST['rg'])) {
    $totalCountQuest = "SELECT COUNT(*) FROM listestartups ";
    if ($totalCount = $bdd->query($totalCountQuest)) {
        $totalCount = $totalCount->fetch_row()[0];
    } else {
        echo "error rg";
    }
    if ($req = $bdd->prepare('SELECT denomination, adresse, id, description FROM listestartups ORDER BY adresse DESC LIMIT ?, ?')) {
        // Calculate the page to get the results we need from our table.
        $calc_page = ($p - 1) * $nombreMax;
        $req->bind_param('ii', $calc_page, $nombreMax);
        $req->execute();
        // Get the results...
        $res = $req->get_result();
        $req->close();
        $secteurActive = false;
        $filter = "rg";
    }
} else {
    $totalCountQuest = "SELECT COUNT(*) FROM listestartups ";
    if ($totalCount = $bdd->query($totalCountQuest)) {
        $totalCount = $totalCount->fetch_row()[0];
    } else {
        echo "error def";
    }
    if ($req = $bdd->prepare('SELECT denomination, adresse, id, description FROM listestartups LIMIT ?,?')) {
        // Calculate LIMIT ?,? the page to get the results we need from our table.
        $calc_page = ($p - 1) * $nombreMax;
        $req->bind_param('ii', $calc_page, $nombreMax);
        $req->execute();
        // Get the results...
        $res = $req->get_result();
        $req->close();
        $secteurActive = false;
        $filter = "";
    }
}

if (isset($_POST['rech']) and !empty($_POST['rech'])) {
    $rech = preg_replace("#[^0-9a-z]#i", "", $_POST['rech']);
    $totalCountQuest = "SELECT COUNT(*) FROM listestartups WHERE denomination LIKE '%" . $rech . "%'";
    if ($totalCount = $bdd->query($totalCountQuest)) {
        $totalCount = $totalCount->fetch_row()[0];
    } else {
        echo "error rech";
    }
    if ($req = $bdd->prepare("SELECT * FROM listestartups WHERE denomination LIKE '%" . $rech . "%' LIMIT ?,?")) {
        // Calculate LIMIT ?,? the page to get the results we need from our table.
        $calc_page = ($p - 1) * $nombreMax;
        $req->bind_param('ii', $calc_page, $nombreMax);
        $req->execute();
        // Get the results...
        $res_startup = $req->get_result();
        $req->close();
        $secteurActive = false;
    }
}