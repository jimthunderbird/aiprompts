
<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $all_questions = json_decode($json, true);
    shuffle($all_questions);
    return array_slice($all_questions, 0, 4);
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
            <?php $row_number = 1; foreach ($questions as $question): ?>
                <tr>
                    <td onclick="show_alert_message(<?php echo $row_number; ?>, 1)"><?php echo htmlspecialchars($question['id']); ?></td>
                    <td onclick="show_alert_message(<?php echo $row_number; ?>, 2)"><?php echo htmlspecialchars($question['body']); ?></td>
                </tr>
            <?php $row_number++; endforeach; ?>
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
function show_alert_message(row_number, column_number) {
    alert("you clicked on row " + row_number + ", column " + column_number);
}
</script>

<style>
#questions-table table {
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
    background: wheat;
    text-align: right;
    padding: 10px;
    border: 1px solid blue;
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
    background: lightyellow;
}

@media (max-width: 768px) {
    #questions-table table {
        font-size: 14px;
    }
    
    #questions-table thead th,
    #questions-table tbody td {
        padding: 8px;
    }
}
</style>


