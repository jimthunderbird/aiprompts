✓ List directory . (15 files)

✓ Read questions.json (6 lines)

```php
<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $all_questions = json_decode($json, true);
    shuffle($all_questions);
    $questions = array_slice($all_questions, 0, 4);
    return $questions;
}

$questions = get_random_questions();
?>

<!-- questions-table -->
<table id="questions-table">
    <thead>
        <tr>
            <th class="table-header">ID</th>
            <th class="table-header">QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $index => $question): ?>
        <tr>
            <td class="table-cell" onclick="show_alert_message(<?php echo $index + 1; ?>, 1)"><?php echo htmlspecialchars($question['id']); ?></td>
            <td class="table-cell" onclick="show_alert_message(<?php echo $index + 1; ?>, 2)"><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- questions-list -->
<div id="questions-list">
    <?php foreach ($questions as $index => $question): ?>
    <p class="paragraph <?php echo ($index % 2 === 0) ? 'paragraph-even' : 'paragraph-odd'; ?>">
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php endforeach; ?>
</div>

<script>
function show_alert_message(row_number, column_number) {
    alert("you clicked on row " + row_number + ", column " + column_number);
}
</script>

<style>
#questions-table {
    background: lightYellow;
    border: 1px solid blue;
    width: 100%;
    border-collapse: collapse;
}

.table-header {
    background: lightYellow;
    text-align: left;
    padding: 10px;
}

.table-cell {
    background: wheat;
    text-align: right;
    padding: 10px;
    cursor: pointer;
}

#questions-list {
    width: 100%;
}

.paragraph {
    margin-left: 10px;
    margin-right: 10px;
}

.paragraph-odd {
    background: yellow;
}

.paragraph-even {
    background: lightYellow;
}

@media screen and (max-width: 768px) {
    .table-cell, .table-header {
        font-size: 14px;
        padding: 8px;
    }
    
    .paragraph {
        font-size: 14px;
    }
}
</style>
```

