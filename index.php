<?php
include "getRacine.php";
include "$racine/controleur/controleurPrincipal.php";
include_once "$racine/controleur/prompt.php";
include_once "$racine/modele/authentification.inc.php";

if (isset($_GET["action"])) {
    $fichier = $controller->getAction($_GET["action"]);
} else {
    $fichier = $controller->getAction("defaut");
}

include "$racine/controleur/$fichier";