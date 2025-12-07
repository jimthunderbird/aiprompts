
<?php
function component_questions_table_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $shuffled = $questions;
    shuffle($shuffled);
    return array_slice($shuffled, 0, 2);
}

function component_questions_list_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $shuffled = $questions;
    shuffle($shuffled);
    return array_slice($shuffled, 0, 4);
}

function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $shuffled = $questions;
    shuffle($shuffled);
    return array_slice($shuffled, 0, 2);
}

$questionsTableData = component_questions_table_datasource();
$questionsListData = component_questions_list_datasource();
?>

<table id="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questionsTableData as $index => $question): ?>
        <tr data-row="<?php echo $index + 1; ?>">
            <td data-col="1"><?php echo htmlspecialchars($question['id']); ?></td>
            <td data-col="2"><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php foreach ($questionsListData as $index => $question): ?>
    <p class="question-paragraph <?php echo ($index % 2 === 0) ? 'odd' : 'even'; ?>" data-body="<?php echo htmlspecialchars($question['body']); ?>">
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php endforeach; ?>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('questions-table');
    const cells = table.querySelectorAll('tbody td');
    
    cells.forEach(cell => {
        cell.addEventListener('click', function(e) {
            const row = e.target.closest('tr');
            const rowNumber = row.dataset.row;
            const columnNumber = e.target.dataset.col;
            const questionBody = row.querySelector('td[data-col="2"]').textContent;
            alert(`question details: ${questionBody} (${rowNumber}, ${columnNumber})`);
        });
        
        cell.addEventListener('mouseenter', function(e) {
            e.target.style.fontWeight = 'bold';
        });
        
        cell.addEventListener('mouseleave', function(e) {
            e.target.style.fontWeight = 'normal';
        });
    });
    
    const paragraphs = document.querySelectorAll('#questions-list .question-paragraph');
    paragraphs.forEach(paragraph => {
        paragraph.addEventListener('mouseenter', function(e) {
            e.target.style.fontWeight = 'bold';
            e.target.style.cursor = 'wait';
        });
        
        paragraph.addEventListener('mouseleave', function(e) {
            e.target.style.fontWeight = 'normal';
            e.target.style.cursor = 'default';
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

#questions-table thead th {
    background: lightyellow;
    text-align: left;
    padding: 8px;
}

#questions-table tbody td {
    background: wheat;
    text-align: center;
    padding: 8px;
    border: 1px solid #ccc;
}

#questions-list .question-paragraph {
    margin-left: 10px;
    margin-right: 10px;
    padding: 10px;
}

#questions-list .question-paragraph.odd {
    background: lightcoral;
}

#questions-list .question-paragraph.even {
    background: red;
    color: white;
}

@media screen and (max-width: 768px) {
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table thead th,
    #questions-table tbody td {
        padding: 6px;
    }
    
    #questions-list .question-paragraph {
        margin-left: 5px;
        margin-right: 5px;
        padding: 8px;
        font-size: 14px;
    }
}
</style>


