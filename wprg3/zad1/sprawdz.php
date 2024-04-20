<?php
if(isset($_GET['birthdate'])) {
    $birthdate = $_GET['birthdate'];

    function dzienTygodnia($date) {
        $daysOfWeek = array('niedziela', 'poniedziałek', 'wtorek', 'środa', 'czwartek', 'piątek', 'sobota');
        $dayOfWeek = date("w", strtotime($date));
        return $daysOfWeek[$dayOfWeek];
    }

    function wiek($date) {
        $birthdate = new DateTime($date);
        $today = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    }

    function dniDoNastepnychUrodzin($date) {
        $today = new DateTime('today');
        $birthdate = new DateTime($date);
        $nextBirthday = new DateTime(date('Y-m-d', strtotime('+' . (date('Y') - date('Y', strtotime($date))) . ' years', strtotime($date))));
        if ($nextBirthday < $today) {
            $nextBirthday->modify('+1 year');
        }
        $days = $today->diff($nextBirthday)->days;
        return $days;
    }

    $dzienTygodnia = dzienTygodnia($birthdate);
    $wiek = wiek($birthdate);
    $dniDoNastepnychUrodzin = dniDoNastepnychUrodzin($birthdate);

    echo "Urodziłeś/aś się w dniu: $dzienTygodnia<br>";
    echo "Masz $wiek lat<br>";
    echo "Do Twoich następnych urodzin pozostało: $dniDoNastepnychUrodzin dni";
}
?>
