
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
function show_alert_message(row_number, column_number, question) {
    alert("you clicked on row " + row_number + ", column " + column_number + ", question id: " + question.id);
}
</script>

<div id="questions-table">
    <table>
        <thead>
            <tr>
                <th class="header-cell">ID</th>
                <th class="header-cell">QUESTION</th>
            </tr>
        </thead>
        <tbody>
            <?php $row_index = 1; foreach ($questions as $question): ?>
            <tr>
                <td class="table-cell" onclick='show_alert_message(<?php echo $row_index; ?>, 1, <?php echo json_encode($question); ?>)'><?php echo htmlspecialchars($question['id']); ?></td>
                <td class="table-cell" onclick='show_alert_message(<?php echo $row_index; ?>, 2, <?php echo json_encode($question); ?>)'><?php echo htmlspecialchars($question['body']); ?></td>
            </tr>
            <?php $row_index++; endforeach; ?>
        </tbody>
    </table>
</div>

<div id="questions-list">
    <?php $para_index = 0; foreach ($questions as $question): ?>
    <p class="paragraph <?php echo ($para_index % 2 == 0) ? 'paragraph-even' : 'paragraph-odd'; ?>">
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php $para_index++; endforeach; ?>
</div>

<style>
#questions-table table {
    width: 100%;
    border: 1px solid blue;
    border-collapse: collapse;
    background: lightYellow;
}

#questions-table .header-cell {
    background: lightYellow;
    text-align: left;
    padding: 10px;
    border: 1px solid blue;
}

#questions-table .table-cell {
    background: wheat;
    text-align: right;
    padding: 10px;
    border: 1px solid blue;
    cursor: pointer;
}

#questions-list .paragraph {
    margin-left: 10px;
    margin-right: 10px;
}

#questions-list .paragraph-odd {
    background: yellow;
}

#questions-list .paragraph-even {
    background: lightYellow;
}

@media screen and (max-width: 768px) {
    #questions-table table {
        font-size: 14px;
    }
    
    #questions-table .table-cell,
    #questions-table .header-cell {
        padding: 8px;
    }
    
    #questions-list .paragraph {
        font-size: 14px;
        padding: 8px;
    }
}
</style>


