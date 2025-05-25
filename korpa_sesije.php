<?php
session_start();

include("funkcije/podaci/config.php");
include("sesija.php");

// Узмемо акцију из URL-а, подразумевано 'dodaj'
$sesija = $_GET['sesija'] ?? 'dodaj';

// Проверa пријаве
if (!isset($_SESSION['provera'])) {
    echo ("<script language='JavaScript'>
        window.alert('Niste prijavljeni.');
        window.location.href='registracija.php';
        </script>");
    exit();
} else {
    if ($sesija == 'dodaj') {
        echo "<p class='potvrda-p'>PROIZVOD JE DODAT U KORPU</p>";

        $id = $_GET['id_proizvoda'];
        $naziv = $_GET['naziv'];
        $cena = $_GET['cena'];
        $broj = $_GET['broj'];
        $kolicina = $_GET['kolicina'];

        if (!isset($_SESSION['stavke_korpe'])) {
            $_SESSION['stavke_korpe'] = [];
        }

        // Функција која проверава да ли је ставка већ у корпи
        function ispitaj($id, $broj) {
            foreach ($_SESSION['stavke_korpe'] as $stavka) {
                if ($stavka['id'] == $id && $stavka['broj'] == $broj) {
                    return false;
                }
            }
            return true;
        }

        // Додавање количине ако ставка постоји
        function dodaj_kolicinu($id, $broj, $kolicina, $cena) {
            foreach ($_SESSION['stavke_korpe'] as &$stavka) {
                if ($stavka['id'] == $id && $stavka['broj'] == $broj) {
                    $stavka['kolicina'] += $kolicina;
                    $stavka['ukupno'] = $stavka['cena'] * $stavka['kolicina'];
                    return;
                }
            }
        }

        // Додавање нове ставке у корпу
        function dodaj_proizvod_u_korpu($id, $naziv, $cena, $broj, $kolicina) {
            $_SESSION['stavke_korpe'][] = [
                'id' => $id,
                'naziv' => $naziv,
                'cena' => $cena,
                'broj' => $broj,
                'kolicina' => $kolicina,
                'ukupno' => $cena * $kolicina
            ];
        }

        if (ispitaj($id, $broj)) {
            dodaj_proizvod_u_korpu($id, $naziv, $cena, $broj, $kolicina);
        } else {
            dodaj_kolicinu($id, $broj, $kolicina, $cena);
        }

    } else if ($sesija == 'prikazi') {
        require_once("prikaz.php");

    } else if ($sesija == 'brisi') {
        $id = $_GET['id'];
        for ($i = 0; $i < count($_SESSION['stavke_korpe']); $i++) {
            if ($_SESSION['stavke_korpe'][$i]['id'] == $id) {
                array_splice($_SESSION['stavke_korpe'], $i, 1);
                break;
            }
        }
        header("Location: korpa_sesije.php?sesija=prikazi");
        exit();

    } else if ($sesija == 'potvrdi_porudzbinu') {
        if (empty($_SESSION['stavke_korpe'])) {
            echo "<p>Korpa je prazna. Nema šta da se poruči.</p>";
            exit();
        }

        $login_sesija_id = $_SESSION['provera']; 

        // Ubacujemo u porudzbine
        $sql_porudzbina = "INSERT INTO porudzbine (id_korisnika, datum_porudzbine, status) VALUES ('$login_sesija_id', NOW(), 0)";
        if (!$conn->query($sql_porudzbina)) {
            die("Greška pri kreiranju porudžbine: " . $conn->error);
        }

        $id_porudzbine = $conn->insert_id;

        // Ubacujemo stavke
        foreach ($_SESSION['stavke_korpe'] as $stavka) {
            $id_proizvoda = $stavka['id'];
            $broj = $stavka['broj'];
            $kolicina = $stavka['kolicina'];

            $sql_stavka = "INSERT INTO stavke_porudzbine (id_porudzbine, id_proizvoda, broj, kolicina) 
                           VALUES ('$id_porudzbine', '$id_proizvoda', '$broj', '$kolicina')";
            if (!$conn->query($sql_stavka)) {
                die("Greška pri ubacivanju stavke porudžbine: " . $conn->error);
            }

            // Smanjujemo zalihe
            $sql_smanji = "UPDATE brojevi SET kolicina = kolicina - $kolicina WHERE id_proizvoda = $id_proizvoda AND broj = $broj";
            if (!$conn->query($sql_smanji)) {
                die("Greška pri smanjenju zaliha: " . $conn->error);
            }
        }

        // Čistimo korpu
        $_SESSION['stavke_korpe'] = [];

        header("Location: korpa_sesije.php?sesija=prikazi&porudzbina=uspesna");
        exit();

    } else if ($sesija == 'isprazni') {
        $_SESSION['stavke_korpe'] = [];
        require_once("prikaz.php");

    } else {
        echo "GREŠKA";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Korpa</title>
    <link rel="stylesheet" href="stil.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;700&family=Hanalei+Fill&display=swap" rel="stylesheet">
</head>
<body>

</body>
</html>
