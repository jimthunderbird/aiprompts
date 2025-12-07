<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 4);
}

$questions = get_random_questions();
?>

<table id="mytable">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $index => $question): ?>
        <tr>
            <td onclick="show_alert_message(<?= $index + 1 ?>, 1)"><?= htmlspecialchars($question['id']) ?></td>
            <td onclick="show_alert_message(<?= $index + 1 ?>, 2)"><?= htmlspecialchars($question['body']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="questions-list">
    <?php foreach ($questions as $index => $question): ?>
    <p class="<?= $index % 2 === 0 ? 'odd' : 'even' ?>"><?= htmlspecialchars($question['body']) ?></p>
    <?php endforeach; ?>
</div>

<script>
function show_alert_message(row_number, column_number) {
    alert("you are clicking on row " + row_number + ", column " + column_number);
}
</script>

<style>
#mytable {
    background: lightYellow;
    border: 1px solid silver;
    width: 100%;
    border-collapse: collapse;
}

#mytable thead th {
    background: lightYellow;
    text-align: left;
    padding: 8px;
    border: 1px solid silver;
}

#mytable tbody td {
    background: wheat;
    text-align: right;
    padding: 8px;
    border: 1px solid silver;
    cursor: pointer;
}

#questions-list p.odd {
    background: yellow;
    margin: 0;
    padding: 10px;
}

#questions-list p.even {
    background: lightyellow;
    margin: 0;
    padding: 10px;
}

@media screen and (max-width: 768px) {
    #mytable {
        font-size: 14px;
    }

    #mytable thead th,
    #mytable tbody td {
        padding: 6px;
    }

    #questions-list p {
        font-size: 14px;
        padding: 8px;
    }
}
</style>
