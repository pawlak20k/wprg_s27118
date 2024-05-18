<?php
$max_visits = 5;

if (isset($_COOKIE['visit_count'])) {
    $visit_count = $_COOKIE['visit_count'] + 1;
} else {
    $visit_count = 1;
}

setcookie('visit_count', $visit_count, time() + (30 * 24 * 60 * 60));

if ($visit_count > $max_visits) {
    echo "<h1>Dziękujemy za odwiedzenie naszej strony!</h1>";
    echo "<p>Odwiedziłeś nas już $visit_count razy.</p>";
} else {
    echo "<h1>Witamy ponownie!</h1>";
    echo "<p>Odwiedziłeś nas $visit_count razy.</p>";
}
?>
