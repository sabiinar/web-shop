<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stil.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;700&family=Hanalei+Fill&display=swap" rel="stylesheet">
</head>
<body>
    
    <?php
        require_once('funkcije/klase.php');
        require_once('funkcije/podaci/podaci.php');

        $WebSite= new WebSite();
        $WebSite->header($marke);

        $pretraga=$_GET['naziv'];
        $nadjeni_proizvodi_baza=$conn->query("SELECT `id_proizvoda`, `naziv`, proizvodi.id_marke , `sezona`, `pol`, `cena`, `popust`, `slika` 
        FROM `proizvodi` LEFT OUTER JOIN `marke` ON proizvodi.id_marke=marke.id_marke
        WHERE `naziv` LIKE '%$pretraga%' OR marke.naziv_marke LIKE '%$pretraga%'");
        $nadjeni_proizvodi=$nadjeni_proizvodi_baza->fetch_all(MYSQLI_ASSOC);
        $objekat_nadjenih_proizvoda = new Podaci($nadjeni_proizvodi,$marke,$slike,$brojevi);
        $podaci_nadjenih_proizvoda=$objekat_nadjenih_proizvoda->get_niz_podataka();
        if(count($podaci_nadjenih_proizvoda)==0) echo "<div class='notice'>PROIZVOD NIJE PRONADJEN</div>";
        else{
            $prikaz_proizvoda= new Proizvodi($podaci_nadjenih_proizvoda);
            $prikaz_proizvoda->prikazi_proizvode();
        }

        $WebSite->footer();
    ?>

</body>
</html>
