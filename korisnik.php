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
    $pass1 = $_POST['pass1'];  
    $pass2 = $_POST['pass2'];

    if ($pass1 === $pass2) {
        // Хеширање лозинке
        $lozinka_hash = password_hash($pass1, PASSWORD_DEFAULT);

        $dodaj_korisnika = "INSERT INTO `korisnik` (`ime`, `prezime`, `email`, `telefon`, `grad`, `postanski_broj`, `lozinka`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($dodaj_korisnika);
        $stmt->bind_param("sssssis", $ime, $prezime, $email, $telefon, $grad, $posta, $lozinka_hash);

        if ($stmt->execute() === false) {
            die("GREŠKA: " . $stmt->error);
        } else {
            echo "USPEŠNO STE REGISTROVANI";
        }
        $stmt->close();
    } else {
        echo "LOZINKE SE NE POKLAPAJU";
    }
} else if ($registracija == 'prijava') {
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['pass'];  // Немој да екранираш лозинку овде

    // Узми податке корисника са тим email-ом (укључујући и хеш лозинке)
    $upit = "SELECT `id_korisnika` AS `id`, `ime`, `prezime`, `email`, `telefon`, `grad`, `postanski_broj`, `lozinka` FROM `korisnik` WHERE email = ?";
    $stmt = $conn->prepare($upit);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $rezultat = $stmt->get_result();

    if ($rezultat->num_rows === 1) {
        $korisnik = $rezultat->fetch_assoc();
        // Проверимо лозинку са password_verify
        if (password_verify($pass, $korisnik['lozinka'])) {
            // Ако је админ, поставимо посебне сесије
            if ($email === "admin@shoes.com") {
                $_SESSION['id_korisnika'] = $korisnik['id'];
                $_SESSION['admin'] = $email;
                $_SESSION['provera'] = 1;
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['id_korisnika'] = $korisnik['id'];
                $_SESSION['korisnik'] = $email;
                $_SESSION['provera'] = 1;
                header("Location: index.php");
                exit();
            }
        } else {
            // Лозинка није исправна
            echo ("<script language='JavaScript'>
                window.alert('Neuspešna prijava. Pogrešan email ili lozinka.');
                window.location.href='registracija.php';
                </script>");
        }
    } else {
        // Корисник са тим имејлом не постоји
        echo ("<script language='JavaScript'>
            window.alert('Neuspešna prijava. Pogrešan email ili lozinka.');
            window.location.href='registracija.php';
            </script>");
    }

    $stmt->close();
}
?>
