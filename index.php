
<?php
function component_questions_table_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 2);
}

function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 2);
}

$questionsTableData = component_questions_table_datasource();
$questionsListData = get_random_questions();
?>

<table id="questions-table" class="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questionsTableData as $index => $question): ?>
        <tr data-row="<?php echo $index + 1; ?>">
            <td data-col="1" data-row="<?php echo $index + 1; ?>" data-body="<?php echo htmlspecialchars($question['body']); ?>"><?php echo htmlspecialchars($question['id']); ?></td>
            <td data-col="2" data-row="<?php echo $index + 1; ?>" data-body="<?php echo htmlspecialchars($question['body']); ?>"><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<section class="questions-list">
    <?php foreach ($questionsListData as $index => $question): ?>
    <p class="<?php echo ($index + 1) % 2 === 1 ? 'odd' : 'even'; ?>">
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php endforeach; ?>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('questions-table');
    if (table) {
        table.addEventListener('click', function(e) {
            const cell = e.target.closest('td');
            if (cell) {
                const rowNumber = cell.getAttribute('data-row');
                const colNumber = cell.getAttribute('data-col');
                const questionBody = cell.getAttribute('data-body');
                alert(`question details: ${questionBody} (${rowNumber}, ${colNumber})`);
            }
        });
        
        const cells = table.querySelectorAll('td');
        cells.forEach(cell => {
            cell.addEventListener('mouseenter', function() {
                this.style.fontWeight = 'bold';
            });
            cell.addEventListener('mouseleave', function() {
                this.style.fontWeight = 'normal';
            });
        });
    }
    
    const listParagraphs = document.querySelectorAll('.questions-list p');
    listParagraphs.forEach(p => {
        p.addEventListener('mouseenter', function() {
            this.style.fontWeight = 'bold';
        });
        p.addEventListener('mouseleave', function() {
            this.style.fontWeight = 'normal';
        });
    });
});
</script>

<style>
.questions-table {
    background: lightyellow;
    border: 3px solid gold;
    width: 100%;
    border-collapse: collapse;
}

.questions-table th {
    background: lightyellow;
    text-align: left;
    padding: 8px;
}

.questions-table td {
    background: wheat;
    text-align: center;
    padding: 8px;
    cursor: pointer;
}

.questions-list p {
    margin-left: 10px;
    margin-right: 10px;
    padding: 10px;
}

.questions-list p.odd {
    background: lightcoral;
}

.questions-list p.even {
    background: red;
    color: white;
}

@media (max-width: 768px) {
    .questions-table {
        font-size: 14px;
    }
    
    .questions-table th,
    .questions-table td {
        padding: 6px;
    }
    
    .questions-list p {
        margin-left: 5px;
        margin-right: 5px;
        padding: 8px;
        font-size: 14px;
    }
}
</style>


