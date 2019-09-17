<?php
require 'randomsFunctions.php';

$sf1Text = "Développement logiciel métier";
$sf2Text = "Base de données";
$sf3Text = "Applications web";
$sf4Text = "Applications mobile";
$sf1 = isset($_POST['sf1']) ? $sf1Text : "nope";
$sf2 = isset($_POST['sf2']) ? $sf2Text : "nope";
$sf3 = isset($_POST['sf3']) ? $sf3Text : "nope";
$sf4 = isset($_POST['sf4']) ? $sf4Text : "nope";
$sfFinal = sousDomaine(array(
    $sf1,
    $sf2,
    $sf3,
    $sf4
));

$hd1Text = "Composants électroniques et assemblage";
$hd2Text = "Ordinateurs et équipements informatiques";
$hd3Text = "Terminaux mobiles et accessoires";
//newly added
$hd4Text = "Signalétique digitale";
// end
$hd1 = isset($_POST['hd1']) ? $hd1Text: "nope";
$hd2 = isset($_POST['hd2']) ? $hd2Text: "nope";
$hd3 = isset($_POST['hd3']) ? $hd3Text: "nope";
$hd4 = isset($_POST['hd4']) ? $hd4Text: "nope";
$hdFinal = sousDomaine(array(
    $hd1,
    $hd2,
    $hd3,
    $hd4
));

$nt1Text = "Télécoms";
$nt2Text = "Services réseaux";
$nt3Text = "Hosting, cloud";
// newly added
$nt4Text = "Centres d'appels";
$nt5Text = "Plateformes SMS";
$nt6Text = "Serveurs Vocaux";
$nt7Text = "IPBX";
$nt8Text = "Conseil en Sécurité Informatique";
//end
$nt1 = isset($_POST['nt1']) ? $nt1Text : "nope";
$nt2 = isset($_POST['nt2']) ? $nt2Text : "nope";
$nt3 = isset($_POST['nt3']) ? $nt3Text : "nope";
$ntFinal = sousDomaine(array(
    $nt1,
    $nt2,
    $nt3
));

$sc1Text = "Sécurité, monitoring";
$sc2Text = "E-Payement";
$sc3Text = "E-commerce";
$sc4Text = "E-santé";
$sc5Text = "E-agriculture";
$sc6Text = "E-éducation";
// newly added
$sc7Text = "Fintech";
$sc8Text = "Dématérialisation";
$sc9Text = "Smart Cities";
$sc10Text = "Nutrition et distribution";
$sc11Text = "E-tourisme";
// end
$sc1 = isset($_POST['sc1']) ? $sc1Text : "nope";
$sc2 = isset($_POST['sc2']) ? $sc2Text : "nope";
$sc3 = isset($_POST['sc3']) ? $sc3Text : "nope";
$sc4 = isset($_POST['sc4']) ? $sc4Text : "nope";
$sc5 = isset($_POST['sc5']) ? $sc5Text : "nope";
$sc6 = isset($_POST['sc6']) ? $sc6Text : "nope";
$scFinal = sousDomaine(array(
    $sc1,
    $sc2,
    $sc3,
    $sc4,
    $sc5,
    $sc6
));



$ad1Text = "IIoT (internet des objets industrielles)";
$ad2Text = "Intelligence Artificielle (IA)";
$ad5Text = "Big Data";
$ad7Text = "AR/VR (réalités augmentées/réalités virtuelles)";
$ad8Text = "Animation 3D";
$ad9Text = "IoT (internet des objets)";
$ad10Text = "Drone, robotique";
// newly added
$ad11Text = "Imagerie satellitaire et SIG";
$ad12Text = "Distribution de musique Digitale en ligne";
$ad13Text = "Actualités";
$ad14Text = "Fournir des informations";
$ad15Text = "Création de contenus multimédias";
// end
$ad1 = isset($_POST['ad1']) ? $ad1Text : "nope";
$ad2 = isset($_POST['ad2']) ? $ad2Text : "nope";
$ad5 = isset($_POST['ad5']) ? $ad5Text : "nope";
$ad7 = isset($_POST['ad7']) ? $ad7Text : "nope";
$ad8 = isset($_POST['ad8']) ? $ad8Text : "nope";
$ad9 = isset($_POST['ad9']) ? $ad9Text : "nope";
$ad10 = isset($_POST['ad10']) ? $ad10Text : "nope";
$adFinal = sousDomaine(array(
    $ad1,
    $ad2,
    $ad5,
    $ad7,
    $ad8,
    $ad9,
    $ad10
));