<?php
function czyLiczbaPierwsza($n, &$iterations) {
    if ($n <= 1) {
        return false;
    }
    for ($i = 2; $i * $i <= $n; $i++) {
        $iterations++;
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $liczba = $_POST["liczba"];

    if (!is_numeric($liczba) || $liczba <= 0 || strpos($liczba, '.') !== false) {
        echo "Wprowadz poprawna liczbe calkowita dodatnia.";
    } else {
        $liczba = (int)$liczba;
        $iterations = 0;

        if (czyLiczbaPierwsza($liczba, $iterations)) {
            echo "Liczba $liczba jest liczba pierwsza. Liczba iteracji: $iterations";
        } else {
            echo "Liczba $liczba nie jest liczba pierwsza. Liczba iteracji: $iterations";
        }
    }
}
?>
