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

<script>
function show_alert_message(row_number, column_number, question) {
    alert(`you clicked on row ${row_number}, column ${column_number}, question id: ${question.id}`);
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
            <?php $row_index = 1; ?>
            <?php foreach ($questions as $question): ?>
                <tr>
                    <td class="body-cell" onclick='show_alert_message(<?= $row_index ?>, 1, <?= json_encode($question) ?>)'><?= htmlspecialchars($question['id']) ?></td>
                    <td class="body-cell" onclick='show_alert_message(<?= $row_index ?>, 2, <?= json_encode($question) ?>)'><?= htmlspecialchars($question['body']) ?></td>
                </tr>
                <?php $row_index++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="questions-list">
    <?php $para_index = 0; ?>
    <?php foreach ($questions as $question): ?>
        <p class="paragraph-item <?= $para_index % 2 === 0 ? 'para-even' : 'para-odd' ?>">
            <?= htmlspecialchars($question['body']) ?>
        </p>
        <?php $para_index++; ?>
    <?php endforeach; ?>
</div>

<style>
#questions-table table {
    background: lightYellow;
    border: 1px solid blue;
    border-collapse: collapse;
    width: 100%;
}

#questions-table .header-cell {
    background: lightYellow;
    text-align: left;
    padding: 10px;
    border: 1px solid blue;
}

#questions-table .body-cell {
    background: wheat;
    text-align: right;
    padding: 10px;
    border: 1px solid blue;
    cursor: pointer;
}

#questions-list .paragraph-item {
    margin-left: 10px;
    margin-right: 10px;
}

#questions-list .para-odd {
    background: yellow;
}

#questions-list .para-even {
    background: lightyellow;
}

@media (max-width: 768px) {
    #questions-table table {
        font-size: 14px;
    }
    
    #questions-table .header-cell,
    #questions-table .body-cell {
        padding: 8px;
    }
    
    #questions-list .paragraph-item {
        margin-left: 5px;
        margin-right: 5px;
        font-size: 14px;
    }
}
</style>

