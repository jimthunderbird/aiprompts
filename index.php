```php
<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $all_questions = json_decode($json, true);
    shuffle($all_questions);
    return array_slice($all_questions, 0, 4);
}

$questions = get_random_questions();
?>

<script>
function show_alert_message(row_number, column_number) {
    alert("you are clicking on row " + row_number + ", column " + column_number);
}
</script>

<style>
#questions-table {
    background: lightYellow;
    border: 1px solid blue;
    border-collapse: collapse;
    width: 100%;
}

#questions-table th {
    background: lightYellow;
    text-align: left;
}

#questions-table td {
    background: wheat;
    text-align: right;
    cursor: pointer;
    padding: 8px;
}

#questions-table th,
#questions-table td {
    border: 1px solid blue;
}

#questions-list .paragraph-odd {
    background: yellow;
    padding: 10px;
    margin: 5px 0;
}

#questions-list .paragraph-even {
    background: lightyellow;
    padding: 10px;
    margin: 5px 0;
}

@media (max-width: 768px) {
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table td,
    #questions-table th {
        padding: 6px;
    }
}
</style>

<table id="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $row_index = 1; foreach ($questions as $question): ?>
        <tr>
            <td onclick="show_alert_message(<?php echo $row_index; ?>, 1)"><?php echo htmlspecialchars($question['id']); ?></td>
            <td onclick="show_alert_message(<?php echo $row_index; ?>, 2)"><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php $row_index++; endforeach; ?>
    </tbody>
</table>

<div id="questions-list">
    <?php $para_index = 1; foreach ($questions as $question): ?>
    <p class="paragraph-<?php echo ($para_index % 2 == 1) ? 'odd' : 'even'; ?>">
        <?php echo htmlspecialchars($question['id'] . ': ' . $question['body']); ?>
    </p>
    <?php $para_index++; endforeach; ?>
</div>
```

