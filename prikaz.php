<?php
// session_start();
require_once('funkcije/klase.php');
require_once('funkcije/podaci/podaci.php');
$WebSite= new WebSite();
$WebSite->header($marke);
echo "<table border='1' class='tabela-korpa'>";
echo "<tr>";
echo "<th>ID PROIZVODA</th>";
echo "<th>NAZIV</th>";
echo "<th>CENA</th>";
echo "<th>BROJ</th>";
echo "<th>KOLICINA</th>";
echo "<th>UKUPNO</th>";
echo "<th>BRISI</th>";
echo "</tr>";
$s=0;
if(!isset($_SESSION['stavke_korpe'])){
    $d=0;
}else{
    $d=count($_SESSION['stavke_korpe']);
}
for($i=0; $i<$d; $i++){
    echo "<tr>";
    echo "<td>".$_SESSION['stavke_korpe'][$i]['id']."</td>";
    echo "<td>".$_SESSION['stavke_korpe'][$i]['naziv']."</td>";
    echo "<td>".$_SESSION['stavke_korpe'][$i]['cena']."</td>";
    echo "<td>".$_SESSION['stavke_korpe'][$i]['broj']."</td>";
    echo "<td>".$_SESSION['stavke_korpe'][$i]['kolicina']."</td>";
    echo "<td>".$_SESSION['stavke_korpe'][$i]['ukupno']."</td>";
    echo "<td class='brisi-stavke'><a  class='brisi-link' href='korpa_sesije.php?id=".$_SESSION['stavke_korpe'][$i]['id']."&sesija=brisi'>OBRISI</a></td>";
    echo "</tr>";
    $s+=$_SESSION['stavke_korpe'][$i]['ukupno'];
}
echo "<tr>";
echo "<th colspan='6' class='rezultat'>UKUPNO: </th>";
echo "<td class='rezultat'>$s</td>";
echo "</tr>";
echo "</table>";
echo "<p class='p-brisi-korpu'><a href='korpa_sesije.php?sesija=isprazni'>ISPRAZNI KORPU</a></p>";
echo "<p class='p-brisi-korpu'><a href='korpa_sesije.php?sesija=potvrdi_porudzbinu'>POTVRDI PORUDŽBINU</a></p>";
$WebSite->footer();
?>