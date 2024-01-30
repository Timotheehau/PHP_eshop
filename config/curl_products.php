<?php

//L'url cible : celle depuis laquelle on récupère des données en format JSON
// Ici il s'agit d'une liste de produits depuis fakestoreapi
$url = "https://fakestoreapi.com/products";

$ch = curl_init($url); //Initialise une session cURL

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Retourne le transfert sous forme de chaîne de la valeur retournée par curl_exec() au lieu de l'afficher directement.

// On exécute la requete avec curl_exec
$resp = curl_exec($ch);

// si erreur il y a, on l'affiche, sinon on décode la réponse qui est en JSON
if($e = curl_error($ch)){
    var_dump($e);
}else{
    $products = json_decode($resp, true);
}

curl_close($ch); //Ferme une session cURL

?>