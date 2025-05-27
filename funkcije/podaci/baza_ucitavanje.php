<?php

include("config.php");

$proizvodi_baza = $conn->query("SELECT `id_proizvoda`, `naziv`, `id_marke`, `sezona`, `pol`, `cena`, `popust`, `slika` 
    FROM `proizvodi` 
    WHERE 1");
$proizvodi = $proizvodi_baza->fetch_all(MYSQLI_ASSOC);

$marke_baza = $conn->query("SELECT `id_marke`, `naziv_marke` 
    FROM `marke` 
    WHERE 1");
$marke = $marke_baza->fetch_all(MYSQLI_ASSOC);

$slike_baza = $conn->query("SELECT `id_proizvoda`, slike.slika
    FROM `proizvodi_slike` RIGHT OUTER JOIN `slike` ON
    proizvodi_slike.id_slike=slike.id_slike
    WHERE 1");
$slike = $slike_baza->fetch_all(MYSQLI_ASSOC);

$brojevi_baza = $conn->query("SELECT `id_proizvoda`, `broj` 
    FROM `brojevi` 
    WHERE 1");
$brojevi = $brojevi_baza->fetch_all(MYSQLI_ASSOC);

$novi_proizvodi_baza = $conn->query("SELECT `id_proizvoda`, `naziv`, `id_marke`, `sezona`, `pol`, `cena`, `popust`, `slika`
    FROM `proizvodi`
    WHERE 1
    ORDER BY `sezona` DESC");
$novi_proizvodi = $novi_proizvodi_baza->fetch_all(MYSQLI_ASSOC);

$proizvodi_na_akciji_baza = $conn->query("SELECT `id_proizvoda`, `naziv`, `id_marke`, `sezona`, `pol`, `cena`, `popust`, `slika` 
    FROM `proizvodi` 
    WHERE `popust`>0
    ORDER BY `cena`");
$proizvodi_na_akciji = $proizvodi_na_akciji_baza->fetch_all(MYSQLI_ASSOC);

?>