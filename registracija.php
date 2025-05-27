<?php
session_start();
require_once('funkcije/klase.php');
require_once('funkcije/podaci/podaci.php');

$WebSite = new WebSite();
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
?>
    <div class="form-a">
        <div class="form-a-1">
            <form action="korisnik.php?" method="post" target="korisnik">
                <fieldset>
                    <p>PRIJAVA KORISNIKA</p>
                    <input type="hidden" name="registracija" value="prijava" />
                    <label for="">EMAIL</label><br />
                    <input type="email" name="email" /><br />
                    <label for="">LOZINKA</label><br />
                    <input type="password" name="pass" /><br />
                    <button>PRIJAVA</button>
                </fieldset>
            </form>
        </div>

        <div class="form-a-2">
            <form action="korisnik.php" method="post" target="registracija">
                <fieldset>
                    <p>REGISTRACIJA KORISNIKA</p>
                    <input type="hidden" name="registracija" value="registracija" />
                    <label for="">IME</label><br />
                    <input type="text" name="ime" /><br />
                    <label for="">PREZIME</label><br />
                    <input type="text" name="prezime" /><br />
                    <label for="">EMAIL</label><br />
                    <input type="email" name="email" /><br />
                    <label for="">TELEFON</label><br />
                    <input type="text" name="telefon" /><br />
                    <label for="">GRAD</label><br />
                    <input type="text" name="grad" /><br />
                    <label for="">POSTANSKI BROJ</label><br />
                    <input type="number" name="posta" /><br />
                    <label for="">LOZINKA</label><br />
                    <input type="password" name="pass1" /><br />
                    <label for="">PONOVI LOZINKU</label><br />
                    <input type="password" name="pass2" /><br />
                    <button>REGISTRACIJA</button>
                    <iframe class="potvrda" name="registracija" scrolling="no"></iframe>
                </fieldset>
            </form>
        </div>
        <p>.</p>
    </div>
<?php
    $WebSite->footer();
?>
</body>
</html>
