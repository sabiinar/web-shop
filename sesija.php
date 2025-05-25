<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('funkcije/podaci/config.php');

// Proveri da li je korisnik ulogovan
if (!isset($_SESSION['korisnik']) || !isset($_SESSION['id_korisnika'])) {
    // Nema sesije - preusmeri na index ili login stranicu
    header("Location: index.php");
    exit();
}

// Iz sesije uzmi podatke
$provera_korisnika_email = $_SESSION['korisnik'];
$provera_korisnika_id = $_SESSION['id_korisnika'];

// Napravi jedan upit da dobiješ i email i id_korisnika
$stmt = $conn->prepare("SELECT `id_korisnika`, `email` FROM `korisnik` WHERE `email` = ?");
$stmt->bind_param("s", $provera_korisnika_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $red = $result->fetch_assoc();
    $login_sesija_email = $red['email'];
    $login_sesija_id = $red['id_korisnika'];
} else {
    // Ako korisnik nije pronađen u bazi, briši sesiju i vrati na login
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Sada možeš koristiti $login_sesija_email i $login_sesija_id u daljem kodu
?>
