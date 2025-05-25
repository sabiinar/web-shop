<?php
session_start();
require_once('funkcije/klase.php');
require_once('funkcije/podaci/podaci.php');

$WebSite = new WebSite();
$grupa = $_GET['grupa'];
$prikaz_proizvoda = new Proizvodi($podaci_proizvoda);
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
    $WebSite->header($marke);
    $prikaz_proizvoda->prikazi_proizvode_grupe($grupa);
    $WebSite->footer();
?>

</body>
</html>
