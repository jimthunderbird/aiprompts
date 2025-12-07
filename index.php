
<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $random_keys = array_rand($questions, min(2, count($questions)));
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

<script>
function show_alert_message(row_number, column_number, question) {
    alert(question);
}
</script>

<style>
#questions-table {
    background: lightyellow;
    border: 3px gold solid;
}

#questions-table th {
    background: lightYellow;
    text-align: left;
}

#questions-table td {
    background: wheat;
    text-align: center;
    cursor: pointer;
}

.questions-list p {
    margin-left: 10px;
    margin-right: 10px;
}

.questions-list p:nth-child(odd) {
    background: lightcoral;
}

.questions-list p:nth-child(even) {
    background: red;
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
        <?php $row = 1; foreach ($questions as $question): ?>
        <tr>
            <td onclick="show_alert_message(<?php echo $row; ?>, 1, '<?php echo addslashes($question['body']); ?>')"><?php echo htmlspecialchars($question['id']); ?></td>
            <td onclick="show_alert_message(<?php echo $row; ?>, 2, '<?php echo addslashes($question['body']); ?>')"><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php $row++; endforeach; ?>
    </tbody>
</table>

<section class="questions-list">
    <?php foreach ($questions as $question): ?>
    <p><?php echo htmlspecialchars($question['body']); ?></p>
    <?php endforeach; ?>
</section>


