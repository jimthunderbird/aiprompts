
<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    
    $random_keys = array_rand($questions, min(4, count($questions)));
    if (!is_array($random_keys)) {
        $random_keys = [$random_keys];
    }
    
    $result = [];
    foreach ($random_keys as $key) {
        $result[] = $questions[$key];
    }
    
    return $result;
}

$questions = get_random_questions();
?>

<div id="questions-table">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>QUESTION</th>
            </tr>
        </thead>
        <tbody>
            <?php $row_index = 1; foreach ($questions as $question): ?>
            <tr>
                <td onclick="show_alert_message(<?php echo $row_index; ?>, 1, <?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>)"><?php echo htmlspecialchars($question['id']); ?></td>
                <td onclick="show_alert_message(<?php echo $row_index; ?>, 2, <?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>)"><?php echo htmlspecialchars($question['body']); ?></td>
            </tr>
            <?php $row_index++; endforeach; ?>
        </tbody>
    </table>
</div>

<div id="questions-list">
    <?php $index = 0; foreach ($questions as $question): ?>
    <p class="<?php echo ($index % 2 == 0) ? 'odd' : 'even'; ?>">
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php $index++; endforeach; ?>
</div>

<script>
function show_alert_message(row_number, column_number, question) {
    alert(question.body);
}
</script>

<style>
#questions-table table {
    background: lightYellow;
    border: 1px solid blue;
    width: 100%;
    border-collapse: collapse;
}

#questions-table thead tr {
    background: lightYellow;
}

#questions-table th {
    text-align: left;
    padding: 10px;
    font-weight: bold;
}

#questions-table td {
    background: wheat;
    text-align: center;
    padding: 10px;
    font-weight: bold;
    cursor: pointer;
}

#questions-list p {
    margin-left: 10px;
    margin-right: 10px;
}

#questions-list p.odd {
    background: yellow;
}

#questions-list p.even {
    background: lightYellow;
}

@media (max-width: 768px) {
    #questions-table table {
        font-size: 14px;
    }
    
    #questions-table th,
    #questions-table td {
        padding: 8px;
    }
    
    #questions-list p {
        margin-left: 5px;
        margin-right: 5px;
    }
}
</style>


