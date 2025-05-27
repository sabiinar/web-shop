<?php

    require_once('baza_klasa.php');
    require_once('baza_ucitavanje.php');

    $objekat_proizvoda=new Podaci($proizvodi, $marke, $slike, $brojevi);
    $podaci_proizvoda=$objekat_proizvoda->get_niz_podataka();

    $objekat_novih_proizvoda=new Podaci($novi_proizvodi, $marke, $slike, $brojevi);
    $podaci_novih_proizvoda=$objekat_novih_proizvoda->get_niz_podataka();

    $objekat_proizvoda_na_akciju=new Podaci($proizvodi_na_akciji, $marke, $slike, $brojevi);
    $podaci_proizvoda_na_akciji=$objekat_proizvoda_na_akciju->get_niz_podataka();

?>