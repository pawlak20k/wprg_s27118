<?php
if(isset($_GET['n'])) {
    $n = intval($_GET['n']);
    function silniaRekurencyjna($n) {
        if ($n == 0 || $n == 1) {
            return 1;
        } else {
            return $n * silniaRekurencyjna($n - 1);
        }
    }
    function silniaNierekurencyjna($n) {
        $silnia = 1;
        for ($i = 2; $i <= $n; $i++) {
            $silnia *= $i;
        }
        return $silnia;
    }

    $start_rekurencyjna = microtime(true);
    $wynik_rekurencyjna = silniaRekurencyjna($n);
    $end_rekurencyjna = microtime(true);
    $czas_rekurencyjna = $end_rekurencyjna - $start_rekurencyjna;

    $start_nierekurencyjna = microtime(true);
    $wynik_nierekurencyjna = silniaNierekurencyjna($n);
    $end_nierekurencyjna = microtime(true);
    $czas_nierekurencyjna = $end_nierekurencyjna - $start_nierekurencyjna;

    echo "Silnia $n obliczona rekurencyjnie: $wynik_rekurencyjna<br>";
    echo "Silnia $n obliczona nierekurencyjnie: $wynik_nierekurencyjna<br>";
    echo "<br>";

    if ($czas_rekurencyjna < $czas_nierekurencyjna) {
        echo "Funkcja rekurencyjna działała szybciej o " . ($czas_nierekurencyjna - $czas_rekurencyjna) . " sekund.";
    } elseif ($czas_rekurencyjna > $czas_nierekurencyjna) {
        echo "Funkcja nierekurencyjna działała szybciej o " . ($czas_rekurencyjna - $czas_nierekurencyjna) . " sekund.";
    } else {
        echo "Obie funkcje działały przez tę samą ilość czasu.";
    }
}
?>
