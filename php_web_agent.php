<?php

$tmp_spec_json = json_decode(file_get_contents('tmp_spec.json'), true);
$instruction_content = file_get_contents('php_web_system_instruction.txt');

foreach ($tmp_spec_json['logic']['php'] ?? [] as $key => $sub_json) {
    $prompt = $instruction_content . "\n\n" . json_encode($sub_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents("logic.php.$key.prompt", $prompt);
}

foreach ($tmp_spec_json['logic']['js'] ?? [] as $key => $sub_json) {
    $prompt = $instruction_content . "\n\n" . json_encode($sub_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents("logic.js.$key.prompt", $prompt);
}

foreach ($tmp_spec_json['component'] ?? [] as $key => $sub_json) {
    $prompt = $instruction_content . "\n\n" . json_encode($sub_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents("component.$key.prompt", $prompt);
}
