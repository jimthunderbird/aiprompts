<?php
$tmpSpecJson = file_get_contents('tmp_spec.json');
$tmpSpec = json_decode($tmpSpecJson, true);

foreach ($tmpSpec as $category => $items) {
    if ($category === 'logic') {
        foreach ($items as $type => $subItems) {
            foreach ($subItems as $name => $content) {
                $filename = "{$category}.{$type}.{$name}.json";
                file_put_contents($filename, json_encode($content, JSON_PRETTY_PRINT));
            }
        }
    } elseif ($category === 'component') {
        foreach ($items as $name => $content) {
            $filename = "{$category}.{$name}.json";
            file_put_contents($filename, json_encode($content, JSON_PRETTY_PRINT));
        }
    }
}
