<?php
$numbers = array_rand(range(1, 20), 5);
foreach($numbers as $number) {
    echo "hello $number\n";
}
$sum = array_sum($numbers);
$min = min($numbers);
$max = max($numbers);
echo "$sum\n";
echo "$min $max\n";
$html = "<table class=\"report\">\n";
$html .= "  <tr><th>min</th><th>max</th><th>sum</th></tr>\n";
$html .= "  <tr><td>$min</td><td>$max</td><td>$sum</td></tr>\n";
$html .= "</table>\n";
file_put_contents('output.txt', $html);
?>

