<?php
if(isset($_POST['sciezka']) && isset($_POST['katalog'])) {
    $sciezka = $_POST['sciezka'];
    $katalog = $_POST['katalog'];
    $operacja = isset($_POST['operacja']) ? $_POST['operacja'] : "read";

    function obslugaKatalogow($sciezka, $katalog, $operacja = "read") {
        if (substr($sciezka, -1) !== "/") {
            $sciezka .= "/";
        }

        switch ($operacja) {
            case 'read':
                if (is_dir($sciezka . $katalog)) {
                    $elementy = scandir($sciezka . $katalog);
                    $elementy = array_diff($elementy, array('.', '..'));
                    return $elementy;
                } else {
                    return "Katalog nie istnieje.";
                }
                break;

            case 'delete':
                if (is_dir($sciezka . $katalog)) {
                    if (count(scandir($sciezka . $katalog)) == 2) {
                        rmdir($sciezka . $katalog);
                        return "Katalog został usunięty.";
                    } else {
                        return "Katalog nie jest pusty. Usuwanie niemożliwe.";
                    }
                } else {
                    return "Katalog nie istnieje.";
                }
                break;

            case 'create':
                if (!is_dir($sciezka . $katalog)) {
                    if (!is_dir($sciezka)) {
                        mkdir($sciezka, 0777, true);
                    }
                    mkdir($sciezka . $katalog);
                    return "Katalog został utworzony.";
                } else {
                    return "Katalog już istnieje.";
                }
                break;

            default:
                return "Nieprawidłowa operacja.";
                break;
        }
    }

    $wynik = obslugaKatalogow($sciezka, $katalog, $operacja);
    if (is_array($wynik)) {
        echo "Elementy w katalogu $katalog:<br>";
        foreach ($wynik as $element) {
            echo $element . "<br>";
        }
    } else {
        echo $wynik;
    }
    echo "<br><br>";
}
?>

<a href="obsluga_katalogow_formularz.html">Powrót do formularza</a>
