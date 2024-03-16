<?php
$owoce = array("jablko", "banan", "pomarancza");
foreach ($owoce as $owoc) {
    $dlugosc = strlen($owoc);

    for ($i = $dlugosc - 1; $i >= 0; $i--) {
        echo $owoc[$i];
    }

    if (strtolower($owoc[0]) === 'p') {
        echo " - zaczyna sie na litere 'p'";
    } else {
        echo " - nie zaczyna sie na litere 'p'";
    }

    echo "<br>";
}
?>
