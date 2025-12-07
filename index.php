
<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $all_questions = json_decode($json, true);
    $questions = [];
    $keys = array_rand($all_questions, min(4, count($all_questions)));
    if (!is_array($keys)) $keys = [$keys];
    foreach ($keys as $key) {
        $questions[] = $all_questions[$key];
    }
    return $questions;
}

$questions = get_random_questions();
?>

<script>
function show_alert_message(row_number, column_number, question) {
    alert(question.body);
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
            <td onclick='show_alert_message(<?php echo $row_index; ?>, 1, <?php echo json_encode($question); ?>)'>
                <?php echo htmlspecialchars($question['id']); ?>
            </td>
            <td onclick='show_alert_message(<?php echo $row_index; ?>, 2, <?php echo json_encode($question); ?>)'>
                <?php echo htmlspecialchars($question['body']); ?>
            </td>
        </tr>
        <?php $row_index++; endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php $para_index = 0; foreach ($questions as $question): ?>
    <p class="<?php echo ($para_index % 2 == 0) ? 'even' : 'odd'; ?>">
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php $para_index++; endforeach; ?>
</section>

<style>
#questions-table {
    background: lightYellow;
    border: 1px solid blue;
    width: 100%;
    border-collapse: collapse;
}

#questions-table thead {
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

@media screen and (max-width: 768px) {
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table th,
    #questions-table td {
        padding: 8px;
    }
    
    #questions-list p {
        font-size: 14px;
    }
}
</style>


