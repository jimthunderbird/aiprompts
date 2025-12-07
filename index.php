
<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 2);
}

function component_questions_table_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 2);
}

$questions_table_data = component_questions_table_datasource();
$questions_list_data = get_random_questions();
?>

<table id="questions-table">
    <thead>
        <tr>
            <th class="questions-table-header">ID</th>
            <th class="questions-table-header">QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions_table_data as $index => $question): ?>
        <tr class="questions-table-row" data-row="<?php echo $index + 1; ?>">
            <td class="questions-table-cell" data-col="1" data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>'><?php echo htmlspecialchars($question['id']); ?></td>
            <td class="questions-table-cell" data-col="2" data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>'><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php foreach ($questions_list_data as $index => $question): ?>
    <p class="questions-list-paragraph <?php echo ($index % 2 === 0) ? 'even' : 'odd'; ?>">
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php endforeach; ?>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableCells = document.querySelectorAll('.questions-table-cell');
    tableCells.forEach(cell => {
        cell.addEventListener('mouseenter', function() {
            this.style.fontWeight = 'bold';
        });
        cell.addEventListener('mouseleave', function() {
            this.style.fontWeight = 'normal';
        });
        cell.addEventListener('click', function() {
            const questionData = JSON.parse(this.dataset.question);
            const rowNumber = this.closest('tr').dataset.row;
            const colNumber = this.dataset.col;
            alert('question details: ' + questionData.body + ' (' + rowNumber + ', ' + colNumber + ')');
        });
    });

    const listParagraphs = document.querySelectorAll('.questions-list-paragraph');
    listParagraphs.forEach(para => {
        para.addEventListener('mouseenter', function() {
            this.style.fontWeight = 'bold';
            this.style.cursor = 'pointer';
        });
        para.addEventListener('mouseleave', function() {
            this.style.fontWeight = 'normal';
        });
    });
});
</script>

<style>
#questions-table {
    background: lightyellow;
    border: 3px solid gold;
    border-collapse: collapse;
    width: 100%;
}

.questions-table-header {
    background: lightyellow;
    text-align: left;
    padding: 8px;
}

.questions-table-cell {
    background: wheat;
    text-align: center;
    padding: 8px;
    cursor: pointer;
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
    #questions-table {
        font-size: 14px;
    }
    
    .questions-table-cell,
    .questions-table-header {
        padding: 6px;
    }
    
    .questions-list-paragraph {
        margin-left: 5px;
        margin-right: 5px;
        padding: 6px;
    }
}
</style>


