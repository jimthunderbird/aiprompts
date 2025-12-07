
<?php
function component_questions_table_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $randomKeys = array_rand($questions, min(2, count($questions)));
    if (!is_array($randomKeys)) {
        $randomKeys = [$randomKeys];
    }
    $result = [];
    foreach ($randomKeys as $key) {
        $result[] = $questions[$key];
    }
    return $result;
}

function component_questions_list_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $randomKeys = array_rand($questions, min(4, count($questions)));
    if (!is_array($randomKeys)) {
        $randomKeys = [$randomKeys];
    }
    $result = [];
    foreach ($randomKeys as $key) {
        $result[] = $questions[$key];
    }
    return $result;
}

function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $randomKeys = array_rand($questions, min(2, count($questions)));
    if (!is_array($randomKeys)) {
        $randomKeys = [$randomKeys];
    }
    $result = [];
    foreach ($randomKeys as $key) {
        $result[] = $questions[$key];
    }
    return $result;
}

$questionsTableData = component_questions_table_datasource();
$questionsListData = component_questions_list_datasource();
?>

<table id="questions-table" class="questions-table">
    <thead>
        <tr>
            <th class="questions-table-header">ID</th>
            <th class="questions-table-header">QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questionsTableData as $rowIndex => $question): ?>
        <tr class="questions-table-row" data-row="<?php echo $rowIndex + 1; ?>">
            <td class="questions-table-cell" data-row="<?php echo $rowIndex + 1; ?>" data-col="1" data-body="<?php echo htmlspecialchars($question['body']); ?>"><?php echo htmlspecialchars($question['id']); ?></td>
            <td class="questions-table-cell" data-row="<?php echo $rowIndex + 1; ?>" data-col="2" data-body="<?php echo htmlspecialchars($question['body']); ?>"><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<section class="questions-list">
    <?php foreach ($questionsListData as $index => $question): ?>
    <p class="questions-list-paragraph <?php echo ($index % 2 === 0) ? 'even' : 'odd'; ?>"><?php echo htmlspecialchars($question['body']); ?></p>
    <?php endforeach; ?>
</section>

<script>
document.getElementById('questions-table').addEventListener('click', function(e) {
    if (e.target.classList.contains('questions-table-cell')) {
        const body = e.target.getAttribute('data-body');
        const row = e.target.getAttribute('data-row');
        const col = e.target.getAttribute('data-col');
        alert(`question details: ${body} (${row}, ${col})`);
    }
});

document.querySelectorAll('.questions-table-cell').forEach(function(cell) {
    cell.addEventListener('mouseenter', function() {
        this.style.fontWeight = 'bold';
    });
    cell.addEventListener('mouseleave', function() {
        this.style.fontWeight = 'normal';
    });
});

document.querySelectorAll('.questions-list-paragraph').forEach(function(paragraph) {
    paragraph.addEventListener('mouseenter', function() {
        this.style.fontWeight = 'bold';
        this.style.cursor = 'pointer';
    });
    paragraph.addEventListener('mouseleave', function() {
        this.style.fontWeight = 'normal';
    });
});
</script>

<style>
.questions-table {
    background: lightyellow;
    border: 3px solid gold;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    overflow-x: auto;
}

.questions-table-header {
    background: lightyellow;
    text-align: left;
    padding: 8px;
    border: 1px solid gold;
}

.questions-table-cell {
    background: wheat;
    text-align: center;
    padding: 8px;
    border: 1px solid gold;
}

.questions-table-row {
    border: 1px solid gold;
}

.questions-list {
    display: block;
}

.questions-list-paragraph {
    margin-left: 10px;
    margin-right: 10px;
    padding: 8px;
}

.questions-list-paragraph.odd {
    background: lightcoral;
}

.questions-list-paragraph.even {
    background: red;
    color: white;
}

@media screen and (max-width: 768px) {
    .questions-table {
        font-size: 14px;
    }
    
    .questions-table-cell,
    .questions-table-header {
        padding: 6px;
    }
    
    .questions-list-paragraph {
        margin-left: 5px;
        margin-right: 5px;
        font-size: 14px;
    }
}
</style>


