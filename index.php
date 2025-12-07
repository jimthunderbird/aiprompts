
<?php

function component_questions_table_datasource() {
    $json_content = file_get_contents('questions.json');
    $questions = json_decode($json_content, true);
    $shuffled = $questions;
    shuffle($shuffled);
    $questions = array_slice($shuffled, 0, 2);
    return $questions;
}

function get_random_questions() {
    $json_content = file_get_contents('questions.json');
    $questions = json_decode($json_content, true);
    $shuffled = $questions;
    shuffle($shuffled);
    $questions = array_slice($shuffled, 0, 2);
    return $questions;
}

$questions_table_data = component_questions_table_datasource();
$questions_list_data = get_random_questions();

?>

<table id="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions_table_data as $index => $question): ?>
        <tr>
            <td onclick="show_alert_message(<?php echo $index + 1; ?>, 1, <?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>)"><?php echo htmlspecialchars($question['id']); ?></td>
            <td onclick="show_alert_message(<?php echo $index + 1; ?>, 2, <?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>)"><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php foreach ($questions_list_data as $index => $question): ?>
    <p class="<?php echo ($index % 2 === 0) ? 'even' : 'odd'; ?>">
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
    background: lightyellow;
    border: 3px solid gold;
    border-collapse: collapse;
    width: 100%;
}

#questions-table th {
    background: lightyellow;
    text-align: left;
    padding: 8px;
    border: 1px solid gold;
}

#questions-table td {
    background: wheat;
    text-align: center;
    padding: 8px;
    border: 1px solid gold;
    cursor: pointer;
}

#questions-list p {
    margin-left: 10px;
    margin-right: 10px;
    padding: 10px;
}

#questions-list p.odd {
    background: lightcoral;
}

#questions-list p.even {
    background: red;
    color: white;
}

@media (max-width: 768px) {
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table th,
    #questions-table td {
        padding: 6px;
    }
    
    #questions-list p {
        font-size: 14px;
    }
}
</style>


