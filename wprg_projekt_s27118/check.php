<?php
$sessionDir = '/var/lib/php-3';

if (is_dir($sessionDir)) {
    $files = glob($sessionDir . '/sess_*');

    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    echo "Wszystkie pliki sesji zostały usunięte.";
} else {
    echo "Katalog z plikami sesji nie istnieje.";
}
?>
