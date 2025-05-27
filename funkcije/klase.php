<?php
class WebSite
{

    function header($marke)
    {
        echo "<header>";
        echo "<div class='menu'>";
        echo "<div ><a href='index.php'><i class='fa fa-home' aria-hidden='true'></i>POČETNA</a></div>";
        echo "<ul class='manu-1'><a href='proizvodi.php'>PROIZVODI</a>";
        echo "<li><a href='novo.php'>NOVO</a></li>";
        echo "<li><a href='grupa.php?grupa=m'>MUŠKARCI</a></li>";
        echo "<li><a href='grupa.php?grupa=z'>ŽENE</a></li>";
        echo "<li>BREND";
        echo "<ul>";
        for ($i = 0; $i < count($marke); $i++) {
            echo "<li><a href='grupa.php?grupa=" . $marke[$i]['naziv_marke'] . "'>" . $marke[$i]['naziv_marke'] . "</a></li>";
        }
        echo "</ul>";
        echo "</li>";
        echo "</ul>";
        echo "<form action='pretraga.php' class='search-form'>";
        echo "<input type='text' name='naziv' class='search-input' placeholder='Pretraži...'>";
        echo "<button type='submit' class='search-ok'><i class='fa fa-search' aria-hidden='true'></i></button>";
        echo "</form>";
        if(isset($_SESSION['korisnik'])){
            echo "<div><a href='korpa_sesije.php?sesija=prikazi'>KORPA<i class='fa fa-shopping-cart' aria-hidden='true'></i></a></div>";
            echo "<div><a href='logout.php'>IZLOGUJ SE<i class='fa fa-user' aria-hidden='true'></i></a></a></div>";
        } elseif(isset($_SESSION['admin'])){
            echo "<div><a href='admin.php'>ADMIN PANEL</a></div>";
            echo "<div><a href='logout.php'>IZLOGUJ SE<i class='fa fa-user' aria-hidden='true'></i></a></a></div>";
        } else {
            echo "<div></div>";
            echo "<div><a href='registracija.php'>ULOGUJ SE<i class='fa fa-user' aria-hidden='true'></i></a></div>";
        }
        echo "</div>";
        echo "<div class='logo'>SHOES</div>";
        echo "</header>";
    }

    function footer()
    {
        echo "<footer>";
        echo "<div class='footer-c'>";
        echo "<p class='footer-h'>Radno vreme:</p>";
        echo "<p>Radnim danima 09:00h - 16:00h</p>";
        echo "<p>Vikendom: 09:00h - 14:00h</p>";
        echo "<p class='footer-h'>Kontakt: </p>";
        echo "<p>Telefon: 06987654321</p>";
        echo "<p>E-mail: korisnicka.podrska@shoes.com</p>";
        echo "<p class='footer-copyright'>&copy Copyright" . strftime(' %Y ', time()). "shoes-design-team</p>";
        echo "</div>";
        echo "<div class='footer-logo'>SHOES</div>";
        echo "</footer>";
    }
}

class Proizvod
{
    private $id, $naziv, $marka, $sezona, $pol, $cena, $popust, $slika, $slike, $brojevi;

    public function __construct($id, $naziv, $marka, $sezona, $pol, $cena, $popust, $slika, $slike, $brojevi)
    {
        $this->id = $id;
        $this->naziv = $naziv;
        $this->marka = $marka;
        $this->sezona = $sezona;
        $this->pol = $pol;
        $this->cena = $cena;
        $this->popust = $popust;
        $this->slika = $slika;
        $this->slike = $slike;
        $this->brojevi = $brojevi;
    }

    public function cena_popust()
    {
        $cena = $this->cena - ($this->cena * $this->popust) / 100;
        return $cena;
    }

    public function prikazi_proizvod()
    {
        echo "<a href='detaljno.php?id=" . $this->id . "' class='shoes-link'>";
        echo "<div class='shoes'>";
        echo "<div class='shoes-img' style='background-image: url(slike/" . $this->slika . "); '></div>";
        echo "<div class='shoes-h'>" . $this->naziv . "</div>";
        echo "<div class='shoes-pas'>ŠIFRA: " . $this->id . "</div>";
        echo "<div class='shoes-c'>";
        if ($this->popust > 0) {
            echo "<p class='shoes-sale'>" . $this->cena . " rsd</p>";
            echo "<p class='shoes-cost'>" . $this->cena_popust() . " rsd</p>";
        } else {
            echo "<p class='shoes-sale'></p>";
            echo "<p class='shoes-cost'>" . $this->cena . " rsd</p>";
        }
        echo "</div>";
        echo "</div>";
        echo "</a>";
    }

    public function prikazi_proizvod_detaljno()
    {
        echo "<div>";
        echo "<div class='shoes-m'>";
        echo "<div  class='shoes-m-img' style='background-image: url(slike/" . $this->slika . ");'></div>";
        echo "<div class='shoes-m-d'>";
        echo "<p class='shoes-m-d-h'>" . $this->naziv . "</p>";
        echo "<p class='shoes-m-brand'>BREND: " . $this->marka . " | SEZONA: " . $this->sezona. "</p>";
        echo "<p class='shoes-m-pas'>ŠIFRA: " . $this->id . " </p>";
        if ($this->popust > 0) {
            echo "<p class='shoes-m-d-p'>POPUST: " . $this->popust . "%</p>";
            echo "<p class='shoes-m-d-p'>STARA CENA: <span class='shoes-m-sale'>" . $this->cena . " rsd</span></p>";
            echo "<p class='shoes-m-d-p'>CENA: <span class='shoes-m-n-p-span'>" . $this->cena_popust() . " rsd</span></p>";
        } else {
            echo "<p class='shoes-m-d-p'></p>";
            echo "<p class='shoes-m-d-p'><span class='shoes-m-sale'></span></p>";
            echo "<p class='shoes-m-d-p'>CENA: <span class='shoes-m-n-p-span'>" . $this->cena_popust() . " rsd</span></p>";
        }
        echo "</div>";
        echo "<div class='shoes-m-n'>";
        echo "<p class='shoes-m-n-p'>DOSTUPNI BROJEVI:</p>";
        echo "<div class='shoes-m-n-div'>";
        for ($i = 0; $i < count($this->brojevi); $i++) {
            echo "<div class='n'>" . $this->brojevi[$i] . "</div>";
        }
        echo  "</div>";
        echo "</div>";
        echo "<form action='korpa_sesije.php?sesija=dodaj' class='shoes-buy' method='get' target='potvrda'>";
        echo "<input type='hidden' value='" . $this->id . "' class='shoes-buy-input' name='id_proizvoda' id=''>";
        echo "<input type='hidden' value='" . $this->naziv . "' class='shoes-buy-input' name='naziv' id=''>";
        echo "<input type='hidden' value='" . $this->cena_popust() . "' class='shoes-buy-input' name='cena' id=''>";
        echo "<label for=''> BROJ: </label>";
        echo "<select class='shoes-buy-select' name='broj' id=''>";
        for ($i = 0; $i < count($this->brojevi); $i++) {
            echo "<option value='" . $this->brojevi[$i] . "'>" . $this->brojevi[$i] . "</option>";
        }
        echo "</select>";
        echo "<label for=''> KOLIČINA: </label>";
        echo "<input type='number' class='shoes-buy-input' min='1' value='1' name='kolicina' id=''>";
        if(isset($_SESSION['korisnik'])){
            echo "<button class='buy-button' type='submit'>DODAJ</button>";
            echo "<iframe class='potvrda' name='potvrda' scrolling='no'></iframe>";
        }
        echo "</form>";
        echo "<div class='shoes-m-imgs'>";
        for ($i = 0; $i < count($this->slike); $i++) {
            echo "<div class='shoes-m-imgs-div' style='background-image: url(slike/" . $this->slike[$i] . ")'> </div>";
        }
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_marka()
    {
        return $this->marka;
    }

    public function get_pol()
    {
        return $this->pol;
    }
}

class Proizvodi
{
    private $proizvodi;

    public function __construct($podaci)
    {
        $this->proizvodi = [];

        for ($i = 0; $i < count($podaci); $i++) {
            $this->proizvodi[$i] = new Proizvod($podaci[$i]['id'], $podaci[$i]['naziv'], $podaci[$i]['marka'], $podaci[$i]['sezona'], $podaci[$i]['pol'], $podaci[$i]['cena'], $podaci[$i]['popust'], $podaci[$i]['slika'], $podaci[$i]['slike'], $podaci[$i]['brojevi']);
        }
    }

    public function prikazi_proizvode()
    {
        echo "<div>";
        echo "<div class='shoes-1'>";
        for ($i = 0; $i < count($this->proizvodi); $i++) {
            $this->proizvodi[$i]->prikazi_proizvod();
        }
        echo "</div>";
        echo "</div>";
    }

    public function prikazi_proizvode_grupe($grupa)
    {
        echo "<div>";
        echo "<div class='shoes-1'>";
        for ($i = 0; $i < count($this->proizvodi); $i++) {
            if ($this->proizvodi[$i]->get_marka() == $grupa || $this->proizvodi[$i]->get_pol() == $grupa)
                echo $this->proizvodi[$i]->prikazi_proizvod();
        }
        echo "</div>";
        echo "</div>";
    }


    public function prikazi_proizvode_detaljno($id)
    {
        for ($i = 0; $i < count($this->proizvodi); $i++) {
            if ($this->proizvodi[$i]->get_id() == $id) $this->proizvodi[$i]->prikazi_proizvod_detaljno();
        }
    }
}
?>