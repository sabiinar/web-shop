<?php
include("funkcije/podaci/config.php");
session_start();

$registracija = $_POST['registracija'];

if ($registracija == 'registracija') {
    $ime = $conn->real_escape_string($_POST['ime']);
    $prezime = $conn->real_escape_string($_POST['prezime']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefon = $conn->real_escape_string($_POST['telefon']);
    $grad = $conn->real_escape_string($_POST['grad']);
    $posta = $conn->real_escape_string($_POST['posta']);
    $pass1 = $conn->real_escape_string($_POST['pass1']);
    $pass2 = $conn->real_escape_string($_POST['pass2']);

    if ($pass1 == $pass2) {
        $dodaj_korisnika = "INSERT INTO `korisnik`(`ime`, `prezime`, `email`, `telefon`, `grad`, `postanski_broj`, `lozinka`)
        VALUES ('$ime','$prezime','$email','$telefon','$grad','$posta','$pass1')";
        if ($conn->query($dodaj_korisnika) === false) {
            die("GREŠKA: " . $conn->error);
        } else {
            echo "USPEŠNO STE REGISTROVANI";
        }
    } else {
        echo "LOZINKE SE NE POKLAPAJU";
    }
} else if ($registracija == 'prijava') {
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $conn->real_escape_string($_POST['pass']);

    $provera = $conn->query("SELECT `id_korisnika` AS `id`, `ime`, `prezime`, `email`, `telefon`, `grad`, `postanski_broj`, `lozinka` 
    FROM `korisnik` 
    WHERE korisnik.email='$email' AND korisnik.lozinka='$pass'");

    if (!$provera) {
        die("Greška u upitu: " . $conn->error);
    }

    $provera_niz = $provera->fetch_all(MYSQLI_ASSOC);

    if (count($provera_niz) == 1) {
        $id_korisnika = $provera_niz[0]['id'];
        if ($email == "admin@shoes.com" && $pass == "admin") {
            $_SESSION['id_korisnika'] = $id_korisnika;
            $_SESSION['admin'] = $email;
            $_SESSION['provera'] = 1;
            header("location: index.php");
            exit();
        } else {
            $_SESSION['id_korisnika'] = $id_korisnika;
            $_SESSION['korisnik'] = $email;
            $_SESSION['provera'] = 1;
            header("location: index.php");
            exit();
        }
    } else {
        $greska = "Neispravni email ili lozinka.";
        echo ("<script language='JavaScript'>
                window.alert('Neuspešna prijava. $greska Probaj opet.');
                window.location.href='registracija.php';
                </script>");
    }
}
?>
