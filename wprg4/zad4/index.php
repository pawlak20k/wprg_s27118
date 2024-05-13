<?php
$allowed_ips = array(
    ''
);

$ip_file = 'allowed_ips.txt';

if (file_exists($ip_file)) {
    $allowed_ips = array_merge($allowed_ips, file($ip_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}

$user_ip = $_SERVER['REMOTE_ADDR'];

if (in_array($user_ip, $allowed_ips)) {
    include('allowed_page.php');
    //sprawdzenie IP do testow echo $user_ip;
} else {
    include('default_page.php');
    //sprawdzenie IP do testow echo $user_ip;
}
?>
