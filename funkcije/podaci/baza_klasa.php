<?php

    class Podaci{
    private $niz_podataka;

    public function __construct($proizvodi, $marke ,$slike, $brojevi){
        $this->niz_podataka=[];
        for($i=0; $i<count($proizvodi); $i++){
            $podatak=[];
            for($j=0; $j<count($marke); $j++)
                if($proizvodi[$i]['id_marke']==$marke[$j]['id_marke'])
                    $marka_pomocna=$marke[$j]['naziv_marke'];
            $slike_pomocni_niz=[];
            for($m=0; $m<count($slike); $m++){
                if($proizvodi[$i]['id_proizvoda']==$slike[$m]['id_proizvoda']) array_push($slike_pomocni_niz,$slike[$m]['slika']);
            }
            $brojevi_pomocni_niz=[];
            for($n=0; $n<count($brojevi); $n++){
                if($proizvodi[$i]['id_proizvoda']==$brojevi[$n]['id_proizvoda']) array_push($brojevi_pomocni_niz,$brojevi[$n]['broj']);
            }           
            $podatak=['id'=>$proizvodi[$i]['id_proizvoda'],'naziv'=>$proizvodi[$i]['naziv'],'marka'=>$marka_pomocna,'sezona'=>$proizvodi[$i]['sezona'],'pol'=>$proizvodi[$i]['pol'],'cena'=>$proizvodi[$i]['cena'],'popust'=>$proizvodi[$i]['popust'],'slika'=>$proizvodi[$i]['slika'],'slike'=>$slike_pomocni_niz, 'brojevi'=>$brojevi_pomocni_niz];
            array_push($this->niz_podataka,$podatak);
        }
    }

    public function get_niz_podataka(){
        return $this->niz_podataka;
    }

    public function tabela_podataka(){
        echo "<table border='1'>";
            echo "<tr>";
                echo "<th>ID PROIZVODA</th>";
                echo "<th>NAZIV</th>";
                echo "<th>MARKA</th>";
                echo "<th>SEZONA</th>";
                echo "<th>M/Z</th>";
                echo "<th>CENA</th>";
                echo "<th>POPUST</th>";
                echo "<th>SLIKA</th>";
                echo "<th>SLIKE</th>";
                echo "<th>DOSTUPNI BROJEVI</th>";
            echo "</tr>";
                for($i=0; $i<count($this->niz_podataka); $i++){
                    echo "<tr>";
                    echo "<td>".$this->niz_podataka[$i]['id']."</td>";
                    echo "<td>".$this->niz_podataka[$i]['naziv']."</td>";
                    echo "<td>".$this->niz_podataka[$i]['marka']."</td>";
                    echo "<td>".$this->niz_podataka[$i]['sezona']."</td>";
                    echo "<td>".$this->niz_podataka[$i]['pol']."</td>";
                    echo "<td>".$this->niz_podataka[$i]['cena']."</td>";
                    echo "<td>".$this->niz_podataka[$i]['popust']."</td>";
                    echo "<td>".$this->niz_podataka[$i]['slika']."</td>";
                    echo "<td>".join(" ",$this->niz_podataka[$i]['slike'])."</td>";
                    echo "<td>".join(" ",$this->niz_podataka[$i]['brojevi'])."</td>";
                    echo "</tr>";
                }
        echo "</table>";
    }
}

?>