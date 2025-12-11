<?php
function get_random_numbers($n) {
    $numbers = range(1, 100);
    shuffle($numbers);
    return array_slice($numbers, 0, $n);
}

$numbers = get_random_numbers(5);
foreach ($numbers as $number) {
    echo "hello " . $number . "\n";
}
?>

