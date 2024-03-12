<?php

include_once "$racine/controleur/prompt.php";

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.aimer.inc.php";

$idR = $_GET["idR"];

$mailU = $authentification->getMailULoggedOn();
if ($mailU != "") {
    $aimer = getAimerById($mailU, $idR);
    if ($aimer == false) {
        addAimer($mailU, $idR);
    } else {
        delAimer($mailU, $idR);
    }
}

// Redirection
header('Location: ' . $_SERVER['HTTP_REFERER']);
