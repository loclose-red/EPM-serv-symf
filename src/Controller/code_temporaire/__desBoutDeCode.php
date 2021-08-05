<?php

////////////////////////////////////////////////////
//  ici un bout de code permettant de boucler sur tous les sites
//  pour récupérer les id des utilisateurs référencés
//  j'utilise la methode ->current() pour recupérer l'objet entity ulilisateur car je n'y accède pas directement!
// la fonction $unsite->getUtilisateurs() retourne un oblet doctrine: doctrine orm persistentcollection
// je ne sais pas pourquoi!
//
// cette boucle sera utile lors du filtrage sur un utilisateur pour obtenir tous les site qu'il peut voir

$tousLesSites = $siteRepository->findAll();
// dd($tousLesSites);
$desElements = [];
foreach ($tousLesSites as $unsite) {
// dd($unsite);
$unid = $unsite->getUtilisateurs()->current();
$desElements[] = $unid;
// dd($unid);

if ($unid != false) {
// $unid->getId();
// dd($unid);
consoleLog($unid->getId());
}
}
// dd($desElements);


