<?php
session_start();
$max_visits = 5;

if (isset($_COOKIE['visit_count'])) {
    $visit_count = $_COOKIE['visit_count'];
} else {
    $visit_count = 0;
}

if (!isset($_SESSION['visited'])) {
    $visit_count++;
    $_SESSION['visited'] = true;
    setcookie('visit_count', $visit_count, time() + (30 * 24 * 60 * 60));
}

if ($visit_count > $max_visits) {
    echo "<h1>Dziękujemy za odwiedzenie naszej strony!</h1>";
    echo "<p>Odwiedziłeś nas już $visit_count razy.</p>";
} else {
    echo "<h1>Witamy ponownie!</h1>";
    echo "<p>Odwiedziłeś nas $visit_count razy.</p>";
}
?>
