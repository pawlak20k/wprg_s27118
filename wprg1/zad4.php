<?php

$tekst = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

$tablica_slow = explode(" ", $tekst);

foreach ($tablica_slow as $key => $slowo) {
    $ostatni_znak = substr($slowo, -1);
    if (strpos(".,?!;:", $ostatni_znak) !== false) {
        unset($tablica_slow[$key]);
    }
}

$tablica_slow = array_values($tablica_slow);

$tablica_asocjacyjna = array();
$count = count($tablica_slow);
for ($i = 0; $i < $count; $i += 2) {
    if (isset($tablica_slow[$i + 1])) {
        $tablica_asocjacyjna[$tablica_slow[$i]] = $tablica_slow[$i + 1];
    }
}

foreach ($tablica_asocjacyjna as $klucz => $wartosc) {
    echo $klucz . " => " . $wartosc . "<br>";
}

?>
