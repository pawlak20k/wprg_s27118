<?php
class NoweAuto {
    protected $model;
    protected $cenaEuro;
    protected $kursEuroPLN;

    public function __construct($model, $cenaEuro, $kursEuroPLN) {
        $this->model = $model;
        $this->cenaEuro = $cenaEuro;
        $this->kursEuroPLN = $kursEuroPLN;
    }

    public function ObliczCene() {
        return $this->cenaEuro * $this->kursEuroPLN;
    }
}

class AutoZDodatkami extends NoweAuto {
    private $alarm;
    private $radio;
    private $klimatyzacja;

    public function __construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja) {
        parent::__construct($model, $cenaEuro, $kursEuroPLN);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function ObliczCene() {
        $cenaPodstawowa = parent::ObliczCene();
        $cenaDodatkow = $this->alarm + $this->radio + $this->klimatyzacja;
        return $cenaPodstawowa + $cenaDodatkow * $this->kursEuroPLN;
    }
}

class Ubezpieczenie extends AutoZDodatkami {
    private $procentowaWartosc;
    private $liczbaLat;

    public function __construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja, $procentowaWartosc, $liczbaLat) {
        parent::__construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja);
        $this->procentowaWartosc = $procentowaWartosc;
        $this->liczbaLat = $liczbaLat;
    }

    public function ObliczCene() {
        $cenaSamochodu = parent::ObliczCene();
        $cenaUbezpieczenia = $this->procentowaWartosc * ($cenaSamochodu * ((100 - $this->liczbaLat) / 100));
        return $cenaSamochodu + $cenaUbezpieczenia;
    }
}

//testy
$model = "Audi A3";
$cenaEuro = 6500;
$kursEuroPLN = 4.5;
$alarm = 500;
$radio = 300;
$klimatyzacja = 1500;
$procentowaWartosc = 0.05;
$liczbaLat = 5;

$noweAuto = new NoweAuto($model, $cenaEuro, $kursEuroPLN);
echo "Cena podstawowego auta w PLN: " . $noweAuto->ObliczCene() . "\n </br>";

$autoZDodatkami = new AutoZDodatkami($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja);
echo "Cena auta z dodatkami w PLN: " . $autoZDodatkami->ObliczCene() . "\n </br>";

$ubezpieczenie = new Ubezpieczenie($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja, $procentowaWartosc, $liczbaLat);
echo "Cena auta z dodatkami i ubezpieczeniem w PLN: " . $ubezpieczenie->ObliczCene() . "\n </br>";
?>
