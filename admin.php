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
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;700&family=Hanalei+Fill&display=swap"
      rel="stylesheet"
    />
</head>
<body>
    <?php
        $WebSite->header($marke);
    ?>
    <div class="admin-crud-kontejner">
        <div class="admin-dodaj-proizvod">
            <form action="admin_crud.php?akcija=dodaj-proizvod" method="post" enctype="multipart/form-data">
                <div class="admin-n">DODAJ PROIZVOD</div>
                <!-- <div class="admin">
                    <label for="">ID PROIZVODA: </label>
                    <input type="number" name="id_proizvoda">
                </div> -->
                <div class="admin">
                    <label for="">NAZIV: </label>
                    <input type="text" name="naziv" />
                </div>
                <div class="admin">
                    <label for="">MARKA: </label>
                    <?php
                        require_once("funkcije/podaci/baza_ucitavanje.php");
                        echo "<select name='marka'>";
                        for($i=0; $i<count($marke); $i++){
                            echo "<option value='" . $marke[$i]['id_marke'] . "'>" . $marke[$i]['naziv_marke'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                </div>
                <div class="admin">
                    <label for="">SEZONA: </label>
                    <?php $sezone = range(2010, date("Y")); ?>
                    <select name="sezona">
                        <option hidden value="2010">Izaberi sezonu</option>
                        <?php foreach($sezone as $sezona) : ?>
                            <option value="<?php echo $sezona; ?>"><?php echo $sezona; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="admin">
                    <label for="">POL: </label>
                    <select name="pol">
                        <option value="m">m</option>
                        <option value="z">z</option>
                    </select>
                </div>
                <div class="admin">
                    <label for="">CENA: </label>
                    <input type="number" name="cena" />
                </div>
                <div class="admin">
                    <label for="">POPUST: </label>
                    <input type="number"  name="popust" />
                </div>
                <div class="admin">
                    <label for="">SLIKA: </label>
                    <input type="file" name="slika" />
                </div>
                <div class="admin">
                    <label for="">BROJEVI: </label>
                    <input type="text" name="brojevi" />
                </div>
                <div class="admin">
                    <label for="">KOLIČINA: </label>
                    <input type="number"  name="kolicina" />
                </div>
                <div class="admin">
                    <button>DODAJ</button>
                </div>
            </form>
        </div>

        <div class="admin-izmeni-proizvod">
            <form action="admin_crud.php?akcija=izmeni-proizvod" method="post" enctype="multipart/form-data">
                <div class="admin-n">IZMENI PROIZVOD</div>
                <div class="admin">
                    <label for="">ID PROIZVODA: </label>
                    <?php
                        require_once("funkcije/podaci/baza_ucitavanje.php");
                        echo "<select name='id_proizvoda'>";
                        for($i=0; $i<count($proizvodi); $i++){
                            echo "<option value='" . $proizvodi[$i]['id_proizvoda'] . "'>" . $proizvodi[$i]['id_proizvoda'] . " | " . $proizvodi[$i]['naziv'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                </div>
                <div class="admin">
                    <label for="">NAZIV: </label>
                    <input type="text" name="naziv" />
                </div>
                <div class="admin">
                    <label for="">MARKA: </label>
                    <?php
                        require_once("funkcije/podaci/baza_ucitavanje.php");
                        echo "<select name='marka'>";
                        for($i=0; $i<count($marke); $i++){
                            echo "<option value='" . $marke[$i]['id_marke'] . "'>" . $marke[$i]['naziv_marke'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                </div>
                <div class="admin">
                    <label for="">SEZONA: </label>
                    <?php $sezone = range(2010, date("Y")); ?>
                    <select name="sezona">
                        <option hidden value="2010">Izaberi sezonu</option>
                        <?php foreach($sezone as $sezona) : ?>
                            <option value="<?php echo $sezona; ?>"><?php echo $sezona; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="admin">
                    <label for="">POL: </label>
                    <select name="pol">
                        <option value="m">m</option>
                        <option value="z">z</option>
                    </select>
                </div>
                <div class="admin">
                    <label for="">CENA: </label>
                    <input type="number" name="cena" />
                </div>
                <div class="admin">
                    <label for="">POPUST: </label>
                    <input type="number"  name="popust" />
                </div>
                <div class="admin">
                    <label for="">SLIKA: </label>
                    <input type="file" name="slika" />
                </div>
                <div class="admin">
                    <label for="">BROJEVI: </label>
                    <input type="text" name="brojevi" />
                </div>
                <div class="admin">
                    <label for="">KOLIČINA: </label>
                    <input type="number"  name="kolicina" />
                </div>
                <div class="admin">
                    <button>IZMENI</button>
                </div>
            </form>
        </div>

        <div class="admin-dodaj-marku">
            <form action="admin_crud.php?akcija=dodaj-marku" method="post">
                <div class="admin-n">DODAJ MARKU</div>
                <div class="admin">
                    <label for="">NAZIV MARKE: </label>
                    <input type="text"  name="marka" />
                </div>
                <div class="admin">
                    <button>DODAJ</button>
                </div>
            </form>
        </div>

        <div class="admin-izmeni-marku">
            <form action="admin_crud.php?akcija=izmeni-marku" method="post">
                <div class="admin-n">IZMENI MARKU</div>
                <div class="admin">
                    <label for="">MARKA: </label>
                    <?php
                        require_once("funkcije/podaci/baza_ucitavanje.php");
                        echo "<select name='marka'>";
                        for($i=0; $i<count($marke); $i++){
                            echo "<option value='" . $marke[$i]['id_marke'] . "'>" . $marke[$i]['id_marke'] . " | " . $marke[$i]['naziv_marke'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                </div>
                <div class="admin">
                    <label for="">NAZIV MARKE:</label>
                    <input type="text" name="naziv_marke" />
                </div>
                <div class="admin">
                    <button>IZMENI</button>
                </div>
            </form>
        </div>

        <div class="admin-izbrisi-proizvod">
            <form action="admin_crud.php?akcija=izbrisi-proizvod" method="post">
                <div class="admin-n">IZBRIŠI PROIZVOD</div>
                <div class="admin">
                    <label for="">PROIZVOD: </label>
                    <?php
                        require_once("funkcije/podaci/baza_ucitavanje.php");
                        echo "<select name='proizvod'>";
                        for($i=0; $i<count($proizvodi); $i++){
                            echo "<option value='" . $proizvodi[$i]['id_proizvoda'] . "'>" . $proizvodi[$i]['id_proizvoda'] . " | " . $proizvodi[$i]['naziv'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                </div>
                <div class="admin">
                    <button>IZBRIŠI</button>
                </div>
            </form>
        </div>

        <div class="admin-izbrisi-marku">
            <form action="admin_crud.php?akcija=izbrisi-marku" method="post">
                <div class="admin-n">IZBRIŠI MARKU</div>
                <div class="admin">
                    <label for="">MARKA: </label>
                    <?php
                        require_once("funkcije/podaci/baza_ucitavanje.php");
                        echo "<select name='marka'>";
                        for($i=0; $i<count($marke); $i++){
                            echo "<option value='" . $marke[$i]['id_marke'] . "'>" . $marke[$i]['id_marke'] . " | " . $marke[$i]['naziv_marke'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                </div>
                <div class="admin">
                    <button>IZBRIŠI</button>
                </div>
            </form>
        </div>
    </div>

    <?php
        $WebSite->footer();
    ?>
</body>
</html>
