<?php
function fibonacci($n) {
    $fib = array(0, 1);
    for ($i = 2; $i <= $n; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
    }
    return $fib;
}

$N = 10;

$fibonacci_sequence = fibonacci($N);

echo "Nieparzyste elementy ciagu Fibonacciego do N-tej liczby:<br>";
foreach ($fibonacci_sequence as $key => $value) {
    if ($value % 2 != 0) {
        echo ($key + 1) . ". " . $value . "<br>";
    }
}

?>
