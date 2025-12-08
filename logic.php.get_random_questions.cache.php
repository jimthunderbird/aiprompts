<?php
function get_random_questions() {
    $questions = json_decode(file_get_contents('questions.json'), true);
    $randomKeys = array_rand($questions, min(2, count($questions)));
    if (!is_array($randomKeys)) {
        $randomKeys = [$randomKeys];
    }
    $questions = array_map(fn($key) => $questions[$key], $randomKeys);
    return $questions;
}
?>
