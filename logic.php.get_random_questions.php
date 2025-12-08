```php
<?php

function logic_php() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    
    $randomKeys = array_rand($questions, min(2, count($questions)));
    if (!is_array($randomKeys)) {
        $randomKeys = [$randomKeys];
    }
    
    $selectedQuestions = [];
    foreach ($randomKeys as $key) {
        $selectedQuestions[] = $questions[$key];
    }
    
    return $selectedQuestions;
}

?>
```

