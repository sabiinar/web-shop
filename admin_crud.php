<?php
    include("funkcije/podaci/config.php");
    $akcija=$_GET['akcija'];

    if($akcija=='dodaj-proizvod'){ 
        $naziv=$conn->real_escape_string($_POST['naziv']);   
        $marka=$conn->real_escape_string($_POST['marka']);
        $sezona=$conn->real_escape_string($_POST['sezona']);
        $pol=$conn->real_escape_string($_POST['pol']);      
        $cena=$conn->real_escape_string($_POST['cena']);   
        $popust=$conn->real_escape_string($_POST['popust']);   
        $slika=$conn->real_escape_string($_POST['slika']);   
        $brojevi=$conn->real_escape_string($_POST['brojevi']); 
        $broj=explode(",",$brojevi);  
        $kolicina=$conn->real_escape_string($_POST['kolicina']);   
        $dodaj_proizvod="INSERT INTO `proizvodi`(`naziv`, `id_marke`, `sezona`, `pol`, `cena`, `popust`, `slika`) 
        VALUES ('$naziv', '$marka', '$sezona', '$pol', '$cena', '$popust','$slika')";
        if($conn->query($dodaj_proizvod)===false){
            die("GRESKA: ".$conn->error);
        }else{
            $id_proizvoda=$conn->query("SELECT `id_proizvoda` AS `id_p` FROM `proizvodi` WHERE `naziv`='$naziv' AND `pol`='$pol' AND `cena`='$cena';");
            if(mysqli_num_rows($id_proizvoda) != 1){
                die("GRESKA: ".$conn->error);
            }else{
                $id_p = $id_proizvoda->fetch_object()->id_p;
                for($i=0; $i<count($broj); $i++){
                    $br=$broj[$i];
                    $dodaj_brojeve="INSERT INTO `brojevi`(`id_proizvoda`, `broj`, `kolicina`) VALUES ('$id_p', '$br', '$kolicina');";
                    if($conn->query($dodaj_brojeve)===false){
                        die("GRESKA: ".$conn->error);
                    }else{
                        echo ("<script language='JavaScript'>
                            window.alert('Uspešno dodat proizvod.');
                            window.location.href='admin.php';
                            </script>");
                    }
                }
            }
        }        
    }    

    if($akcija=='dodaj-marku'){
        $marka=$conn->real_escape_string($_POST['marka']);
        $dodaj_marku="INSERT INTO `marke`(`naziv_marke`) VALUES ('$marka')";
        if($conn->query($dodaj_marku)===false){
            die("GRESKA: ".$conn->error);
        }else{
            echo ("<script language='JavaScript'>
                window.alert('Uspešno dodata marka.');
                window.location.href='admin.php';
                </script>");
        }
    }

    if($akcija=='izmeni-proizvod'){
        $id_proizvoda=$conn->real_escape_string($_POST['id_proizvoda']);
        if(isset($_POST['naziv'])) {
            $naziv=$conn->real_escape_string($_POST['naziv']);
            $izmeni_naziv = "UPDATE `proizvodi` SET `naziv`='$naziv' WHERE `id_proizvoda`='$id_proizvoda';";
            if($conn->query($izmeni_naziv)===false){
                die("GRESKA: ".$conn->error);
            }
        }
        if(isset($_POST['marka'])) {
            $marka=$conn->real_escape_string($_POST['marka']);
            $izmeni_marku = "UPDATE `proizvodi` SET `id_marke`='$marka' WHERE `id_proizvoda`='$id_proizvoda';";
            if($conn->query($izmeni_marku)===false){
                die("GRESKA: ".$conn->error);
            }
        }
        if(isset($_POST['sezona'])) {
            $sezona=$conn->real_escape_string($_POST['sezona']);
            $izmeni_sezonu = "UPDATE `proizvodi` SET `sezona`='$sezona' WHERE `id_proizvoda`='$id_proizvoda';";
            if($conn->query($izmeni_sezonu)===false){
                die("GRESKA: ".$conn->error);
            }
        }
        if(isset($_POST['pol'])) {
            $pol=$conn->real_escape_string($_POST['pol']);
            $izmeni_pol = "UPDATE `proizvodi` SET `pol`='$pol' WHERE `id_proizvoda`='$id_proizvoda';";
            if($conn->query($izmeni_pol)===false){
                die("GRESKA: ".$conn->error);
            }
        }
        if(isset($_POST['cena'])) {
            $cena=$conn->real_escape_string($_POST['cena']);
            $izmeni_cenu = "UPDATE `proizvodi` SET `cena`='$cena' WHERE `id_proizvoda`='$id_proizvoda';";
            if($conn->query($izmeni_cenu)===false){
                die("GRESKA: ".$conn->error);
            }
        }
        if(isset($_POST['popust'])) {
            $popust=$conn->real_escape_string($_POST['popust']);
            $izmeni_popust = "UPDATE `proizvodi` SET `popust`='$popust' WHERE `id_proizvoda`='$id_proizvoda';";
            if($conn->query($izmeni_popust)===false){
                die("GRESKA: ".$conn->error);
            }
        }
        if(isset($_POST['slika'])) {
            $slika=$conn->real_escape_string($_POST['slika']);
            $izmeni_sliku = "UPDATE `proizvodi` SET `slika`='$slika' WHERE `id_proizvoda`='$id_proizvoda';";
            if($conn->query($izmeni_sliku)===false){
                die("GRESKA: ".$conn->error);
            }
        }
        if(isset($_POST['brojevi']) && isset($_POST['kolicina'])) {
            $brojevi=$conn->real_escape_string($_POST['brojevi']); 
            $broj=explode(",",$brojevi); 
            $kolicina=$conn->real_escape_string($_POST['kolicina']);
            for($i=0; $i<count($broj); $i++){
                $br=$broj[$i];
                $postoji_id = $conn->query("SELECT `id` as `p_id` FROM `brojevi` WHERE `id_proizvoda`='$id_proizvoda' AND `broj`='$br';");
                if(mysqli_num_rows($postoji_id) == false){
                    $dodaj_brojeve="INSERT INTO `brojevi`(`id_proizvoda`, `broj`, `kolicina`) VALUES ('$id_proizvoda', '$br', '$kolicina');";
                    if($conn->query($dodaj_brojeve)===false){
                        die("GRESKA: ".$conn->error);
                    }
                } else {
                    $p_id = $postoji_id->fetch_object()->p_id;
                    $kolicina_pre = $conn->query("SELECT `kolicina` AS `kol` FROM `brojevi` WHERE `id_proizvoda`='$id_proizvoda' AND `broj`='$br';");
                    if(mysqli_num_rows($kolicina_pre) < 0){
                        die("GRESKA: ".$conn->error);
                    } else {
                        $kolicina_pre = $kolicina_pre->fetch_object()->kol;
                        $kolicina_posle = $kolicina_pre + $kolicina;
                        $dodaj_brojeve = "UPDATE `brojevi` SET `kolicina`='$kolicina_posle' WHERE `id_proizvoda`='$id_proizvoda' AND `broj`='$br';";
                        if($conn->query($dodaj_brojeve)===false){
                            die("GRESKA: ".$conn->error);
                        }
                    }
                }
            }
        }
        echo ("<script language='JavaScript'>
            window.alert('Uspešno izmenjen proizvod.');
            window.location.href='admin.php';
            </script>");
    }

    if($akcija=='izmeni-marku'){
        $id_marke=$conn->real_escape_string($_POST['marka']);
        $naziv=$conn->real_escape_string($_POST['naziv_marke']);
        $izmeni_marku=$conn->query("UPDATE `marke` SET `naziv_marke`='$naziv' WHERE `id_marke`='$id_marke';");
        if($izmeni_marku===false){
            die("GRESKA: ".$conn->error);
        }else{
            echo ("<script language='JavaScript'>
                window.alert('Uspešno izmenjena marka.');
                window.location.href='admin.php';
                </script>");
        }
    }

    if($akcija=='izbrisi-proizvod'){
        $proizvod=$conn->real_escape_string($_POST['proizvod']);
        $izbrisi_brojeve ="DELETE FROM `brojevi` WHERE `id_proizvoda`= '$proizvod'";
        $izbrisi_proizvod="DELETE FROM `proizvodi` WHERE `id_proizvoda`= '$proizvod'";
        if($conn->query($izbrisi_brojeve)===false || $conn->query($izbrisi_proizvod)===false){
            die("GRESKA: ".$conn->error);
        }else{
            echo ("<script language='JavaScript'>
                window.alert('Uspešno izbrisan proizvod.');
                window.location.href='admin.php';
                </script>");
        }
    }

    if($akcija=='izbrisi-marku'){
        $marka=$conn->real_escape_string($_POST['marka']);
        $izbrisi_proizvod_marke = "DELETE FROM `proizvodi` WHERE `id_marke` = $marka";

        $izbrisi_marku="DELETE FROM `marke` WHERE `id_marke`= '$marka'";
        if($conn->query($izbrisi_proizvod_marke)===false || $conn->query($izbrisi_marku)===false){
            die("GRESKA: ".$conn->error);
        }else{
            echo ("<script language='JavaScript'>
                window.alert('Uspešno izbrisana marka.');
                window.location.href='admin.php';
                </script>");
        }
    }
?>