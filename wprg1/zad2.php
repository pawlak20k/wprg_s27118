<?php
function czyPierwsza($liczba) {
    if ($liczba <= 1) {
        return false;
    }
    for ($i = 2; $i * $i <= $liczba; $i++) {
        if ($liczba % $i === 0) {
            return false;
        }
    }
    return true;
}

$od = 1;
$do = 100;

echo "Liczby pierwsze w zakresie od $od do $do: <br>";

for ($liczba = $od; $liczba <= $do; $liczba++) {
    if (czyPierwsza($liczba)) {
        echo $liczba . " ";
    }
}
?>
