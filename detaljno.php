<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('funkcije/klase.php');
require_once('funkcije/podaci/podaci.php');

$WebSite = new WebSite();

$id = $_GET['id'] ?? null; // sigurnosna provera da li postoji id
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Document</title>
    <link rel="stylesheet" href="stil.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;700&family=Hanalei+Fill&display=swap" rel="stylesheet" />
</head>
<body>

<?php
$WebSite->header($marke);

if ($id !== null) {
    $prikaz_proizvoda = new Proizvodi($podaci_proizvoda);
    $prikaz_proizvoda->prikazi_proizvode_detaljno($id);
}
?>

<script>
      element.querySelector(".buy-button").onclick=function(){
                element.querySelector("#obavestenje").style.color="blue";  
            }
</script>

<?php
$WebSite->footer();
?>

</body>
</html>
