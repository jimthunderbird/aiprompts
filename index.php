
<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $randomKeys = array_rand($questions, min(4, count($questions)));
    if (!is_array($randomKeys)) {
        $randomKeys = [$randomKeys];
    }
    $randomQuestions = [];
    foreach ($randomKeys as $key) {
        $randomQuestions[] = $questions[$key];
    }
    return $randomQuestions;
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
            <?php foreach ($questions as $index => $question): ?>
            <tr>
                <td onclick="show_alert_message(<?php echo $index + 1; ?>, 1, <?php echo htmlspecialchars(json_encode($question)); ?>)"><?php echo htmlspecialchars($question['id']); ?></td>
                <td onclick="show_alert_message(<?php echo $index + 1; ?>, 2, <?php echo htmlspecialchars(json_encode($question)); ?>)"><?php echo htmlspecialchars($question['body']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<section id="questions-list">
    <?php foreach ($questions as $index => $question): ?>
    <p class="<?php echo ($index % 2 == 0) ? 'odd' : 'even'; ?>">
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php endforeach; ?>
</section>

<script>
function show_alert_message(row_number, column_number, question) {
    alert(question.body);
}
</script>

<style>
#questions-table {
    background: lightYellow;
    border: 1px solid blue;
}

#questions-table table {
    width: 100%;
    border-collapse: collapse;
}

#questions-table thead {
    background: black;
}

#questions-table th {
    text-align: left;
    padding: 10px;
    font-weight: bold;
    color: white;
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
    background: lightyellow;
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


