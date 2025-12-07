✓ List directory . (15 files)

✓ Read questions.json (6 lines)


<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $all_questions = json_decode($json, true);
    $keys = array_rand($all_questions, min(4, count($all_questions)));
    if (!is_array($keys)) {
        $keys = [$keys];
    }
    $questions = [];
    foreach ($keys as $key) {
        $questions[] = $all_questions[$key];
    }
    return $questions;
}

$questions = get_random_questions();
?>
<script>
function show_alert_message(row_number, column_number) {
    alert("you clicked on row " + row_number + ", column " + column_number);
}
</script>

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
    <?php $para_index = 0; foreach ($questions as $question): $para_index++; ?>
    <p class="<?php echo ($para_index % 2 == 1) ? 'odd' : 'even'; ?>"><?php echo htmlspecialchars($question['body']); ?></p>
    <?php endforeach; ?>
</div>

<style>
#questions-table {
    background: lightYellow;
    border: 1px solid blue;
    border-collapse: collapse;
    width: 100%;
}

#questions-table thead th {
    background: lightYellow;
    text-align: left;
    padding: 10px;
    border: 1px solid blue;
}

#questions-table tbody td {
    padding: 10px;
    background: wheat;
    text-align: right;
    border: 1px solid blue;
    cursor: pointer;
}

#questions-list p {
    margin-left: 10px;
    margin-right: 10px;
    padding: 10px;
}

#questions-list p.odd {
    background: yellow;
}

#questions-list p.even {
    background: lightYellow;
}

@media (max-width: 768px) {
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table thead th,
    #questions-table tbody td {
        padding: 8px;
    }
    
    #questions-list p {
        font-size: 14px;
        margin-left: 5px;
        margin-right: 5px;
        padding: 8px;
    }
}
</style>


