
<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $all_questions = json_decode($json, true);
    $shuffled = $all_questions;
    shuffle($shuffled);
    $questions = array_slice($shuffled, 0, 4);
    return $questions;
}

$questions = get_random_questions();
?>

<script>
function show_alert_message(row_number, column_number, question) {
    alert("you clicked on row " + row_number + ", column " + column_number + ", question id: " + question.id);
}
</script>

<style>
#questions-table {
    background: lightYellow;
    border: 1px solid blue;
}

#questions-table thead {
    background: lightYellow;
    text-align: left;
}

#questions-table td {
    padding: 10px;
    font-weight: bold;
    background: wheat;
    text-align: center;
    cursor: pointer;
}

#questions-list p {
    margin-left: 10px;
    margin-right: 10px;
}

#questions-list p:nth-child(odd) {
    background: yellow;
}

#questions-list p:nth-child(even) {
    background: lightyellow;
}

@media screen and (max-width: 768px) {
    #questions-table {
        width: 100%;
        overflow-x: auto;
        display: block;
    }
    
    #questions-table td {
        font-size: 14px;
        padding: 8px;
    }
    
    #questions-list p {
        font-size: 14px;
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
        <?php $row_num = 1; foreach ($questions as $question): ?>
        <tr>
            <td onclick='show_alert_message(<?php echo $row_num; ?>, 1, <?php echo json_encode($question); ?>)'>
                <?php echo htmlspecialchars($question['id']); ?>
            </td>
            <td onclick='show_alert_message(<?php echo $row_num; ?>, 2, <?php echo json_encode($question); ?>)'>
                <?php echo htmlspecialchars($question['body']); ?>
            </td>
        </tr>
        <?php $row_num++; endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php foreach ($questions as $question): ?>
    <p><?php echo htmlspecialchars($question['body']); ?></p>
    <?php endforeach; ?>
</section>


